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
                    <th>料金</th>
                    <th>部屋の数</th>
                    <th>予約ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reserve_slots as $index => $reserve_slot)
                <tr>
                    <th>{{ $index + 1 }}</th>
                    <th><select name="room" id=""></select></th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-container>
</x-layout>