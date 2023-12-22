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
                            {{-- <option value="{{ $room_type->id }}" {{ $reserve_slot-> ==  }}>{{ $room_type->name }}</option> --}}
                        @endforeach
                        <option value="{{ $reserve_slot->room_id }}"></option>
                    </select>
                </div>
            </form>
        </div>
    </x-container>
</x-layout>