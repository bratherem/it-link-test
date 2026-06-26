<?php

declare(strict_types=1);

namespace app\controllers;

use app\Exception\CarNotFoundException;
use app\Exception\ValidationException;
use app\Service\CarServiceInterface;
use yii\web\Controller;

final class CarController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly CarServiceInterface $carService,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [];
    }

    public function beforeAction($action): bool
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionCreate(): array
    {
        try {
            $car = $this->carService->create($this->request->bodyParams);
            $this->response->setStatusCode(201);

            return $car->toArray();
        } catch (ValidationException $exception) {
            $this->response->setStatusCode(422);
            return ['errors' => $exception->getErrors()];
        }
    }

    public function actionView(int $id): array
    {
        try {
            return $this->carService->getById($id)->toArray();
        } catch (CarNotFoundException) {
            $this->response->setStatusCode(404);
            return ['message' => "Car with id {$id} not found."];
        }
    }

    public function actionList(): array
    {
        $page = (int) $this->request->get('page', 1);
        $result = $this->carService->getList($page);

        return [
            'items' => array_map(static fn ($car) => $car->toArray(), $result['items']),
            'pagination' => [
                'page' => $result['page'],
                'page_size' => $result['page_size'],
                'total' => $result['total'],
                'total_pages' => $result['total_pages'],
            ],
        ];
    }
}
