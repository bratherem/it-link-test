<?php

declare(strict_types=1);

namespace app\DataMapper;

use app\Entity\Car;
use app\Entity\CarOption;

final class CarDataMapper
{
    public function toEntity(array $row, ?CarOption $option = null): Car
    {
        return new Car(
            (int) $row['id'],
            (string) $row['title'],
            (string) $row['description'],
            (string) $row['price'],
            (string) $row['photo_url'],
            (string) $row['contacts'],
            (string) $row['created_at'],
            $option,
        );
    }

    public function toInsertRow(Car $car): array
    {
        return [
            'title' => $car->getTitle(),
            'description' => $car->getDescription(),
            'price' => $car->getPrice(),
            'photo_url' => $car->getPhotoUrl(),
            'contacts' => $car->getContacts(),
        ];
    }
}
