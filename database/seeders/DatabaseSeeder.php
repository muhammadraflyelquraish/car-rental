<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->create();

        \App\Models\Brand::insert([
            [
                'id' => 1,
                'name' => 'Honda',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Toyota',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Daihatsu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Hyundai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Mitsubishi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Suzuki',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        \App\Models\Car::insert([
            [
                'id' => 1,
                'name' => 'Avanza',
                'number_plate' => 'B 3152 AF',
                'brand_id' => 1,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Sienta',
                'number_plate' => 'B 1818 YA',
                'brand_id' => 1,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Fortuner',
                'number_plate' => 'AZ 1102 AO',
                'brand_id' => 1,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'City',
                'number_plate' => 'F 2101 EK',
                'brand_id' => 2,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Accord',
                'number_plate' => 'D 2810 AO',
                'brand_id' => 2,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Brio',
                'number_plate' => 'D 322E ZK',
                'brand_id' => 2,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'name' => 'BR-V',
                'number_plate' => 'D 2410 CV',
                'brand_id' => 2,
                'launch_year' => random_int(2003, 2023),
                'mileage' => random_int(1000, 999999),
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'number_of_seat' => random_int(4, 6),
                'price_per_day' => 450000,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $accessories = [
            "Airconditions",
            "Child Seat",
            "GPS",
            "Lugage",
            "Musik",
            "Seat Belt",
            "Sleeping Bed",
            "Bluetooth",
            "On Board Computer",
            "Audio Input",
            "Long Term Trips",
            "Car Kit",
            "Remote Central Locking",
            "Climate Control",
        ];

        foreach (Car::get() as $car) {
            foreach ($accessories as $acc) {
                \App\Models\CarAccessories::create([
                    'car_id' => $car->id,
                    'name' => $acc,
                    'is_featured' => random_int(0, 1)
                ]);
            }
        }

        \App\Models\CarImage::insert([
            [
                'id' => 1,
                'car_id' => 1,
                'url' => 'avanza.png',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'car_id' => 2,
                'url' => 'sienta.png',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'car_id' => 3,
                'url' => 'fortuner.png',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'car_id' => 4,
                'url' => 'city.jpg',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'car_id' => 5,
                'url' => 'accord.jpg',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'car_id' => 6,
                'url' => 'brio.jpg',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'car_id' => 7,
                'url' => 'brv.png',
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        \App\Models\PaymentMethod::insert([
            [
                'name' => 'QRIS',
                'code' => 'qris',
                'type' => 'Other',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gopay',
                'code' => 'gopay',
                'type' => 'Ewallet',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Shopee Pay',
                'code' => 'shopeepay',
                'type' => 'Ewallet',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
