<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistsTableSeeder extends Seeder
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
                'youtube_id' => 'PLl0Bb9jszHYWcyreyM2X0uFPvLvj7F_q0',
            ],
        ];

        // 登録
        foreach($books as $book) {
            \App\Models\Video::create($book);
        }
    }
}
