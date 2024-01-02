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
            <div>
                <h3 class="fs-4">メモ追加</h3>
                @if (!empty(session('completed_memo')))
                    <p class="text-success">{{ session('completed_memo') }}</p>
                @endif
                <form action="{{ route('admin.reserve.update', $reserve->id) }}" id="memo" method="post">
                    @csrf
                    @method('PUT')
                    <textarea name="memo" id="" cols="70" rows="5">{{ $reserve->memo ?? ''}}</textarea>
                </form>
                <input type="submit" value="メモを登録" class="btn btn-outline-primary" form="memo">
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.reserve.index') }}" class="btn btn-outline-primary">予約一覧に戻る</a>
            </div>
            <div class="mt-4">
                <h3 class="fs-4">予約キャンセル</h3>
                <form action="{{ route('admin.reserve.delete', $reserve->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="キャンセル" class="btn btn-outline-danger">
                </form>
            </div>
        </div>
    </x-container>
</x-layout>