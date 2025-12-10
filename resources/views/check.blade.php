<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内容確認</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a href="{{ route('users') }}" class="navbar-brand">アドレス帳アプリ</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto my-4">
                    <h1 class="h3 my-2 text-center">
                        @if($users === null)
                            下記の内容で登録しますか？
                        @else
                            下記の内容で更新しますか？
                        @endif
                    </h1>

                    <form action="{{ $users === null ? route('store') : route('put', $user) }}" method="POST">
                        @csrf
                        <button name="action" value="back" class="btn btn-outline-primary my-3" type="submit">&lt;戻る</button>

                        <div class="row">
                            <div class="col-8">
                                <p>名前：{{ session('create_key.name') }}</p>
                                <p>email：{{ session('create_key.email') }}</p>
                                <p>住所：{{ session('create_key.juusyo') }}</p>
                            </div>

                            @if(session('image_temp'))
                                <div class="p-2 col-4 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/' . session('image_temp')) }}" width="200" class="max-width:100% img-fluid">
                                </div>
                            @else
                                <p class="text-center p-2 col-4 ">no image</p>
                            @endif
                        </div>

                    <p>電話番号：{{ session('create_key.tell') }}</p>
                    <p>種別：
                        @foreach ($session_user['categories'] as $category)
                            <span>{{ $category }},</span>
                        @endforeach
                    </p>

                    <button name="action"  value="go" type="submit" class="ms-auto btn btn-primary d-block">登録する</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="d-flex justify-content-center align-items-center bg-light">
        <p class="text-muted small mb-0">&copy;  All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>