<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;


class LanguagesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code' => 'en',
                'name' => 'English',
            ],
            [
                'code' => 'fr',
                'name' => 'French',
            ],
            [
                'code' => 'es',
                'name' => 'Spanish',
            ],
            [
                'code' => 'id',
                'name' => 'Indonesian',
            ],
        ];

        foreach ($data as $item) {
            Language::create($item);
        }
    }
}
