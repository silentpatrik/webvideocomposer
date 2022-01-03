<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use WebVideo\Database\Seeders\ArgumentSeeder;
use WebVideo\Database\Seeders\CommandSeeder;
use WebVideo\Database\Seeders\FileSeeder;
use WebVideo\Database\Seeders\PageSeeder;
use WebVideo\Database\Seeders\PermissionsSeeder;
use WebVideo\Database\Seeders\ProjectOptionSeeder;
use WebVideo\Database\Seeders\ProjectSeeder;
use WebVideo\Database\Seeders\RenderPipelineSeeder;
use WebVideo\Database\Seeders\SectionSeeder;

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
