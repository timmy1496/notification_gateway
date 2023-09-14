<?php declare(strict_types=1);

namespace App\Api\ArgumentResolver;

use App\Domain\ValueObject\Channel;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class ChannelResolver implements ValueResolverInterface
{
    private const PHONE_REGEX_PATTERN = '/^[0-9\-\(\)\/\+\s]*$/';

    private const EMAIL_CHANNEL = 'email';

    private const PHONE_CHANNEL = 'phone';

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $type = (string) $argument->getType();

        return true === is_a($type, Channel::class, true);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $to = $request->get('to');
        $message = $request->get('message');

        if (null === $message) {
            throw new InvalidArgumentException('Invalid parameter "message"');
        }

        yield $this->resolveChannel($to, $message);
    }

    private function resolveChannel(string $to, string $message): Channel
    {
        if (true === (bool) filter_var($to, FILTER_VALIDATE_EMAIL)) {
            return new Channel(self::EMAIL_CHANNEL, $message);
        }

        if (true === (bool) preg_match(self::PHONE_REGEX_PATTERN, $to)) {
            return new Channel(self::PHONE_CHANNEL, $message);
        }

        throw new InvalidArgumentException('Invalid parameter "to"');
    }
}
