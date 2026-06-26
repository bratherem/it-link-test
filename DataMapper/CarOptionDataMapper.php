<?php

declare(strict_types=1);

namespace app\DataMapper;

use app\Entity\CarOption;

final class CarOptionDataMapper
{
    public function toEntity(array $row): CarOption
    {
        return new CarOption(
            (int) $row['id'],
            (int) $row['car_id'],
            (string) $row['brand'],
            (string) $row['model'],
            (int) $row['year'],
            (string) $row['body'],
            (int) $row['mileage'],
        );
    }

    public function toInsertRow(CarOption $option): array
    {
        return [
            'car_id' => $option->getCarId(),
            'brand' => $option->getBrand(),
            'model' => $option->getModel(),
            'year' => $option->getYear(),
            'body' => $option->getBody(),
            'mileage' => $option->getMileage(),
        ];
    }
}
