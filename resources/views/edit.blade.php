<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>

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
                    <h1 class="h3 my-2 text-center">どのように編集しますか？</h1>
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

                    <form action="{{ route('editcheck', $users) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group mb-1">
                                    <label for="title">名前</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name' , $users->name) }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="title">email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $users->email) }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="content">住所</label>
                                    <textarea class="form-control" id="juusyo" name="juusyo">{{ old('juusyo', $users->juusyo) }}</textarea>
                                </div>
                            </div>
                            <div class="col-4 text-center p-2">
                                <h6 class="mt-2">現在の画像</h6>

                                <input type="hidden" name="current_image" value="{{ $users->image }}">
                                @if(!$users->image)
                                    <p class="mt-3">no image</p>
                                    <button type="button"  class="m-2 btn btn-secondary">画像選択</button>
                                @else
                                    @if(session('image_temp'))
                                        <img src="{{ asset('storage/' . session('image_temp')) }}">
                                    @else
                                        <div width="150" height="300">
                                            <img src="{{ asset('storage/' . $users->image) }}" 
                                            class="max-width:100% img-fluid" 
                                            id="previewImage"
                                            alt="">
                                        </div>
                                        <label type="button" id="uploadBtn" class="m-2 btn btn-outline-warning">画像を変更する</label>
                                        <input type="file" name="image" id="imageInput" accept="image/png" style="display:none;" class="uploadBtn">
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-1">
                            <label for="title">電話番号</label>
                            <input type="text" class="form-control" id="tell" name="tell" value="{{ old('tell', $users->tell) }}">
                        </div>
                        <div class="py-2 mb-2">種別　※1つ以上選択してください<br>
                            @foreach ($categories as $category)
                                <label for="{{ $category->id }}">
                                    <input id="{{ $category->id }}" 
                                        type="checkbox" name="categories[]" 
                                        value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $users->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    {{ $category->category }}
                                </label>
                            @endforeach
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
    <script>
        const fileInput = document.getElementById('imageInput');
        const btn = document.getElementById('uploadBtn');

        btn.addEventListener('click', () => {
            fileInput.click(); // ファイル選択ダイアログを開く
        });
        fileInput.addEventListener('change', function(){
            const file = this.files[0];
            if(file){
                const preview = document.getElementById('previewImage');
                preview.src = URL.createObjectURL(file);
            }
        });
    </script>
</body>
</html>