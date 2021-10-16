<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->truncate();

        $books = [
            [
                'youtube_id' => 'Fagekv3vxoQ',
                'title' => 'お説教しておきました',
                'thumbnail' => 'http://img.youtube.com/vi/Fagekv3vxoQ/mqdefault.jpg',
                'views' => 2222,
                'comments' => 154,
                'post_at' => '2021-03-19'
            ],
        ];

        // 登録
        foreach($books as $book) {
            \App\Models\Video::create($book);
        }
    }
}
