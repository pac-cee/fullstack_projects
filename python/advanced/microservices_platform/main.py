"""
Microservices Platform using FastAPI
Features:
- API Gateway
- Service Discovery
- Load Balancing
- Circuit Breaking
- Distributed Tracing
"""

from fastapi import FastAPI, Depends, HTTPException
from sqlalchemy.orm import Session
from celery import Celery
from opentelemetry import trace
from prometheus_client import Counter, Histogram
import consul
import jwt

from core.config import Settings
from core.database import get_db
from core.security import get_current_user
from services.discovery import ServiceRegistry
from services.circuit_breaker import CircuitBreaker
from services.rate_limiter import RateLimiter

app = FastAPI(title="Microservices Platform")
settings = Settings()

# Metrics
REQUEST_COUNT = Counter('request_count', 'Total request count')
REQUEST_LATENCY = Histogram('request_latency', 'Request latency')

# Service registry
service_registry = ServiceRegistry(
    consul_host=settings.CONSUL_HOST,
    consul_port=settings.CONSUL_PORT
)

# Circuit breaker
circuit_breaker = CircuitBreaker(
    failure_threshold=5,
    recovery_timeout=30
)

# Rate limiter
rate_limiter = RateLimiter(
    redis_url=settings.REDIS_URL,
    rate_limit=100,
    per_seconds=60
)

@app.on_event("startup")
async def startup_event():
    # Register service
    await service_registry.register_service(
        service_name="api_gateway",
        service_id="api_gateway_1",
        address="localhost",
        port=8000
    )
    
    # Initialize tracing
    tracer = trace.get_tracer(__name__)
    
    # Initialize database
    await init_db()

@app.on_event("shutdown")
async def shutdown_event():
    await service_registry.deregister_service("api_gateway_1")

@app.middleware("http")
async def middleware(request, call_next):
    # Rate limiting
    if not await rate_limiter.allow(request.client.host):
        raise HTTPException(status_code=429, detail="Too many requests")
    
    # Circuit breaking
    if not circuit_breaker.allow_request():
        raise HTTPException(status_code=503, detail="Service unavailable")
    
    # Metrics
    with REQUEST_LATENCY.time():
        REQUEST_COUNT.inc()
        response = await call_next(request)
    
    return response

@app.get("/api/v1/services")
async def get_services(current_user = Depends(get_current_user)):
    """Get list of available services"""
    return await service_registry.get_services()

@app.post("/api/v1/route")
async def route_request(
    request_data: dict,
    current_user = Depends(get_current_user),
    db: Session = Depends(get_db)
):
    """Route request to appropriate service"""
    service = await service_registry.get_service(request_data["service"])
    if not service:
        raise HTTPException(status_code=404, detail="Service not found")
    
    try:
        response = await circuit_breaker.execute(
            lambda: make_service_request(service, request_data)
        )
        return response
    except Exception as e:
        circuit_breaker.record_failure()
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000) 