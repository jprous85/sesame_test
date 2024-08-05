<?php

declare(strict_types=1);

namespace App\User\Application\Response;

final class UserResponses
{
    private array $user_responses;

    public function __construct(UserResponse ...$user_responses)
    {
        $this->user_responses = $user_responses;
    }

    public function getUser(): array
    {
        return $this->user_responses;
    }

    public function toArray(): array
    {
        $user_response_array = [];
        foreach ($this->user_responses as $user_response)
        {
            $user_response_array[] = $user_response->toArray();
        }
        return $user_response_array;
    }
}
