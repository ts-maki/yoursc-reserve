<x-layout>
    <x-container>
        <h3 class="fs-3">予約一覧</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>予約日</th>
                    <th>プラン</th>
                    <th>部屋名</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($reserves as $index =>$reserve)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reserve->reserveSlot->date }}</td>
                    <td>{{ $reserve->plan->title }}</td>
                    <td>{{ $reserve->reserveSlot->room->name }}</td>
                    <td class="btn btn-outline-primary"><a href="{{ route('admin.reserve.show', $reserve->id) }}">詳細</a></td>
                </tr>
                @endforeach
            </tbody>
            </tbody>
        </table>
    </x-container>
</x-layout>