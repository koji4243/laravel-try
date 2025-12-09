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
                    <h1 class="h3 my-2 text-center">
                        @if(route('create'))
                            新規登録
                        @else
                            どのように編集しますか？
                        @endif
                    </h1>
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

                    <form action="{{ route('check') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-8 ">

                                @if(route('create'))
                                    <div class="form-group mb-1">
                                        <label for="title">名前</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    </div>
                                @endif

                                <div class="form-group mb-1">
                                    <label for="title">email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="image">画像</label>
                                    <input type="file" 
                                            class="form-control" 
                                            id="imageInput" 
                                            accept="image/png"
                                            name="image" 
                                            value="{{ old('image') }}">
                                </div>
                            </div>

                            @php
                                $imgURL = session('image_temp');
                            @endphp
                            <div class="p-2 col-4 my-auto">
                                <img src="{{ $imgURL ? asset('storage/' . $imgURL) : "" }}" 
                                    width="200" 
                                    class="{{ $imgURL ? "" : "hidden" }} max-width:100% img-fluid" 
                                    id="previewImage">
                                @if (session('image_temp'))
                                    <button name="action" value="imgDelete" class="my-2 d-block mx-auto btn btn-secondary">画像取り消す</button>
                                @endif
                            </div>
                        </div>


                        <div class="form-group mb-1">
                            <label for="content">住所</label>
                            <textarea class="form-control" id="juusyo" name="juusyo">{{ old('juusyo') }}</textarea>
                        </div>
                        <div class="form-group mb-1">
                            <label for="title">電話番号</label>
                            <input type="text" class="form-control" id="tell" name="tell" value="{{ old('tell') }}">
                        </div>

                        <div class="py-2 mb-2">種別　※1つ以上選択してください<br>
                            @foreach ($categories as $category)
                                <label for="{{ $category->id }}">
                                    <input id="{{ $category->id }}" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>{{ $category->category }}
                                </label>
                            @endforeach

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
    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('previewImage');
            if(file){
                preview.classList.remove('hidden');
                preview.src = URL.createObjectURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    </script>
</body>
</html>