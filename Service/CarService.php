<?php

declare(strict_types=1);

namespace app\Service;

use app\Dto\CreateCarDto;
use app\Entity\Car;
use app\Exception\CarNotFoundException;
use app\Exception\ValidationException;
use app\Repository\CarRepositoryInterface;

final class CarService implements CarServiceInterface
{
    private const REQUIRED_FIELDS = ['title', 'description', 'price', 'photo_url', 'contacts'];
    private const REQUIRED_OPTION_FIELDS = ['brand', 'model', 'year', 'body', 'mileage'];

    public function __construct(
        private readonly CarRepositoryInterface $carRepository,
        private readonly int $defaultPageSize = 10,
    ) {
    }

    public function create(array $payload): Car
    {
        $this->validateCreatePayload($payload);

        $dto = CreateCarDto::fromArray($payload);

        return $this->carRepository->save($dto);
    }

    public function getById(int $id): Car
    {
        $car = $this->carRepository->findById($id);

        if ($car === null) {
            throw new CarNotFoundException("Car with id {$id} not found.");
        }

        return $car;
    }

    public function getList(int $page, ?int $pageSize = null): array
    {
        $page = max(1, $page);
        $pageSize = max(1, $pageSize ?? $this->defaultPageSize);
        $total = $this->carRepository->countAll();
        $totalPages = $total === 0 ? 0 : (int) ceil($total / $pageSize);

        return [
            'items' => $this->carRepository->findAll($page, $pageSize),
            'page' => $page,
            'page_size' => $pageSize,
            'total' => $total,
            'total_pages' => $totalPages,
        ];
    }

    private function validateCreatePayload(array $payload): void
    {
        $errors = [];

        foreach (self::REQUIRED_FIELDS as $field) {
            if (!array_key_exists($field, $payload) || $payload[$field] === '' || $payload[$field] === null) {
                $errors[$field][] = 'This field is required.';
            }
        }

        if (array_key_exists('price', $payload) && !is_numeric($payload['price'])) {
            $errors['price'][] = 'Price must be a number.';
        }

        if (array_key_exists('options', $payload) && $payload['options'] !== null) {
            if (!is_array($payload['options'])) {
                $errors['options'][] = 'Options must be an object or null.';
            } else {
                foreach (self::REQUIRED_OPTION_FIELDS as $field) {
                    if (!array_key_exists($field, $payload['options']) || $payload['options'][$field] === '' || $payload['options'][$field] === null) {
                        $errors["options.{$field}"][] = 'This field is required.';
                    }
                }

                if (array_key_exists('year', $payload['options']) && !is_int($payload['options']['year']) && !ctype_digit((string) $payload['options']['year'])) {
                    $errors['options.year'][] = 'Year must be an integer.';
                }

                if (array_key_exists('mileage', $payload['options']) && !is_int($payload['options']['mileage']) && !ctype_digit((string) $payload['options']['mileage'])) {
                    $errors['options.mileage'][] = 'Mileage must be an integer.';
                }
            }
        }

        if ($errors !== []) {
            throw new ValidationException($errors);
        }
    }
}
