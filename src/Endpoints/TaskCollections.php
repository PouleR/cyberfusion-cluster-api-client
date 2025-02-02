<?php

namespace Cyberfusion\ClusterApi\Endpoints;

use Cyberfusion\ClusterApi\Exceptions\RequestException;
use Cyberfusion\ClusterApi\Models\TaskResult;
use Cyberfusion\ClusterApi\Request;
use Cyberfusion\ClusterApi\Response;

class TaskCollections extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function results(string $uuid): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('task-collections/%s/results', $uuid));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'taskResults' => array_map(
                fn (array $data) => (new TaskResult())->fromArray($data),
                $response->getData()
            ),
        ]);
    }
}
