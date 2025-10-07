<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\Media;

class AssignMediaToVehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = Vehicle::all();
        $media = Media::all();

        if ($media->count() > 0) {
            foreach ($vehicles as $index => $vehicle) {
                // Assign media in a round-robin fashion
                $mediaIndex = $index % $media->count();
                $vehicle->media_id = $media[$mediaIndex]->id;
                $vehicle->save();
                
                echo "Updated vehicle '{$vehicle->name}' with media '{$media[$mediaIndex]->original_name}'\n";
            }
        } else {
            echo "No media found to assign to vehicles.\n";
        }
    }
}