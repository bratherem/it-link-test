<?php

declare(strict_types=1);

namespace app\Service;

use app\Dto\CreateCarDto;
use app\Entity\Car;
use app\Exception\CarNotFoundException;
use app\Exception\ValidationException;
use app\Repository\CarRepositoryInterface;

interface CarServiceInterface
{
    public function create(array $payload): Car;

    public function getById(int $id): Car;

  /**
   * @return array{items: Car[], page: int, page_size: int, total: int, total_pages: int}
   */
    public function getList(int $page): array;
}
