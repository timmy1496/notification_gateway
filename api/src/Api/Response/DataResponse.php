<?php declare(strict_types=1);

namespace App\Api\Response;

final class DataResponse
{
    private array $data;

    private int $status;

    public function __construct(array $data, int $status)
    {
        $this->data = $data;
        $this->status = $status;
    }
}
