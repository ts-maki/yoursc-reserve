<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊プラン作成</h3>
        <div>
            <form action="{{ route('admin.plan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title">
                </div>
                <div>
                    <p>プランに登録する画像をアップロード</p>
                    <input type="file" name="image[]" id=""multiple>
                </div>
                <div>
                    <label for="description">説明</label>
                    <div><textarea name="description" id="description" cols="70" rows="5" id="message"></textarea>
                    </div>
                </div>
                <p>予約枠</p>
                <div>
                    @foreach ($reserve_slots as $index => $reserve_slot)
                        <label class="block">
                            <input type="checkbox" name="reserve_slot[]" id="" value="{{ $reserve_slot->id }}">
                            {{ $reserve_slot->date }} :{{ $reserve_slot->room->name }}
                            <input type="number" name="reserve_slot_fee[{{ $reserve_slot->id }}]" id="" step="100" placeholder="予約枠の料金">
                        </label>
                    @endforeach
                </div>
                <input type="submit" value="作成" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>