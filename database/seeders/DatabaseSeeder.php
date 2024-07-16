<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Site;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $sites = Site::factory(15)->create();

        $profile = Profile::create([
            'id' => 1,
            'name' => 'master',
        ]);

        foreach ($sites as $site) {
            $site->profiles()->attach($profile);
        }
    }
}
