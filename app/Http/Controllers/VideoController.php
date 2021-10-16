<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Tag;
use App\Models\Video;
use Original\Library\YouTube;
use Illuminate\Database\Eloquent\Collection;

class VideoController extends Controller
{
    public function withTag(Request $request)
    {
        $videos = Video::all();
        $flgReq = false;
        if($request->tag){
            $flgReq = true;
            $tags = $request->tag;
            $tags = explode(',', $tags);
            $mTag = Tag::find($tags);
            if($mTag->count() > 0){
                //最初のタグの動画を取得し，以降比較し共通項を取得
                $videos = $mTag->get(0)->videos()->get();
                for($i = 1; $i < $mTag->count(); $i++){
                    $videosByTag = $mTag->get($i)->videos()->get();
                    $videos = $videos->intersect($videosByTag);
                }
            }
        }
        $videos = $videos->toArray();
        $arrayDate = array_map(function($video){
            return $video['post_at'];
        }, $videos);
        $arrayViews = array_map(function($video){
            return $video['views'];
        }, $videos);
        $arrayCommnets = array_map(function($video){
            return $video['comments'];
        }, $videos);
        if($request->order){
            $flgReq = true;
            $order = $request->order;
            switch($order){
                case 'new':
                    array_multisort($arrayDate, SORT_DESC, $videos);
                    break;
                case 'old':
                    array_multisort($arrayDate, SORT_ASC, $videos);
                    break;
                case 'popular':
                    array_multisort($arrayViews, SORT_DESC, $videos);
                    break;
                case 'comment':
                    array_multisort($arrayCommnets, SORT_DESC, $videos);
                    break;
            }
        }
        $videos = array_map(function($video){
            $videoId = $video['id'];
            $tags = Video::find($videoId)->tags()->get()->toArray();
            return $video + ['tags' => $tags];
        }, $videos);
        $limit = $request->limit?$request->limit:16;
        $offset = $request->offset?$request->offset:0;
        if(count($videos) > $limit){
            $videos = array_chunk($videos, $limit);
            $videos = isset($videos[$offset]) ? $videos[$offset] : false;
        }
        else if($offset > 0){
            $videos = false;
        }
        return response()->json($videos);
    }

    public function index()
    {
        $videos = Video::all();
        $result = [];
        foreach($videos as $index => $video){
            $playlistTitle = "";
            if($video->playlist_id != null){
                $playlist = Playlist::find($video->playlist_id);
                $playlistTitle = $playlist->title;
            }
            $result[] = (object)[
                'id' => $video->id,
                "youtube_id" => $video->youtube_id,
                "title" => $video->title,
                "thumbnail" => $video->thumbnail,
                "views" => $video->views,
                "comments" => $video->comments,
                "post_at" => $video->post_at,
                "playlist_id" => $video->playlsit_id,
                "playlist_title" => $playlistTitle,
            ];
        }
        return view('video/index', compact('result'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        
        return view('video/edit', compact('video'));
    }

    public function create()
    {
        $video = new Video();
        return view('video/create', compact('video'));
    }
    
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect("/video");
    }

    public function store(Request $request)
    {
        $post = Video::create($request->all());

        if ($post) {
            $result = json_encode([
                "status" => "suucess",
                "data" => $post,
            ]);
            return view('video/result', compact('result'));
        } else {
            $result = json_encode([
                "status" => "failed",
            ]);
            return view('video/result', compact('result'));
        }
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $youtubeId = $request->youtube_id;

        $youtube = new YouTube();
        $videoInfos = $youtube->getVideosById($youtubeId);
        $info = $videoInfos[0];
        $title = $info->snippet->title;
        $thumbnail = $info->snippet->thumbnails->high->url;
        $views = $info->statistics->viewCount;
        $comments = $info->statistics->commentCount;
        $postAt = $info->snippet->publishedAt;

        $video->youtube_id = $youtubeId;
        $video->title = $title;
        $video->thumbnail = $thumbnail;
        $video->views = $views;
        $video->comments = $comments;
        $video->post_at = explode('T',$postAt)[0];
        $video->save();

        return redirect("/video");
    }
}
