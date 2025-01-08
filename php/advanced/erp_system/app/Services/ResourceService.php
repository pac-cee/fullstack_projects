<?php

namespace App\Services;

use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class ResourceService
{
    protected $repository;
    protected $cacheTime = 3600; // 1 hour

    public function __construct(ResourceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllWithCache(): Collection
    {
        return Cache::remember('resources.all', $this->cacheTime, function () {
            return $this->repository->getAllWithRelations();
        });
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $resource = $this->repository->create($data);
            
            // Process any additional business logic
            if (isset($data['attachments'])) {
                $this->processAttachments($resource, $data['attachments']);
            }

            DB::commit();
            Cache::tags(['resources'])->flush();
            
            return $resource;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function processAttachments($resource, array $attachments)
    {
        foreach ($attachments as $attachment) {
            $path = $attachment->store('attachments', 'public');
            $resource->attachments()->create([
                'path' => $path,
                'type' => $attachment->getClientMimeType(),
                'size' => $attachment->getSize()
            ]);
        }
    }
} 