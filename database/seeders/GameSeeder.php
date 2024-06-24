<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            'Liên Minh Huyền Thoại' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__f364f2e0-34ce-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Đấu Trường Chân Lý' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__a844a8e0-34cf-11ed-838c-b120e70abb59__game_avatars.jpg',
            'PUBG Mobile' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__c5802ad0-33e2-11ed-838c-b120e70abb59__game_avatars.jpg',
            'PUBG PC' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__53121480-33e3-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Liên Quân Mobile' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__3b5dac30-34d0-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Liên Minh Tốc Chiến' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__3b5dac30-34d0-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Free Fire' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__99a18050-34d5-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Valorant' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__39932230-34cc-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Naraka Bladepoint' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__5dd9f670-34d4-11ed-838c-b120e70abb59__game_avatars.jpg',
            'CSGO' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__f79153d0-33e4-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Dota 2' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__40daec90-33e5-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Call of Duty' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__e671c440-34d4-11ed-838c-b120e70abb59__game_avatars.jpg',
            'GTA V' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__38084d60-34d5-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Hát' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__62295df0-34d5-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Tâm Sự' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__4bb638e0-33f9-11ed-838c-b120e70abb59__game_avatars.jpg',
            'Khác' => 'https://playerduo.net/api/upload-service/game_avatars/715867c6-698f-411a-b4f9-1e9093130b60__d8d57300-37bc-11ed-838c-b120e70abb59__game_avatars.jpg'
        ];

        foreach ($games as $name => $img) {
            DB::table('games')->insert([
                'name' => $name,
                'img' => $img
            ]);
        }
    }
}
