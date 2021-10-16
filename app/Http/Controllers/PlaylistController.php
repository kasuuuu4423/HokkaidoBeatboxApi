<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Original\Library\YouTube;
use SebastianBergmann\Environment\Console;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all();
        return view('playlist/index', compact('playlists'));
    }

    public function edit($id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('playlist/edit', compact('playlist'));
    }

    public function create()
    {
        $playlist = new Playlist();
        return view('playlist/create', compact('playlist'));
    }

    public function store(Request $request)
    {
        $playlist_info = Playlist::storeByYoutubeId($request->youtube_id);
        $title = $playlist_info['title'];
        $playlist_id = $playlist_info['id'];

        $videos = YouTube::getVideosByPlaylist($request->youtube_id);
        $videos = array_map(function($video){
            return [
                'youtubeId' => $video->snippet->resourceId->videoId,
                'data' => YouTube::getVideosById($video->snippet->resourceId->videoId)[0],
            ];
        }, $videos);
        $dbPlaylistIds = Playlist::where('youtube_id', $request->youtube_id)->get('id')->toArray();
        $dbVideos = Video::whereIn('playlist_id', $dbPlaylistIds)->get()->toArray();
        $dbVideos = array_map(function($video){
            //ドキュメントの配列幸三をもとに作成
            //その後比較
            return [
                'youtubeId' => $video['youtube_id'],
                'data' => $video,
                'flgRefed' => false,
            ];
        }, $dbVideos);

        $video_ids = [];
        foreach($videos as $index => $video){
            if($key = array_search($video['youtubeId'], array_column($dbVideos, 'youtubeId'))){
                //既存の動画
                $dbVideos[$key]['flgRefed'] = true;
            }
            $video_ids[] = Video::updateOrInsert($video['youtubeId'], $video['data'], $playlist_id);
        }
        foreach($dbVideos as $dbVideo){
            if(!$dbVideo['flgRefed']){
                $video = Video::findOrFail($dbVideo['data']['id']);
                $video->tags()->detach();
                $video->delete();
            }
        }

        $tag = new Tag();
        $tag = $tag->create([
            'name' => $title,
        ]);
        $tag->videos()->sync($video_ids);

        return redirect("/playlist");
    }

    public function update(Request $request, $id)
    {
        $playlist_info = Playlist::updateById($id, $request->youtube_id);
        $playlist_id = $playlist_info['id'];
        $title = $playlist_info['title'];

        $videos = YouTube::getVideosByPlaylist($request->youtube_id);
        $videos = array_map(function($video){
            return [
                'youtubeId' => $video->snippet->resourceId->videoId,
                'data' => YouTube::getVideosById($video->snippet->resourceId->videoId)[0],
            ];
        }, $videos);
        $dbPlaylistIds = Playlist::where('youtube_id', $request->youtube_id)->get('id')->toArray();
        $dbVideos = Video::whereIn('playlist_id', $dbPlaylistIds)->get()->toArray();
        $dbVideos = array_map(function($video){
            return [
                'youtubeId' => $video['youtube_id'],
                'data' => $video,
                'flgRefed' => false,
            ];
        }, $dbVideos);

        $video_ids = [];
        $diff_ids = [];
        foreach($videos as $index => $video){
            if($key = array_search($video['youtubeId'], array_column($dbVideos, 'youtubeId'))){
                //既存の動画
                $dbVideos[$key]['flgRefed'] = true;
            }
            $video_ids[] = Video::updateOrInsert($video['youtubeId'], $video['data'], $playlist_id);
        }
        foreach($dbVideos as $dbVideo){
            if(!$dbVideo['flgRefed']){
                $video = Video::findOrFail($dbVideo['data']['id']);
                $video->tags()->detach();
                $video->delete();
            }
        }

        $tag = new Tag();
        $tag = $tag->create([
            'name' => $title,
        ]);
        $tag->videos()->sync($video_ids);

        return redirect("/playlist");
    }

    public function destroy($id)
    {
        $videos = Video::where('playlist_id', $id)->get();
        foreach($videos as $video){
            $video->tags()->detach();
            $video->delete();
        }

        $playlist = Playlist::findOrFail($id);
        $playlist->delete();

        return redirect("/playlist");
    }
}
