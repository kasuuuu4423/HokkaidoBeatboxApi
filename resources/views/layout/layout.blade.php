<head>
    <title>YouTube動画管理 | Hokkaido Beatbox.com</title>
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta http-equiv="Access-Control-Allow-Methods" content="GET">
    <meta http-equiv="Access-Control-Allow-Headers" content="*">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="title col-12 bg-dark text-white p-2 pt-3 pl-4">
                <h1 class="h2">YouTube動画管理 ダッシュボード</h1>
            </div>
            <header class="col-sm-2 bg-light min-vh-100">
                <div class="p-3 position-sticky top-0">
                    <div class="mb-2"><a class="text-dark" href="/playlist"><i class="fas fa-list d-inline-block me-1"></i>再生リスト管理</a></div>
                    <div class="mb-2"><a class="text-dark" href="/video"><i class="fab fa-youtube d-inline-block me-1"></i>動画管理</a></div>
                    <div class="mb-2"><a class="text-dark" href="/tag"><i class="fas fa-hashtag d-inline-block me-1"></i>タグ管理</a></div>
                </div>
            </header>
            <main class="col-sm-10 pt-5 pb-5" style="overflow-x: scroll;">
                @yield('content')
            </main>
        </div>
    </div>
</body>