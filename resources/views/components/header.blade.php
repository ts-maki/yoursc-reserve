<header class="bg-success text-dark bg-opacity-10">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('top') }}" class="d-flex justify-content-between align-items-center">
            <h1 class="fs-4 fw-bold">宿泊<span class="header__title"></span>予約サイト</h1>
        </a>
        <nav class="navbar">
            <ul class="d-flex">
                @auth
                <li class="nav-item"><a class="nav-link active text-dark p-2" aria-current="page"
                        href="{{ route('profile.edit') }}">アカウント設定</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="nav-link p-2">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
                    </form>
                </li>
                @endauth
                {{-- <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('register') }}">ユーザー登録</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('stay') }}">宿泊プラン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('room') }}">客室紹介</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('inquiry') }}">お問い合わせ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('access') }}">アクセス案内</a>
                </li>
            </ul>
        </nav>
    </div>
</header>