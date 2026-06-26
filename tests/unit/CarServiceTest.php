<?php

declare(strict_types=1);

namespace app\tests\unit;

use app\Dto\CreateCarDto;
use app\Entity\Car;
use app\Entity\CarOption;
use app\Exception\ValidationException;
use app\Repository\CarRepositoryInterface;
use app\Service\CarService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CarServiceTest extends TestCase
{
    private CarRepositoryInterface&MockObject $repository;
    private CarService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->createMock(CarRepositoryInterface::class);
        $this->service = new CarService($this->repository, 10);
    }

    public function testCreateWithoutOptions(): void
    {
        $payload = [
            'title' => 'Toyota Camry',
            'description' => 'Excellent condition',
            'price' => 15000.50,
            'photo_url' => 'https://example.com/photo.jpg',
            'contacts' => '+1234567890',
        ];

        $expectedCar = new Car(
            1,
            $payload['title'],
            $payload['description'],
            '15000.50',
            $payload['photo_url'],
            $payload['contacts'],
            '2026-06-26 10:00:00',
        );

        $this->repository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(static function (CreateCarDto $dto) use ($payload): bool {
                return $dto->title === $payload['title']
                    && $dto->description === $payload['description']
                    && $dto->price === $payload['price']
                    && $dto->photoUrl === $payload['photo_url']
                    && $dto->contacts === $payload['contacts']
                    && $dto->option === null;
            }))
            ->willReturn($expectedCar);

        $result = $this->service->create($payload);

        $this->assertSame(1, $result->getId());
        $this->assertNull($result->getOption());
    }

    public function testCreateWithOptions(): void
    {
        $payload = [
            'title' => 'BMW X5',
            'description' => 'Full package',
            'price' => 45000,
            'photo_url' => 'https://example.com/bmw.jpg',
            'contacts' => 'email@example.com',
            'options' => [
                'brand' => 'BMW',
                'model' => 'X5',
                'year' => 2020,
                'body' => 'SUV',
                'mileage' => 35000,
            ],
        ];

        $option = new CarOption(null, 0, 'BMW', 'X5', 2020, 'SUV', 35000);
        $expectedCar = new Car(
            2,
            $payload['title'],
            $payload['description'],
            '45000.00',
            $payload['photo_url'],
            $payload['contacts'],
            '2026-06-26 10:00:00',
            $option->withId(1)->withCarId(2),
        );

        $this->repository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(static function (CreateCarDto $dto): bool {
                return $dto->option !== null
                    && $dto->option->getBrand() === 'BMW'
                    && $dto->option->getModel() === 'X5'
                    && $dto->option->getYear() === 2020
                    && $dto->option->getBody() === 'SUV'
                    && $dto->option->getMileage() === 35000;
            }))
            ->willReturn($expectedCar);

        $result = $this->service->create($payload);

        $this->assertNotNull($result->getOption());
        $this->assertSame('BMW', $result->getOption()->getBrand());
    }

    public function testCreateWithNullOptions(): void
    {
        $payload = [
            'title' => 'Honda Civic',
            'description' => 'Economy car',
            'price' => 8000,
            'photo_url' => 'https://example.com/honda.jpg',
            'contacts' => '+9876543210',
            'options' => null,
        ];

        $expectedCar = new Car(3, $payload['title'], $payload['description'], '8000.00', $payload['photo_url'], $payload['contacts']);

        $this->repository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(static fn (CreateCarDto $dto): bool => $dto->option === null))
            ->willReturn($expectedCar);

        $this->service->create($payload);
    }

    public function testCreateValidationFailsWhenRequiredFieldMissing(): void
    {
        $this->repository->expects($this->never())->method('save');

        $this->expectException(ValidationException::class);

        $this->service->create([
            'description' => 'No title',
            'price' => 1000,
            'photo_url' => 'https://example.com/photo.jpg',
            'contacts' => '+123',
        ]);
    }

    public function testGetListUsesDefaultPageSize(): void
    {
        $this->repository->expects($this->once())->method('countAll')->willReturn(25);
        $this->repository
            ->expects($this->once())
            ->method('findAll')
            ->with(1, 10)
            ->willReturn([]);

        $result = $this->service->getList(1);

        $this->assertSame(10, $result['page_size']);
        $this->assertSame(3, $result['total_pages']);
    }

    public function testGetListUsesCustomPageSize(): void
    {
        $this->repository->expects($this->once())->method('countAll')->willReturn(25);
        $this->repository
            ->expects($this->once())
            ->method('findAll')
            ->with(2, 5)
            ->willReturn([]);

        $result = $this->service->getList(2, 5);

        $this->assertSame(5, $result['page_size']);
        $this->assertSame(5, $result['total_pages']);
    }

    public function testCreateValidationFailsWhenOptionFieldMissing(): void
    {
        $this->repository->expects($this->never())->method('save');

        try {
            $this->service->create([
                'title' => 'Audi A4',
                'description' => 'Sport',
                'price' => 20000,
                'photo_url' => 'https://example.com/audi.jpg',
                'contacts' => '+123',
                'options' => [
                    'brand' => 'Audi',
                    'model' => 'A4',
                ],
            ]);
            $this->fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $exception) {
            $errors = $exception->getErrors();
            $this->assertArrayHasKey('options.year', $errors);
            $this->assertArrayHasKey('options.body', $errors);
            $this->assertArrayHasKey('options.mileage', $errors);
        }
    }
}
