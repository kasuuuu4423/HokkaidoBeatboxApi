@extends('layout/layout')
@section('content')
<div class="container ops-main">
<div class="row">
    <div class="col-md-12">
        <h3 class="ops-title"><i class="fab fa-youtube d-inline-block me-3"></i>動画一覧</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-11 col-md-offset-1">
        <table class="table text-center">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">YouTube ID</th>
            <th class="text-center">タイトル</th>
            <th class="text-center">サムネイル</th>
            <th class="text-center">プレイリスト名</th>
            <th class="text-center">タグ</th>
            <th class="text-center">削除</th>
        </tr>
        @foreach($result as $video)
        <tr>
            <td>
                <a href="/video/{{ $video->id }}/edit">{{ $video->id }}</a>
            </td>
            <td>{{ $video->youtube_id }}</td>
            <td>{{ $video->title }}</td>
            <td style="width: 200px;"><img class="w-100" src="{{ $video->thumbnail }}" alt=""></td>
            <td>{{ $video->playlist_title }}</td>
            <td>
                <form action="/video/{{ $video->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-s btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash h6">削除</span></button>
                </form>
            </td>
        </tr>
        @endforeach
        </table>
        <div><a href="/video/create" class="btn btn-success">新規作成</a></div>
    </div>
</div>
@endsection