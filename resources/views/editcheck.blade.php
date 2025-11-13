<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更新画面</title>

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
                    <h1 class="h3 my-2 text-center">下記の内容で更新しますか？</h1>
                    <div class="mb-2">
                        <button onclick="history.back()" class="btn btn-outline-primary my-3">&lt; 戻る</button>
                    </div>

                    <form action="{{ route('put', $user) }}" method="POST">
                                <!-- post送信用 -->
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-1">
                            <input type="hidden" name="name" value="{{ $users['name'] }}">
                        </div>
                        <div class="form-group mb-1">
                            <input type="hidden" name="email" value="{{ $users['email'] }}">
                        </div>
                        <div class="form-group mb-1">
                            <input type="hidden" name="juusyo" value="{{ $users['juusyo'] }}">
                        </div>
                        <div class="form-group mb-1">
                            <input type="hidden" name="tell" value="{{ $users['tell'] }}">
                        </div>
                        @foreach ($users['categories'] as $category)
                            <input type="hidden" name="categories[]" value="{{ $category }}">
                        @endforeach
                                <!--　$categoryがちゃんと渡せているか確認必須　-->

                    <p>名前：{{ $users['name'] }}</p>
                    <p>email：{{ $users['email'] }}</p>
                    <p>住所：{{ $users['juusyo'] }}</p>
                    <p>電話番号：{{ $users['tell'] }}</p>
                    <p>種別：
                        @foreach ($users['categories'] as $category)
                            <span>{{ $category }},</span>
                        @endforeach
                    </p>

                    <button type="submit" class="ms-auto btn btn-primary d-block">更新する</button>
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