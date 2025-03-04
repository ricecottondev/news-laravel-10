<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsComment;
use App\Models\User;
use App\Models\News;
use Faker\Factory as Faker;

class NewsCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua user dan news yang ada
        $users = User::pluck('id')->toArray();
        $news = News::pluck('id')->toArray();

        if (empty($users) || empty($news)) {
            $this->command->warn("User atau News tidak tersedia. Seeder tidak dijalankan.");
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            NewsComment::create([
                'user_id' => $faker->randomElement($users),
                'news_id' => $faker->randomElement($news),
                'comment' => $faker->sentence(),
            ]);
        }
    }
}
