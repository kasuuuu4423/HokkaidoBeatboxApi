
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>再生リスト登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
            <form action="/playlist" method="post">
            @elseif($target == 'update')
            <form action="/playlist/{{ $playlist->id }}" method="post">
                <input type="hidden" name="_method" value="PUT">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group mb-3">
                    <label for="id">ID</label>
                    <input disabled type="text" class="form-control" name="id" value="{{ $playlist->id }}">
                </div>
                <div class="form-group mb-3">
                    <label for="title">現在のタイトル</label>
                    <input disabled type="text" class="form-control" name="title" value="{{ $playlist->title }}">
                </div>
                <div class="form-group mb-3">
                    <label for="youtube_id">YouTube ID</label>
                    <input type="text" class="form-control" name="youtube_id" value="{{ $playlist->youtube_id }}">
                </div>
                <button type="submit" class="btn btn-success">登録</button>
                <a class="btn btn-secondary" href="/playlist">戻る</a>
            </form>
        </div>
    </div>
</div>