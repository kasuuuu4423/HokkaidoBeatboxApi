@extends('layout/layout')
@section('content')
<div class="container ops-main">
<div class="row">
    <div class="col-md-12">
        <h3 class="ops-title"><i class="fas fa-hashtag d-inline-block me-3"></i>タグ一覧</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-11 col-md-offset-1">
        <table class="table text-center">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">タグ名</th>
            <th class="text-center">削除</th>
        </tr>
        @foreach($tags as $tag)
        <tr>
            <td>
                <a href="/tag/{{ $tag->id }}/edit">{{ $tag->id }}</a>
            </td>
            <td>{{ $tag->name }}</td>
            <td>
                <form action="/tag/{{ $tag->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-s btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash h6">削除</span></button>
                </form>
            </td>
        </tr>
        @endforeach
        </table>
    </div>
</div>
@endsection