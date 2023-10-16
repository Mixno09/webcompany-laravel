<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\UserModel;
use Illuminate\Database\Seeder;

class UserModelSeeder extends Seeder
{
    public function run(): void
    {
        $user = UserModel::factory()
            ->for(City::factory()->create([
                'name' => 'Minsk',
                'idx' => 10,
            ]))
            ->create([
                'name' => 'Mihael',
                'surName' => 'Ivanov',
            ]);
        $user->addMedia(__DIR__ . '/avatars/avatar-1.jpg')
            ->preservingOriginal()
            ->toMediaCollection()
        ;

        $user = UserModel::factory()
            ->for(City::factory()->create([
                'name' => 'Grodno',
                'idx' => 1,
            ]))
            ->create([
                'name' => 'Nikolay',
                'surName' => 'Turchak'
            ]);
        $user->addMedia(__DIR__ . '/avatars/avatar-2.jpg')
            ->preservingOriginal()
            ->toMediaCollection()
        ;

        $user = UserModel::factory()
            ->for(City::factory()->create([
                    'name' => 'Brest',
                    'idx' => 0,
            ]))
            ->create([
                'name' => 'Eugeniy',
                'surName' => 'Undra',
            ]);
        $user->addMedia(__DIR__ . '/avatars/avatar-3.jpg')
            ->preservingOriginal()
            ->toMediaCollection()
        ;

        UserModel::factory()
            ->create([
                'name' => 'Eugeniy',
                'surName' => 'Undra',
                'city_id' => null,
            ]);
    }
}
