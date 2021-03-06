<?php

use Illuminate\Database\Seeder;

class OnboardingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filepath = base_path() . '/database/seeds/files/export.csv';
        $fileHandle = fopen($filepath, 'r');
        $count = 0;
        while (($data = fgetcsv($fileHandle, 0, ';')) !== false) {
            if ($count >= 1) {
                DB::table('users_onboarding')->insert([
                    'user_id' => $data[0],
                    'created_at' => $data[1],
                    'onboarding_percentage' => empty($data[2]) ? 0 : $data[2],
                    'count_applications' => $data[3],
                    'count_accepted_applications' => $data[4]
                ]);
            }
            $count++;
        };

    }
}
