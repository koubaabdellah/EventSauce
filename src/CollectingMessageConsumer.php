<?php

declare(strict_types=1);

namespace EventSauce\EventSourcing;

use function array_map;

class CollectingMessageConsumer implements MessageConsumer
{
    /**
     * @var Message[]
     */
    private array $collectedMessages = [];

    /**
     * @return Message[]
     */
    public function collectedMessages(): array
    {
        return $this->collectedMessages;
    }

    public function collectedPayloads(): array
    {
        return array_map(fn (Message $message) => $message->event(), $this->collectedMessages);
    }

    public function handle(Message $message): void
    {
        $this->collectedMessages[] = $message;
    }
}
