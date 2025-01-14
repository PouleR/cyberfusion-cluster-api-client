<?php

namespace Cyberfusion\ClusterApi\Endpoints;

use Cyberfusion\ClusterApi\Exceptions\RequestException;
use Cyberfusion\ClusterApi\Models\AccessLog;
use Cyberfusion\ClusterApi\Models\ErrorLog;
use Cyberfusion\ClusterApi\Request;
use Cyberfusion\ClusterApi\Response;
use Cyberfusion\ClusterApi\Support\LogFilter;

class Logs extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function accessLogs(int $virtualHostId, ?LogFilter $filter = null): Response
    {
        if (is_null($filter)) {
            $filter = new LogFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('logs/access/%d?%s', $virtualHostId, $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'logs' => array_map(
                fn (array $data) => (new AccessLog())->fromArray($data),
                $response->getData()
            ),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function errorLogs(int $virtualHostId, ?LogFilter $filter = null): Response
    {
        if (is_null($filter)) {
            $filter = new LogFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('logs/error/%d?%s', $virtualHostId, $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'logs' => array_map(
                fn (array $data) => (new ErrorLog())->fromArray($data),
                $response->getData()
            ),
        ]);
    }
}
