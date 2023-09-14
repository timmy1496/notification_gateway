<?php declare(strict_types=1);

namespace App\Domain\ValueObject;

final readonly class Channel
{
    private string $channel;

    private string $message;

    public function __construct(string $channel, string $message)
    {
        $this->channel = $channel;
        $this->message = $message;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
