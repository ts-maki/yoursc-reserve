<x-layout>
    <x-container>
        <h3 class="fs-3">管理者ページ</h3>
        <div class="mt-2">
            <a href="{{ route('admin.inquiry.index') }}" class="btn btn-outline-primary">お問い合わせ</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.reserve_slot.index') }}" class="btn btn-outline-primary">予約枠</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.plan.index') }}" class="btn btn-outline-primary">宿泊プラン</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.reserve.index') }}" class="btn btn-outline-primary">予約</a>
        </div>
        <div class="mt-4">
            <a href="{{ route('top') }}" class="btn btn-outline-dark">トップに戻る</a>
        </div>
    </x-container>
</x-layout>