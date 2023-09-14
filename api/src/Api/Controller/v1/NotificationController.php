<?php declare(strict_types=1);

namespace App\Api\Controller\v1;

use App\Api\Response\Factory\ResponseFactory;
use App\Domain\Sender\SenderInterface;
use App\Domain\ValueObject\Channel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final readonly class NotificationController
{
    private ResponseFactory $responseFactory;

    /**
     * @var iterable<SenderInterface>
     */
    private iterable $senders;

    public function __construct(
        ResponseFactory $responseFactory,
        iterable $senders
    ) {
        $this->responseFactory = $responseFactory;
        $this->senders = $senders;
    }

    #[Route('/notify', name: 'notify', methods: ['GET'])]
    public function __invoke(Channel $channel): JsonResponse
    {
        foreach ($this->senders as $sender) {
            if (false === $sender->support($channel->getChannel())) {
                continue;
            }
            $sender->send();

            return $this->responseFactory->create(
                [
                    'channel' => $channel->getChannel(),
                    'message' => $channel->getMessage(),
                ],
                Response::HTTP_OK
            );
        }

        return $this->responseFactory->notFound();
    }
}
