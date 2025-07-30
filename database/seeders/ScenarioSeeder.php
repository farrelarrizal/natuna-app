<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Scenario;
use Illuminate\Support\Facades\DB;
use App\Models\ModelSD;


class ScenarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Scenario::factory()->create([
            'sfd_id' => 1,
            'name' => 'Default Scenario',
            'desc' => 'This is a default scenario for testing purposes.',
            'timestep' => 60,
        ]);
        // create additional scenarios as needed
        ModelSD::create([
            'name' => 'Default Model',
            'desc' => 'This is a default model for testing purposes.',
            'image' => 'default_model_image.png',
            'pathfile' => 'default_model_file_path',
            'final_step' => 60,
            'is_active' => 1,
        ]);
    }

}
