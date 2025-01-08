<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Log;

class ProcessResourceData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $resourceId;
    protected $data;
    public $tries = 3;
    public $timeout = 300;

    public function __construct(int $resourceId, array $data)
    {
        $this->resourceId = $resourceId;
        $this->data = $data;
    }

    public function handle(ResourceService $service)
    {
        try {
            Log::info('Starting resource processing', [
                'resource_id' => $this->resourceId
            ]);

            // Process the resource data
            $resource = $service->findOrFail($this->resourceId);
            $service->processData($resource, $this->data);

            Log::info('Resource processing completed', [
                'resource_id' => $this->resourceId
            ]);
        } catch (\Exception $e) {
            Log::error('Resource processing failed', [
                'resource_id' => $this->resourceId,
                'error' => $e->getMessage()
            ]);
            
            throw $e;
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error('Resource job failed', [
            'resource_id' => $this->resourceId,
            'error' => $exception->getMessage()
        ]);
    }
} 