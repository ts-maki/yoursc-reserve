<x-layout>
    <x-container>
        <div class="">
            <a href="{{ route('admin.inquiry.index') }}" class="btn btn-outline-primary">お問い合わせ一覧</a>
        </div>
        <div class="">
            <a href="{{ route('admin.reserve_slot.index') }}" class="btn btn-outline-primary">予約枠一覧</a>
        </div>
        <div class="">
            <a href="{{ route('admin.plan.index') }}" class="btn btn-outline-primary">宿泊プラン一覧</a>
        </div>
        <div class="">
            <a href="{{ route('admin.reserve.index') }}" class="btn btn-outline-primary">宿泊プラン一覧</a>
        </div>
    </x-container>
</x-layout>