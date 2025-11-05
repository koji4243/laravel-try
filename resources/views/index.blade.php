<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アドレス帳一覧</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <style>

    </style>
    <header>
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a href="{{ route('users') }}" class="navbar-brand">アドレス帳アプリ</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
        <h1 class="h3 my-3 text-center">アドレス帳一覧</h1>

        <div>
            <a href="{{ route('create') }}" class="m-2 btn btn-primary text-decoration-none">新規登録</a>
        </div>

            <table class="table my-2 d-block">
                <thead>
                    <tr>
                        <th>名前：</th>
                        <th>email：</th>
                        <th>住所：</th>
                        <th>電話番号：</th>
                        <th>種別:</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->juusyo }}<br>

                            <div class="d-flex my-2">
                                <a href="" class="btn btn-outline-info d-block me-1">詳細</a>
                                <a href="" class="btn btn-outline-warning  d-block me-1">編集</a>
                                <form action="" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">削除</button>
                                </form>
                            </div>
                        </td>
                        <td>{{ $user->tell }}</td>
                        <td>{{ $user->category_id}}</td>
                    </tr>

                    @empty
                    <p>登録がありません</p>
                @endforelse

                </tbody>


                        <div class="d-flex">
                            <a href="{{ route('show', $user)}}" class="btn btn-outline-info d-block me-1">詳細</a>
                            <a href="" class="btn btn-outline-warning  d-block me-1">編集</a>

                            <form action="" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">削除</button>
                            </form>
                        </div>

                        
                </div>
            </table>
        </div>


    </main>
    
    <footer class="d-flex justify-content-center align-items-center bg-light">
        <p class="text-muted small mb-0">&copy;  All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>