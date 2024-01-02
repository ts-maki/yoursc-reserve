<x-layout>
    <x-container>
        <h3 class="fs-3">予約枠一覧</h3>
        <div>
            <a href="{{ route('admin.reserve_slot.create') }}" class="btn btn-outline-primary">新規作成</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>部屋</th>
                    <th>予約日</th>
                    <th>部屋の数</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reserve_slots as $index => $reserve_slot)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reserve_slot->room->name }}</td>
                    <td>{{ $reserve_slot->date }}</td>
                    <td>{{ $reserve_slot->number_of_rooms }}</td>
                    <td><a href="{{ route('admin.reserve_slot.edit', $reserve_slot->id) }}"
                            class="btn btn-outline-primary">編集</a></td>
                    <td>
                        <form action="{{ route('admin.reserve_slot.delete', $reserve_slot) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" class="btn btn-outline-danger">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-container>
</x-layout>