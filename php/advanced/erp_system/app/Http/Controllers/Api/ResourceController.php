<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ResourceService;
use App\Http\Requests\ResourceRequest;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="ERP System API",
 *     version="1.0.0"
 * )
 */
class ResourceController extends Controller
{
    protected $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
        $this->middleware('auth:sanctum');
        $this->middleware('role:admin')->only(['store', 'update', 'destroy']);
    }

    /**
     * @OA\Get(
     *     path="/api/resources",
     *     summary="List all resources",
     *     @OA\Response(response="200", description="List of resources")
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $resources = $this->resourceService->getAllWithCache();
            return response()->json($resources);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/resources",
     *     summary="Create a new resource"
     * )
     */
    public function store(ResourceRequest $request): JsonResponse
    {
        try {
            $resource = $this->resourceService->create($request->validated());
            event(new ResourceCreated($resource));
            return response()->json($resource, 201);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => 'Creation Failed'], 422);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/resources/{id}",
     *     summary="Get resource details"
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $resource = $this->resourceService->findOrFail($id);
            return response()->json($resource);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    }
} 