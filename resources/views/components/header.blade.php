<header class="bg-success text-dark bg-opacity-10">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('top') }}" class="d-flex justify-content-between align-items-center">
            <h1 class="fs-4 fw-bold">宿泊<span class="header__title"></span>予約サイト</h1>
        </a>
        <nav class="navbar">
            <ul class="d-flex">
                @guest
                <li class="nav-item"><a class="nav-link active text-dark p-2" aria-current="page"
                    href="{{ route('login') }}">ログイン</a></li>
            <li class="nav-item">
                @endguest
                @auth
                {{-- <li class="nav-item"><a class="nav-link active text-dark p-2" aria-current="page"
                        href="{{ route('profile.edit') }}">アカウント設定</a></li> --}}
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="nav-link p-2">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
                    </form>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('plan.index') }}">宿泊プラン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('room.index') }}">客室紹介</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('inquiry.index') }}">お問い合わせ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('access.index') }}">アクセス案内</a>
                </li>
            </ul>
        </nav>
    </div>
</header>