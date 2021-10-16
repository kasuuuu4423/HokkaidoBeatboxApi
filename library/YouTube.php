<?php
namespace Original\Library;

use Original\Library\Util;
require_once(__DIR__.'/config.youtube.php');

class YouTube{
    public static function getVideosById($ids){
        $url = 'https://www.googleapis.com/youtube/v3/videos';
        $param = ['key' => KEY, 'id'=>'', 'part' => 'snippet,statistics']; 
        if(is_array($ids)){
            foreach($ids as $id){
                $param['id'] .= $id.',';
            }
        }
        else{
            $param['id'] = $ids;
        }

        $res = Util::curlGet($url, $param);
        
        return json_decode($res, false)->items;
    }

    public static function getStatisticsByVideoId($id){
        $video = YouTube::getVideosById($id);
        if(count($video) > 0){
            $video = $video[0];
        }
        //Util::pre_dump($video);
        return $video->statistics;
    }

    public static function getPlaylistItems($playlistId, $NextPageToken=null){
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems';
        $param = ['key' => KEY, 'playlistId'=>$playlistId, 'part' => 'snippet', 'maxResults' => 50, 'pageToken' => $NextPageToken];
        $res = Util::curlGet($url, $param);
        return json_decode($res, false);
    }

    public static function getVideosByPlaylist($playlistId){
        $playlistItems = YouTube::getPlaylistItems($playlistId);
        $data = $playlistItems->items;
        $NextPageToken = property_exists($playlistItems, 'nextPageToken')?$playlistItems->nextPageToken:null;
        while($NextPageToken){
            $playlistItems = YouTube::getPlaylistItems($playlistId, $NextPageToken);
            $tmpData = $playlistItems->items;
            $NextPageToken = property_exists($playlistItems, 'nextPageToken')?$playlistItems->nextPageToken:null;
            $data = array_merge($data, $tmpData);
        }
        return $data;
    }

    public static function getPlaylist($playlistId){
        $url = 'https://www.googleapis.com/youtube/v3/playlists';
        $param = ['key' => KEY, 'id'=>$playlistId, 'part' => 'snippet', 'maxResults' => 1];

        $res = Util::curlGet($url, $param);
        return json_decode($res, false)->items[0];
    }
}