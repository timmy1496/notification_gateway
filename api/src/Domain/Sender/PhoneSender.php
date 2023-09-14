<?php declare(strict_types=1);

namespace App\Domain\Sender;

final class PhoneSender implements SenderInterface
{

    public function support(string $channel): bool
    {
       return $channel === $this->getType();
    }

    public function getType(): string
    {
        return 'phone';
    }

    public function send(): void
    {
        // TODO: Implement send() method.
    }
}
