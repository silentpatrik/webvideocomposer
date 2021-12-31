<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(ArgumentSeeder::class);
        $this->call(CommandSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ProjectOptionSeeder::class);
        $this->call(RenderPipelineSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
