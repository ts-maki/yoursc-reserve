<x-layout>
    <x-container>
        <h2 class="fs-2">TOPページ</h2>
        @if (session('complete_inquiry'))
            <p>{{ session('complete_inquiry') }}</p>
        @endif
        <div class="">
            <a href="{{ route('access.index') }}" class="btn btn-outline-primary">アクセス案内</a>
        </div>
        <div class="">
            <a href="{{ route('inquiry.index') }}" class="btn btn-outline-primary">お問い合わせ</a>
        </div>
        <div class="">
            <a href="{{ route('plan.index') }}" class="btn btn-outline-primary">宿泊プラン一覧</a>
        </div>
    </x-container>
</x-layout>