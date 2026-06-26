<?php

use app\DataMapper\CarDataMapper;
use app\DataMapper\CarOptionDataMapper;
use app\Repository\CarRepository;
use app\Repository\CarRepositoryInterface;
use app\Service\CarService;
use app\Service\CarServiceInterface;
use yii\di\Container;

return [
    'singletons' => [
        CarRepositoryInterface::class => static function (Container $container): CarRepositoryInterface {
            return new CarRepository(
                Yii::$app->db,
                new CarDataMapper(),
                new CarOptionDataMapper(),
            );
        },
        CarServiceInterface::class => static function (Container $container): CarServiceInterface {
            return new CarService(
                $container->get(CarRepositoryInterface::class),
                (int) Yii::$app->params['carListPageSize'],
            );
        },
    ],
];
