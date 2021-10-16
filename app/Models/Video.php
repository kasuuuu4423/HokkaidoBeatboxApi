<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'youtube_id',
        'title',
        'thumbnail',
        'views',
        'comments',
        'post_at',
        'playlist_id',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function updateOrInsert($id, $videoData, $playlistId = null)
    {
        $row = Video::where('youtube_id', $id);
        if($row->count() > 0){
            $row->update([
                'youtube_id' => $id,
                'title' => $videoData->snippet->title,
                'thumbnail' => $videoData->snippet->thumbnails->high->url,
                'views' => $videoData->statistics->viewCount,
                'comments' => property_exists($videoData->statistics, 'commentCount')?$videoData->statistics->commentCount:0,
                'post_at' => explode('T', $videoData->snippet->publishedAt)[0],
                'playlist_id' => $playlistId,
            ]);
            return  $row->get()[0]->id;
        }
        else{
            $mVideo = new Video();
            $mVideo->youtube_id = $id;
            $mVideo->title = $videoData->snippet->title;
            $mVideo->thumbnail = $videoData->snippet->thumbnails->high->url;
            $mVideo->views = $videoData->statistics->viewCount;
            $mVideo->comments = property_exists($videoData->statistics, 'commentCount')?$videoData->statistics->commentCount:0;
            $mVideo->post_at = explode('T', $videoData->snippet->publishedAt)[0];
            $mVideo->playlist_id = $playlistId;
            $mVideo->save();
            return $mVideo->id;
        }
    }
}
