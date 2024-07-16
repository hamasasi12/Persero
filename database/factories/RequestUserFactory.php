<?php

namespace Database\Factories;

use App\Models\RequestUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestUserFactory extends Factory
{
    protected $model = RequestUser::class;

    public function definition()
    {
        return [
            'nup' => $this->faker->randomNumber(),
            'nama' => $this->faker->name,
            'divisi' => $this->faker->word,
            'no_hp' => $this->faker->phoneNumber,
            'kategori_req' => $this->faker->word,
            'deskripsi_req' => $this->faker->text,
            'alasan_req' => $this->faker->text,
            'upload_gambar' => null,
            'upload_file' => null,
            'teknisi' => null,
        ];
    }
}