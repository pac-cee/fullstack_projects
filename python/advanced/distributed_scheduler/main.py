"""
Distributed Task Scheduler
Features:
- Distributed task execution
- Task dependency management
- Real-time monitoring
- Fault tolerance
- Dynamic scaling
"""

import asyncio
import logging
from typing import Dict, List
from scheduler.core import Scheduler
from scheduler.worker import WorkerPool
from scheduler.monitor import SystemMonitor
from scheduler.storage import DistributedStorage
from scheduler.config import Config

class TaskSchedulerSystem:
    def __init__(self, config: Config):
        self.logger = logging.getLogger(__name__)
        self.config = config
        self.storage = DistributedStorage(config.storage_config)
        self.scheduler = Scheduler(config.scheduler_config)
        self.worker_pool = WorkerPool(config.worker_config)
        self.monitor = SystemMonitor(config.monitor_config)

    async def initialize(self):
        """Initialize all components of the system"""
        try:
            await self.storage.connect()
            await self.scheduler.start()
            await self.worker_pool.initialize()
            await self.monitor.start()
            self.logger.info("Task Scheduler System initialized successfully")
        except Exception as e:
            self.logger.error(f"Initialization failed: {e}")
            raise

    async def shutdown(self):
        """Graceful shutdown of all components"""
        try:
            await self.scheduler.stop()
            await self.worker_pool.shutdown()
            await self.monitor.stop()
            await self.storage.disconnect()
            self.logger.info("Task Scheduler System shut down successfully")
        except Exception as e:
            self.logger.error(f"Shutdown failed: {e}")
            raise

async def main():
    # Load configuration
    config = Config.load_from_file("config.yaml")
    
    # Initialize logging
    logging.basicConfig(level=config.log_level)
    
    # Create and start the system
    system = TaskSchedulerSystem(config)
    
    try:
        await system.initialize()
        
        # Wait for shutdown signal
        shutdown_event = asyncio.Event()
        await shutdown_event.wait()
        
    except KeyboardInterrupt:
        logging.info("Shutdown signal received")
    finally:
        await system.shutdown()

if __name__ == "__main__":
    asyncio.run(main()) 