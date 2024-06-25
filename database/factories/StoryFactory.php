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
        $link = [
            'https://res.cloudinary.com/dsicdcjye/video/upload/v1719272698/5d8c3ed8-fd0a-48d4-b2ff-e1595850708e__583109f5-676b-4fb2-9f36-74eb265107d9__post_video_fpv1cv.mov',
            'https://res.cloudinary.com/dsicdcjye/video/upload/v1719272665/0f951d2a-3cb0-42da-a88f-ad1a8482af8a__e90d1ffc-58ec-4354-ae21-cc957fe209a7__post_video_nkgxvm.mov',
            'https://res.cloudinary.com/dsicdcjye/video/upload/v1719272659/44fa3a38-5c97-4453-9f82-13cf6fc14afb__32d1ce55-0f36-4336-afca-4e0fd5c435eb__post_video_rbaf4y.mov',
            'https://res.cloudinary.com/dsicdcjye/video/upload/v1719272587/545161a1-cec5-4f40-bf0e-9d53d2b28bb3__f949776f-1c0b-4366-b18e-0f8040402ac7__post_video_g7n8lq.mov',
            'https://res.cloudinary.com/dsicdcjye/video/upload/v1719272569/48f29412-828c-4309-a547-addd634d2c55__66c27932-206d-4077-9887-07d67409fd9a__post_video_awrpeh.mov'
        ];

        return [
            'title' => fake()->title(),
            'video_link' => $link[array_rand($link)],
            'content' => fake()->name(),
            'user_id' => random_int(1, 105),
            'view' => random_int(1, 1000),
            'like' => random_int(1, 1000)
        ];
    }
}
