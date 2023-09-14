<?php declare(strict_types=1);

namespace App\Domain\Sender;

interface SenderInterface
{
    public function support(string $channel): bool;

    public function send(): void;

    public function getType(): string;
}
