<?php

use yii\db\Migration;

class m260626_000002_seed_car_data extends Migration
{
    public function safeUp(): void
    {
        $cars = [
            [
                'title' => 'Toyota Camry 2019',
                'description' => 'Один владелец, полная сервисная история, кожаный салон.',
                'price' => 18500.00,
                'photo_url' => 'https://example.com/photos/toyota-camry.jpg',
                'contacts' => '+7 (999) 111-22-33',
                'created_at' => '2026-01-10 10:00:00',
                'options' => ['brand' => 'Toyota', 'model' => 'Camry', 'year' => 2019, 'body' => 'sedan', 'mileage' => 62000],
            ],
            [
                'title' => 'BMW X5 xDrive40i',
                'description' => 'Премиальная комплектация, панорамная крыша, адаптивный круиз-контроль.',
                'price' => 52000.00,
                'photo_url' => 'https://example.com/photos/bmw-x5.jpg',
                'contacts' => 'bmw.seller@mail.ru',
                'created_at' => '2026-01-15 11:30:00',
                'options' => ['brand' => 'BMW', 'model' => 'X5', 'year' => 2020, 'body' => 'SUV', 'mileage' => 41000],
            ],
            [
                'title' => 'Hyundai Solaris 2021',
                'description' => 'Экономичный городской автомобиль, низкий расход топлива.',
                'price' => 12500.00,
                'photo_url' => 'https://example.com/photos/hyundai-solaris.jpg',
                'contacts' => '+7 (916) 555-44-22',
                'created_at' => '2026-02-01 09:15:00',
                'options' => ['brand' => 'Hyundai', 'model' => 'Solaris', 'year' => 2021, 'body' => 'sedan', 'mileage' => 28000],
            ],
            [
                'title' => 'Volkswagen Polo',
                'description' => 'Компактный хэтчбек, идеален для города.',
                'price' => 9800.00,
                'photo_url' => 'https://example.com/photos/vw-polo.jpg',
                'contacts' => '+7 (903) 777-88-99',
                'created_at' => '2026-02-05 14:20:00',
                'options' => null,
            ],
            [
                'title' => 'Mercedes-Benz E220d',
                'description' => 'Бизнес-класс, дизельный двигатель, полный привод 4MATIC.',
                'price' => 48000.00,
                'photo_url' => 'https://example.com/photos/mercedes-e220.jpg',
                'contacts' => 'e220@autodealer.ru',
                'created_at' => '2026-02-10 16:45:00',
                'options' => ['brand' => 'Mercedes-Benz', 'model' => 'E220d', 'year' => 2018, 'body' => 'sedan', 'mileage' => 75000],
            ],
            [
                'title' => 'Kia Sportage 2022',
                'description' => 'Свежий кроссовер, гарантия производителя до 2027 года.',
                'price' => 24500.00,
                'photo_url' => 'https://example.com/photos/kia-sportage.jpg',
                'contacts' => '+7 (925) 333-22-11',
                'created_at' => '2026-02-18 08:00:00',
                'options' => ['brand' => 'Kia', 'model' => 'Sportage', 'year' => 2022, 'body' => 'crossover', 'mileage' => 15000],
            ],
            [
                'title' => 'Lada Vesta SW',
                'description' => 'Универсал в хорошем состоянии, без ДТП.',
                'price' => 7500.00,
                'photo_url' => 'https://example.com/photos/lada-vesta.jpg',
                'contacts' => '+7 (980) 123-45-67',
                'created_at' => '2026-03-01 12:00:00',
                'options' => ['brand' => 'Lada', 'model' => 'Vesta SW', 'year' => 2020, 'body' => 'wagon', 'mileage' => 90000],
            ],
            [
                'title' => 'Audi A4 2.0 TFSI',
                'description' => 'Спортивный седан, S-line пакет, матричные фары.',
                'price' => 31000.00,
                'photo_url' => 'https://example.com/photos/audi-a4.jpg',
                'contacts' => 'audi.a4@yandex.ru',
                'created_at' => '2026-03-05 17:30:00',
                'options' => ['brand' => 'Audi', 'model' => 'A4', 'year' => 2019, 'body' => 'sedan', 'mileage' => 55000],
            ],
            [
                'title' => 'Renault Duster',
                'description' => 'Надёжный внедорожник для загородных поездок.',
                'price' => 11200.00,
                'photo_url' => 'https://example.com/photos/renault-duster.jpg',
                'contacts' => '+7 (926) 888-77-66',
                'created_at' => '2026-03-12 10:45:00',
                'options' => null,
            ],
            [
                'title' => 'Skoda Octavia 1.8 TSI',
                'description' => 'Просторный семейный автомобиль, полный сервис у дилера.',
                'price' => 16800.00,
                'photo_url' => 'https://example.com/photos/skoda-octavia.jpg',
                'contacts' => '+7 (915) 222-33-44',
                'created_at' => '2026-03-18 13:10:00',
                'options' => ['brand' => 'Skoda', 'model' => 'Octavia', 'year' => 2017, 'body' => 'liftback', 'mileage' => 105000],
            ],
            [
                'title' => 'Ford Focus ST',
                'description' => 'Горячий хэтчбек, 250 л.с., механическая коробка передач.',
                'price' => 22000.00,
                'photo_url' => 'https://example.com/photos/ford-focus-st.jpg',
                'contacts' => 'focus.st@gmail.com',
                'created_at' => '2026-04-02 09:50:00',
                'options' => ['brand' => 'Ford', 'model' => 'Focus ST', 'year' => 2018, 'body' => 'hatchback', 'mileage' => 68000],
            ],
            [
                'title' => 'Mazda CX-5',
                'description' => 'Стильный кроссовер с отличной управляемостью.',
                'price' => 21500.00,
                'photo_url' => 'https://example.com/photos/mazda-cx5.jpg',
                'contacts' => '+7 (903) 444-55-66',
                'created_at' => '2026-04-08 15:25:00',
                'options' => ['brand' => 'Mazda', 'model' => 'CX-5', 'year' => 2020, 'body' => 'crossover', 'mileage' => 47000],
            ],
            [
                'title' => 'Chevrolet Cruze',
                'description' => 'Недорогой седан для ежедневных поездок.',
                'price' => 6500.00,
                'photo_url' => 'https://example.com/photos/chevrolet-cruze.jpg',
                'contacts' => '+7 (977) 666-55-44',
                'created_at' => '2026-04-15 11:00:00',
                'options' => null,
            ],
            [
                'title' => 'Volvo XC60 T5',
                'description' => 'Безопасный премиальный кроссовер, система Pilot Assist.',
                'price' => 38500.00,
                'photo_url' => 'https://example.com/photos/volvo-xc60.jpg',
                'contacts' => 'volvo.xc60@mail.ru',
                'created_at' => '2026-04-22 18:40:00',
                'options' => ['brand' => 'Volvo', 'model' => 'XC60', 'year' => 2019, 'body' => 'SUV', 'mileage' => 52000],
            ],
            [
                'title' => 'Nissan Qashqai 2021',
                'description' => 'Популярный кроссовер, камера 360°, подогрев руля и сидений.',
                'price' => 19800.00,
                'photo_url' => 'https://example.com/photos/nissan-qashqai.jpg',
                'contacts' => '+7 (999) 000-11-22',
                'created_at' => '2026-05-01 07:55:00',
                'options' => ['brand' => 'Nissan', 'model' => 'Qashqai', 'year' => 2021, 'body' => 'crossover', 'mileage' => 33000],
            ],
        ];

        foreach ($cars as $car) {
            $options = $car['options'];
            unset($car['options']);

            $this->insert('{{%car}}', $car);
            $carId = (int) $this->db->getLastInsertID('car_id_seq');

            if ($options !== null) {
                $this->insert('{{%car_option}}', array_merge($options, ['car_id' => $carId]));
            }
        }
    }

    public function safeDown(): void
    {
        $this->delete('{{%car_option}}');
        $this->delete('{{%car}}');
    }
}
