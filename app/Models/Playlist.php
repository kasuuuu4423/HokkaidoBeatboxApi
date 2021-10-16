<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Original\Library\YouTube;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'youtube_id',
    ];

    public static function storeByYoutubeId($youtubeId)
    {
        $playlist = new Playlist();
        $playlist_info = YouTube::getPlaylist($youtubeId);
        $title = $playlist_info->snippet->title;
        $playlist->youtube_id = $youtubeId;
        $playlist->title = $title;
        $playlist->save();
        return ['id' => $playlist->id, 'title' => $title];
    }

    public static function updateById($id, $youtubeId)
    {
        $playlist_info = YouTube::getPlaylist($youtubeId);
        $title = $playlist_info->snippet->title;
        $playlist = Playlist::findOrFail($id);
        $playlist->update([
            'youtube_id' => $youtubeId,
            'title' => $title,
        ]);
        return ['id' => $id, 'title' => $title];
    }
}
