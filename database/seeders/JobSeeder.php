<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Tag;
use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employers = Employer::factory()->count(10)->create();
        $tags = Tag::factory(10)->create();

        $employers->each(function ($employer) use ($tags) {
        
            $jobCount = rand(5, 20);

            for ($i = 0; $i < $jobCount; $i++) {
                $randomTags = $tags->random(rand(1, 3));
                $isFeatured = (bool) rand(0, 1); 
                $scheduleOptions = ['Full Time', 'Part Time'];
                $schedule = $scheduleOptions[array_rand($scheduleOptions)];

                Job::factory()->create([
                    'featured' => $isFeatured,
                    'schedule' => $schedule,    
                    'employer_id' => $employer->id,
                ])->tags()->attach($randomTags);
            }
        });
    }
}
