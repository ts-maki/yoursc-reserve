<x-layout>
    <x-container>
        <h3 class="fs-3">予約枠編集</h3>
        <div>
            <form action="{{ route('admin.reserve_slot.update', $reserve_slot->id) }}" method="post">
                @method('PUT')
                @csrf
                <div>
                    <select name="room_id" id="">
                        @foreach ($rooms as $room)
                            <option value="{{ old('room_id', $reserve_slot->room_id) }}" {{ $room->id == $reserve_slot->room_id ? 'selected' : '' }}>{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="date" name="date" id="" value="{{ old('date', $reserve_slot->date) }}" min="{{ now()->toDateString() }}">
                </div>
                <div>
                    <input type="number" name="number_of_rooms" id="" placeholder="部屋の数" min="0" step="" value="{{ old('number_of_rooms', $reserve_slot->number_of_rooms) }}">
                </div>
                <input type="submit" value="更新" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>