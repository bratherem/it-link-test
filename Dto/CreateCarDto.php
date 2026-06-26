<?php

declare(strict_types=1);

namespace app\Dto;

use app\Entity\CarOption;

final class CreateCarDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly float $price,
        public readonly string $photoUrl,
        public readonly string $contacts,
        public readonly ?CarOption $option = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $option = null;
        if (array_key_exists('options', $data) && $data['options'] !== null) {
            $optionsData = $data['options'];
            $option = new CarOption(
                null,
                0,
                (string) $optionsData['brand'],
                (string) $optionsData['model'],
                (int) $optionsData['year'],
                (string) $optionsData['body'],
                (int) $optionsData['mileage'],
            );
        }

        return new self(
            (string) $data['title'],
            (string) $data['description'],
            (float) $data['price'],
            (string) $data['photo_url'],
            (string) $data['contacts'],
            $option,
        );
    }
}
