<?php

declare(strict_types=1);

namespace app\Exception;

use DomainException;

final class ValidationException extends DomainException
{
    public function __construct(
        private readonly array $errors,
        string $message = 'Validation failed.',
    ) {
        parent::__construct($message);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
