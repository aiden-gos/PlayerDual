<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'video_link' => 'https://res.cloudinary.com/dsicdcjye/video/upload/v1718178748/28515c08-f319-460e-9b7b-355069b0c3a9__a2171b6c-a781-442d-86c7-5cb65e514c3e__post_video_1_o20ju8.mp4',
            'content' => fake()->name(),
            'user_id' => random_int(1, 105),
            'view' => random_int(1, 1000),
            'like' => random_int(1, 1000)
        ];
    }
}
