<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $users->each(function ($user) use ($users) {
            // Repeat the process 10 times for each user
            for ($i = 0; $i < 10; $i++) {
                // Filter out the current user to prevent them from rating themselves
                $otherUsers = $users->reject(function ($otherUser) use ($user) {
                    return $otherUser->id === $user->id;
                });

                // Ensure there is at least one other user to be the author of the rate
                if ($otherUsers->isNotEmpty()) {
                    $user->donated()->create([
                        'donating_user_id' => $otherUsers->random()->id,
                        'donated_user_id' => $user->id,
                        'message' => fake()->sentence(),
                        'price' => rand(1, 1000),
                    ]);
                }
            }
        });
    }
}
