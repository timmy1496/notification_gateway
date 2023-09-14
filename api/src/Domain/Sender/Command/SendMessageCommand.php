<?php declare(strict_types=1);

namespace App\Domain\Sender\Command;

final readonly class SendMessageCommand
{
    private string $to;

    private string $message;

    public function __construct(string $to, string $message)
    {
        $this->to = $to;
        $this->message = $message;
    }
}
