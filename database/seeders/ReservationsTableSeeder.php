<?php

namespace Database\Seeders;

use App\Models\Reservation;

use Illuminate\Database\Seeder;


class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 2,
            'shop_id' => 5,
            'date' => '2023-06-21',
            'time' => '18:00',
            'number' => 5,
        ];
        Reservation::create($param);
    }
}
