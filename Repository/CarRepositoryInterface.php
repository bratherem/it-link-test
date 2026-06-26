<?php

declare(strict_types=1);

namespace app\Repository;

use app\Dto\CreateCarDto;
use app\Entity\Car;

interface CarRepositoryInterface
{
    public function save(CreateCarDto $dto): Car;

    public function findById(int $id): ?Car;

  /**
   * @return Car[]
   */
    public function findAll(int $page, int $pageSize): array;

    public function countAll(): int;
}
