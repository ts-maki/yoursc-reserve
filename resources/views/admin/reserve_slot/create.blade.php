<x-layout>
    <x-container>
        <h3 class="fs-3">予約枠作成</h3>
        <div>
            <form action="{{ route('admin.reserve_slot.store') }}" method="post">
                @csrf
                <div>
                    <select name="room_id" id="">
                        <option hidden>選択してください</option>
                        @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="date" name="date" id="" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}">
                </div>
                <div>
                    <input type="number" name="number_of_rooms" id="" placeholder="部屋の数" min="1" step="">
                </div>
                <input type="submit" value="登録" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>