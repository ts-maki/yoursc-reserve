<x-layout>
    <x-container>
        <h3 class="fs-3">予約詳細</h3>
        <div>
            <div class="d-flex">
                <p>予約日</p>
                <p class="border p-2 rounded">{{ $reserve->reserveSlot->date }}</p>
            </div>
            <div class="d-flex">
                <p>プラン</p>
                <p class="border p-2 rounded">{{ $reserve->plan->title }}</p>
            </div>
            <div class="d-flex">
                <p>部屋名</p>
                <p class="border p-2 rounded">{{ $reserve->reserveslot->room->name }}</p>
            </div>
            <div class="d-flex">
                <p>名前</p>
                <p class="border p-2 rounded">{{ $reserve->first_name }} {{ $reserve->last_name }}</p>
            </div>
            <div class="d-flex">
                <p>メールアドレス</p>
                <p class="border p-2 rounded">{{ $reserve->email }}</p>
            </div>
            <div class="d-flex">
                <p>住所</p>
                <p class="border p-2 rounded">{{ $reserve->address }}</p>
            </div>
            <div class="d-flex">
                <p>電話番号</p>
                <p class="border p-2 rounded">{{ $reserve->telephone_number }}</p>
            </div>
            <div class="d-flex">
                <p>メッセージ</p>
                <p class="border p-2 rounded">{{ $reserve->message }}</p>
            </div>
            <form action="{{ route('admin.reserve.delete', $reserve->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="キャンセル" class="btn btn-outline-danger">
            </form>
        </div>
    </x-container>
</x-layout>