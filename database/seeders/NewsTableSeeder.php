<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan minimal 5 item berita
        News::create([
            'category_id' => 1, // Pastikan ID kategori ini ada
            'title' => 'Berita Teknologi Terbaru',
            'short_desc' => 'Deskripsi singkat tentang berita teknologi.',
            'content' => 'Konten lengkap tentang berita teknologi terbaru.',
            'author' => 'Penulis 1',
            'slug' => 'berita-teknologi-terbaru',
            'status' => 'active',
        ]);

        News::create([
            'category_id' => 2, // Pastikan ID kategori ini ada
            'title' => 'Berita Kesehatan Terkini',
            'short_desc' => 'Deskripsi singkat tentang berita kesehatan.',
            'content' => 'Konten lengkap tentang berita kesehatan terkini.',
            'author' => 'Penulis 2',
            'slug' => 'berita-kesehatan-terkini',
            'status' => 'active',
        ]);

        News::create([
            'category_id' => 1, // Pastikan ID kategori ini ada
            'title' => 'Inovasi Teknologi 2025',
            'short_desc' => 'Deskripsi singkat tentang inovasi teknologi.',
            'content' => 'Konten lengkap tentang inovasi teknologi di tahun 2025.',
            'author' => 'Penulis 3',
            'slug' => 'inovasi-teknologi-2025',
            'status' => 'active',
        ]);

        News::create([
            'category_id' => 3, // Pastikan ID kategori ini ada
            'title' => 'Tips Kesehatan untuk Hidup Sehat',
            'short_desc' => 'Deskripsi singkat tentang tips kesehatan.',
            'content' => 'Konten lengkap tentang tips kesehatan untuk hidup sehat.',
            'author' => 'Penulis 4',
            'slug' => 'tips-kesehatan-hidup-sehat',
            'status' => 'active',
        ]);

        News::create([
            'category_id' => 2, // Pastikan ID kategori ini ada
            'title' => 'Vaksinasi dan Kesehatan Masyarakat',
            'short_desc' => 'Deskripsi singkat tentang vaksinasi.',
            'content' => 'Konten lengkap tentang vaksinasi dan dampaknya terhadap kesehatan masyarakat.',
            'author' => 'Penulis 5',
            'slug' => 'vaksinasi-kesehatan-masyarakat',
            'status' => 'active',
        ]);
    }
}
