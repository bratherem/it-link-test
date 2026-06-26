<?php

declare(strict_types=1);

namespace app\Repository;

use app\DataMapper\CarDataMapper;
use app\DataMapper\CarOptionDataMapper;
use app\Dto\CreateCarDto;
use app\Entity\Car;
use app\Entity\CarOption;
use yii\db\Connection;

final class CarRepository implements CarRepositoryInterface
{
    public function __construct(
        private readonly Connection $db,
        private readonly CarDataMapper $carDataMapper,
        private readonly CarOptionDataMapper $carOptionDataMapper,
    ) {
    }

    public function save(CreateCarDto $dto): Car
    {
        $car = new Car(
            null,
            $dto->title,
            $dto->description,
            number_format($dto->price, 2, '.', ''),
            $dto->photoUrl,
            $dto->contacts,
        );

        $transaction = $this->db->beginTransaction();

        try {
            $this->db->createCommand()->insert('{{%car}}', $this->carDataMapper->toInsertRow($car))->execute();
            $carId = $this->getLastInsertId('car');

            $option = null;
            if ($dto->option !== null) {
                $option = $dto->option->withCarId($carId);
                $this->db->createCommand()->insert('{{%car_option}}', $this->carOptionDataMapper->toInsertRow($option))->execute();
                $optionId = $this->getLastInsertId('car_option');
                $option = $option->withId($optionId);
            }

            $row = $this->db->createCommand('SELECT * FROM {{%car}} WHERE id = :id', [':id' => $carId])->queryOne();
            $transaction->commit();

            return $this->carDataMapper->toEntity($row, $option);
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    public function findById(int $id): ?Car
    {
        $row = $this->db->createCommand('SELECT * FROM {{%car}} WHERE id = :id', [':id' => $id])->queryOne();

        if ($row === false) {
            return null;
        }

        $option = $this->findOptionByCarId($id);

        return $this->carDataMapper->toEntity($row, $option);
    }

    public function findAll(int $page, int $pageSize): array
    {
        $offset = max(0, ($page - 1) * $pageSize);
        $rows = $this->db->createCommand(
            'SELECT * FROM {{%car}} ORDER BY id DESC LIMIT :limit OFFSET :offset',
            [':limit' => $pageSize, ':offset' => $offset]
        )->queryAll();

        $cars = [];
        foreach ($rows as $row) {
            $option = $this->findOptionByCarId((int) $row['id']);
            $cars[] = $this->carDataMapper->toEntity($row, $option);
        }

        return $cars;
    }

    public function countAll(): int
    {
        return (int) $this->db->createCommand('SELECT COUNT(*) FROM {{%car}}')->queryScalar();
    }

    private function findOptionByCarId(int $carId): ?CarOption
    {
        $row = $this->db->createCommand(
            'SELECT * FROM {{%car_option}} WHERE car_id = :car_id',
            [':car_id' => $carId]
        )->queryOne();

        if ($row === false) {
            return null;
        }

        return $this->carOptionDataMapper->toEntity($row);
    }

    private function getLastInsertId(string $table): int
    {
        if ($this->db->driverName === 'pgsql') {
            return (int) $this->db->getLastInsertID($table . '_id_seq');
        }

        return (int) $this->db->getLastInsertID();
    }
}
