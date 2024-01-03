<x-layout>
    <x-container>
        @if (session('complete_inquiry'))
        <p>{{ session('complete_inquiry') }}</p>
        @endif
        <div class="mt-2">
            <a href="{{ route('access.index') }}" class="btn btn-outline-primary">アクセス案内</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('room.index') }}" class="btn btn-outline-primary">客室案内</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('inquiry.index') }}" class="btn btn-outline-primary">お問い合わせ</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('plan.index') }}" class="btn btn-outline-primary">宿泊プラン一覧</a>
        </div>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-outline-dark">管理者ページへ</a>
        </div>
        <div class="mt-4">
            <p>サイトとコードについてgithubにまとめています。</p>
            <a href="https://github.com/mirai-79/yoursc-reserve"><img src="{{ asset('/images/github-mark.svg') }}"
                    alt="githubのロゴ" width="50" class="mt-2"></a>
            <a href="https://github.com/mirai-79/yoursc-reserve" class="btn btn-outline-success mt-2">githubページへ</a>
        </div>
    </x-container>
</x-layout>