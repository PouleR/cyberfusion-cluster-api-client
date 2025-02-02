<?php

namespace Cyberfusion\ClusterApi\Support;

use Cyberfusion\ClusterApi\Contracts\Filter;
use Cyberfusion\ClusterApi\Enums\Limit;
use Cyberfusion\ClusterApi\Enums\Sort;
use Cyberfusion\ClusterApi\Exceptions\ListFilterException;
use DateTimeInterface;

class LogFilter implements Filter
{
    private ?DateTimeInterface $timestamp = null;
    private int $limit = Limit::DEFAULT_LIMIT;
    private string $sort = Sort::ASC;
    private bool $showRawMessage = false;

    public function getTimestamp(): ?DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        if ($limit > Limit::MAX_LIMIT) {
            $limit = Limit::MAX_LIMIT;
        }

        $this->limit = $limit;

        return $this;
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    public function setSort(string $sort = Sort::ASC): self
    {
        if (!in_array($sort, Sort::AVAILABLE)) {
            throw ListFilterException::invalidSortMethod($sort);
        }

        $this->sort = $sort;

        return $this;
    }

    public function isShowRawMessage(): bool
    {
        return $this->showRawMessage;
    }

    public function setShowRawMessage(bool $showRawMessage): self
    {
        $this->showRawMessage = $showRawMessage;

        return $this;
    }

    public function toQuery(): string
    {
        return http_build_query([
            'timestamp' => is_null($this->timestamp) ? null : $this->timestamp->format('c'),
            'limit' => $this->limit,
            'sort' => $this->sort,
            'show_raw_message' => $this->showRawMessage,
        ]);
    }
}
