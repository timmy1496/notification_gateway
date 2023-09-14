<?php declare(strict_types=1);

namespace App\Api\Response\Factory;

use App\Api\Response\DataResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ResponseFactory
{
    private const CHANNEL_NOT_FOUND = 'Channel not found';

    public function create(array $data, int $status): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'status' => $status]);
    }

    public function notFound(): JsonResponse
    {
        return $this->create(['message' => self::CHANNEL_NOT_FOUND], Response::HTTP_NOT_FOUND);
    }
}
