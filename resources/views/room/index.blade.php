<x-layout>
    <x-container>
        <h2 class="fs-2">客室一覧</h2>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>部屋名</th>
                        <th>特徴</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $index => $room)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <a href="{{ route('top') }}" class="btn btn-outline-dark">戻る</a>
        </div>
    </x-container>
</x-layout>