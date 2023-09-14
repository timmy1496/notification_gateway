<?php declare(strict_types=1);

namespace App\Domain\Sender;

final readonly class EmailSender implements SenderInterface
{
    public function support(string $channel): bool
    {
        return $channel === $this->getType();
    }

    public function getType(): string
    {
        return 'email';
    }

    public function send(): void
    {
    }
}
