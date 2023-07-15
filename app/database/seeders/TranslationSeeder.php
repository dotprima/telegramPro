<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TranslationKey;
use App\Models\Translation;
use App\Models\Language;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translationKeys = [
            'welcome_guest',
            'welcome_client',
            // Tambahkan kunci terjemahan lainnya sesuai kebutuhan
        ];

        $languages = Language::all();

        foreach ($translationKeys as $key) {
            $translationKey = TranslationKey::create(['key' => $key]);

            foreach ($languages as $language) {
                $translation = [
                    'translation_key_id' => $translationKey->id,
                    'translation' => 'welcome_guest', 
                    'language_id' => $language->id,
                ];

                Translation::create($translation);
            }
        }
    }
}
