<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $avatar = [
            'https://canhquannhaxanh.com/wp-content/uploads/2023/05/avatar-gai-xinh-41.jpg',
            'https://meliawedding.com.vn/wp-content/uploads/2022/03/avatar-gai-xinh-10.jpg',
            'https://www.vietnamfineart.com.vn/wp-content/uploads/2023/03/avatar-gai-xinh-17.jpg',
            'https://chungcuhatecolaroma.net.vn/wp-content/uploads/2022/10/anh-avatar-dep-cho-con-gai-1.jpg',
            'https://cdn.thoitiet247.edu.vn/wp-content/uploads/2024/04/hinh-anh-nu-ngau-lanh-lung-nguoi-that-1.jpg',
            'https://gcs.tripi.vn/public-tripi/tripi-feed/img/474115XWc/avatar-anh-gai-xinh-k10-dang-yeu_040402672.jpg',
            'https://meliawedding.com.vn/wp-content/uploads/2022/03/avatar-gai-xinh-51.jpg',
            'https://gcs.tripi.vn/public-tripi/tripi-feed/img/474114ZHT/anh-avatar-gai-k10-cute-dep-nhat_040359337.jpg',
            'https://meliawedding.com.vn/wp-content/uploads/2022/03/avatar-gai-xinh-3.jpg',
            'https://i.pinimg.com/736x/02/72/0c/02720caf6cb8cd0bed63f7291a58e251.jpg',
            'https://i.pinimg.com/736x/c7/6a/7e/c76a7ea7a703d02b3f7752edcdd645e9.jpg',
            'https://tophinhanh.net/wp-content/uploads/2024/05/avatar-gai-xinh-13.jpg'
        ];

        $description = '🍨 Nhận chơi game : LIÊN MINH HUYỀN THOẠI - PUBG PC - AUDITION - GTA V - CỜ TỶ PHÚ - PROP AND SEEK - CRAB GAME - THE FOREST -SONS OF THE FOREST - LEFT 4 DEAD 2 - RAFT - HAND SIMULATOR SURVIVAI - GOOSE GOOSE DUCK - MINECRAFT - IT TAKES TWO - FARM TOGETHER ( Có thể tải game theo yêu cầu , không biết sẽ học hỏi ạ )

        🍨 Em có nhận duo combo tuần/tháng ( có khuyến mãi / tặng thêm giờ )

        🍨 Liên Minh Huyền Thoại : One champ sp , cover AD đến chết =)) ( AD , TOP ) ( Nhận cày kỉ vật ) Thách đú Aram , Thợ săn tiền thưởng =))

        🍨 Nhận treo FC Online ( 15 > 30 trận )

        🍨 PUBG PC : Game này tớ đang tập chơi , tự lo cho bản thân được , lâu lâu cũng bị ngu , công láo =)))

        🍨 NHẬN : Call - nhắn tin - mở nhạc - xem phim

        🍨 KHÔNG ON CAM - KHÔNG 18+

        🍨 KHÔNG NỢ - KHÔNG DUO TRƯỚC TRẢ SAU

        🍨 Là người hướng nội , overthinking giai đoạn cuối , nên sẽ hơi ít nói , cho nên là bạn im re tui cũng im ru luôn =)))) 😆

        🍨 Online từ : 13:00 chiều > 02:00 đêm - Qua 23h 70k/1h , ( tình trạng sức khoẻ yếu nên chỉ nhận 1 lần 2 giờ) chỉ tiêu 1 ngày 10 tiếng mong mọi người ủng hộ ạ...';

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'avatar' => $avatar[array_rand($avatar)],
            'sex' => random_int(0, 1),
            'balance' => random_int(100, 100000),
            'price' => random_int(0, 100),
            'password' => '$2y$10$CQ2t.m9p/LOJyIKvA5bSbuQYvV6hDLRx5eGeSztMbFumS4fom2316', // password
            'remember_token' => Str::random(10),
            'description' => $description,
            'title' => fake()->name(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
