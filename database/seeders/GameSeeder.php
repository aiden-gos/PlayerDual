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
            'League of Legends' => 'https://upanh.vn-z.vn/images/2018/11/10/lol.jpg',
            'PUBG Mobile' => 'https://c4.wallpaperflare.com/wallpaper/320/205/156/pubg-mobile-wallpaper-preview.jpg',
            'PUBG PC' => 'https://images.ctfassets.net/vfkpgemp7ek3/1104843306/ef4338ea8a96a113ff97e85f13e2e9c5/pubg-mobile-hits-3-billion-lifetime-revenue.jpg',
            'Arena of Valor' => 'https://images.fpt.shop/unsafe/filters:quality(5)/fptshop.com.vn/uploads/images/tin-tuc/182805/Originals/arena-of-valor-3.jpg',
            'Wild Rift' => 'https://i.pinimg.com/originals/c1/0f/8e/c10f8e5f43ac7cd0059a0aa33c54d47a.jpg',
            'Free Fire' => 'https://cdn.tgdd.vn/Files/2023/08/31/1545294/code-free-fire-1-310823-210041.jpg',
            'Valorant' => 'https://m.media-amazon.com/images/M/MV5BNmNhM2NjMTgtNmIyZC00ZmVjLTk4YWItZmZjNGY2NThiNDhkXkEyXkFqcGdeQXVyODU4MDU1NjU@._V1_FMjpg_UX1000_.jpg',
            'Naraka Bladepoint' => 'https://didongviet.vn/dchannel/wp-content/uploads/2023/07/gioi-thieu-naraka-bladepoint-didongviet.jpg',
            'CSGO' => 'https://phongvu.vn/cong-nghe/wp-content/uploads/2018/09/csgo-free.jpg',
            'Dota 2' => 'https://cdn.akamai.steamstatic.com/apps/dota2/images/dota2_social.jpg',
            'Call of Duty' => 'https://wallpapers.com/images/featured/call-of-duty-pictures-7lrqnchbx478ucgg.jpg',
            'GTA V' => 'https://images7.alphacoders.com/439/439636.jpg',
            'Other' => 'https://t4.ftcdn.net/jpg/04/42/21/53/360_F_442215355_AjiR6ogucq3vPzjFAAEfwbPXYGqYVAap.jpg'
        ];

        foreach ($games as $name => $img) {
            DB::table('games')->insert([
                'name' => $name,
                'img' => $img
            ]);
        }
    }
}
