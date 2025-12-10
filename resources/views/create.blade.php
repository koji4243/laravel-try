@extends('main')

    @section('contents')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto my-4">
                    <h1 class="h3 my-2 text-center">
                        @if($users === null)
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

                    <form action="{{ $users === null ? route('check') : route('editcheck', $user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-8 ">

                                <div class="form-group mb-1">
                                    <label for="title">名前</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $users->name ?? '') }}">
                                </div>

                                <div class="form-group mb-1">
                                    <label for="title">email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $users->email ?? '') }}">
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
                            <textarea class="form-control" id="juusyo" name="juusyo">{{ old('juusyo', $users->juusyo ?? '') }}</textarea>
                        </div>
                        <div class="form-group mb-1">
                            <label for="title">電話番号</label>
                            <input type="text" class="form-control" id="tell" name="tell" value="{{ old('tell', $users->tell ?? '') }}">
                        </div>

                        <div class="py-2 mb-2">種別　※1つ以上選択してください<br>
                            @foreach ($categories as $category)
                                <label for="{{ $category->id }}">
                                    @if ($users === null)
                                        <input id="{{ $category->id }}" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>{{ $category->category }}
                                    @else
                                        <input id="{{ $category->id }}" 
                                        type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $users->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        {{ $category->category }}
                                    @endif
                                </label>
                            @endforeach

                        <button type="submit" class="ms-auto btn btn-primary d-block">確認画面へ</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
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
    @endsection
