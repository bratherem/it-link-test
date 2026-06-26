<?php

declare(strict_types=1);

namespace app\Entity;

final class CarOption
{
    public function __construct(
        private ?int $id,
        private int $carId,
        private string $brand,
        private string $model,
        private int $year,
        private string $body,
        private int $mileage,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarId(): int
    {
        return $this->carId;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function withId(int $id): self
    {
        return new self(
            $id,
            $this->carId,
            $this->brand,
            $this->model,
            $this->year,
            $this->body,
            $this->mileage,
        );
    }

    public function withCarId(int $carId): self
    {
        return new self(
            $this->id,
            $carId,
            $this->brand,
            $this->model,
            $this->year,
            $this->body,
            $this->mileage,
        );
    }

    public function toArray(): array
    {
        return [
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'body' => $this->body,
            'mileage' => $this->mileage,
        ];
    }
}
