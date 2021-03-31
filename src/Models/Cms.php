<?php

namespace Vdhicts\Cyberfusion\ClusterApi\Models;

use Illuminate\Support\Arr;
use Vdhicts\Cyberfusion\ClusterApi\Contracts\Model;

class Cms extends ClusterModel implements Model
{
    private string $name;
    private int $virtualHostId;
    private int $id;
    private int $clusterId;
    private string $createdAt;
    private string $updatedAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Cms
    {
        $this->name = $name;

        return $this;
    }

    public function getVirtualHostId(): int
    {
        return $this->virtualHostId;
    }

    public function setVirtualHostId(int $virtualHostId): Cms
    {
        $this->virtualHostId = $virtualHostId;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Cms
    {
        $this->id = $id;

        return $this;
    }

    public function getClusterId(): int
    {
        return $this->clusterId;
    }

    public function setClusterId(int $clusterId): Cms
    {
        $this->clusterId = $clusterId;

        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): Cms
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): Cms
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function fromArray(array $data): Cms
    {
        return $this
            ->setName(Arr::get($data, 'name'))
            ->setVirtualHostId(Arr::get($data, 'virtual_host_id'))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'virtual_host_id' => $this->getVirtualHostId(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
