@extends('main')

    @section('contents')
        <main>
        <div class="container">
            <h1 class="h3 my-3 text-center">アドレス帳一覧</h1>

            @if(session('create'))
                <div class="text-center alert alert-success">
                    {{ session('create') }}
                </div>
            @endif
            @if(session('update'))
                <div class="text-center alert alert-success">
                    {{ session('update') }}
                </div>
            @endif
            @if(session('delete'))
                <div class="text-center alert alert-danger">
                    {{ session('delete') }}
                </div>
            @endif

            <div>
                <a href="{{ route('create') }}" class="m-2 btn btn-primary text-decoration-none">新規登録</a>
            </div>
            <table class="table my-2">
                <thead>
                    <tr>
                        <th>名前：</th>
                        <th>email：</th>
                        <th>住所：</th>
                        <th>電話番号：</th>
                        <th>種別:</th>
                        <th>画像:</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->juusyo }}<br>

                            <div class="d-flex my-2">
                                <a href="{{ route('edit',$user) }}" class="btn btn-outline-warning  d-block me-1">編集</a>
                                <form action="{{ route('delete', $user) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">削除</button>
                                </form>
                            </div>
                        </td>
                        <td>{{ $user->tell }}</td>
                        <td>
                            @foreach ($user->categories as $category)
                                <span>・{{ $category->category }}</span>
                            @endforeach
                        </td>
                    <td width="150">
                        <img class="p-2 max-width:100% img-fluid" 
                            src="{{ asset('storage/' . $user->image) }}" 
                            alt="">
                    </tr>
                    @empty
                    <p class="h4 p-2 text-center">登録がありません</p>
                @endforelse

                </tbody>
                </div>
            </table>
        </div>
    </main>
    @endsection

