<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <style>
        input{
            margin-right: 2px;
        }
        label{
            margin-right: 4px;   
        }
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
            <div class="row">
                <div class="col-6 mx-auto my-4">
                    <h1 class="h3 my-2 text-center">新規登録</h1>
                    <div class="mb-2">
                        <a href="{{ route('users') }}" class="text-decoration-none">&lt; 戻る</a>
                    </div>

                    @if ($errors->any()) 
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('check') }}" method="post">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="title">名前</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-1">
                            <label for="title">email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-1">
                            <label for="content">住所</label>
                            <textarea class="form-control" id="juusyo" name="juusyo">{{ old('juusyo') }}</textarea>
                        </div>
                        <div class="form-group mb-1">
                            <label for="title">電話番号</label>
                            <input type="text" class="form-control" id="tell" name="tell" value="{{ old('tell') }}">
                        </div>

<!-- {{ $categories }} ← checkboxをforeach用で使う -->

                        <div class="py-2 mb-2">種別　※1つ以上選択してください<br>
                            <label for="namae">
                                <input id="namae" type="checkbox" name="categories[]" value="友達"
                                    {{ in_array('友達', old('categories', [])) ? 'checked' : '' }}>友達
                            </label>

                            <label for="job">
                                <input id="job" type="checkbox" name="categories[]" value="仕事"
                                    {{ in_array('仕事', old('categories', [])) ? 'checked' : '' }}>仕事
                            </label>

                            <label for="fle">
                                <input id="fle" type="checkbox" name="categories[]" value="flend"
                                    {{ in_array('flend', old('categories', [])) ? 'checked' : '' }}>flend
                            </label>

                            <label for="family">
                                <input id="family" type="checkbox" name="categories[]" value="家族"
                                    {{ in_array('家族', old('categories', [])) ? 'checked' : '' }}>家族
                            </label>

                            <label for="scho">
                                <input id="scho" type="checkbox" name="categories[]" value="学校"
                                    {{ in_array('学校', old('categories', [])) ? 'checked' : '' }}>学校
                            </label>

                            <label for="area">
                                <input id="area" type="checkbox" name="categories[]" value="地域"
                                    {{ in_array('地域', old('categories', [])) ? 'checked' : '' }}>地域
                            </label>
                        </div>

                        <button type="submit" class="ms-auto btn btn-primary d-block">確認画面へ</button>
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