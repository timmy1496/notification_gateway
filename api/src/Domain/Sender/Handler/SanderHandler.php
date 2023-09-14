<?php declare(strict_types=1);

namespace App\Domain\Sender\Handler;

use App\Domain\Sender\Command\SendMessageCommand;

final class SanderHandler
{
    public function __invoke(SendMessageCommand $command): void
    {

    }
}
