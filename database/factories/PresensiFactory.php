<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 12),
            'waktu_presensi' => $this->faker->time(),
            'tgl_presensi' => $this->faker->date(),
            'bukti_presensi' => $this->faker->imageUrl(640, 480, 'animals', true),
            'latitude' => $this->faker->latitude($min = -90, $max = 90),    'longitude' => $this->faker->longitude($min = -180, $max = 180),
            'created_at' => Carbon::now()->toDateTimeLocalString(),
            'updated_at' =>    Carbon::now()->toDateTimeLocalString(),
        ];
    }
}