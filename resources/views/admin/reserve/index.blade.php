<x-layout>
    <x-container>
        <h3 class="fs-3">予約一覧</h3>
        <div>
            <h4 class="fs-4">予約日検索</h4>
            <form action="{{ route('admin.reserve.filter') }}" method="get">
                <input type="date" name="from" id="" value="{{ $from ?? now()->todateString() }}">
                <span>～</span>
                <input type="date" name="to" id="" value="{{ $to ?? '' }}">
                <input type="submit" value="検索" class="btn btn-outline-primary">
            </form>
            <div class="mt-2">
                <a href="{{ route('admin.reserve.filter.today') }}" class="btn 
                @if (Str::afterLast(url()->current(), '/') === 'today')
                btn-primary
                @else
                btn-outline-primary
                @endif
                ">今日</a>
                <a href="{{ route('admin.reserve.filter.tomorrow') }}" class="btn 
                @if (Str::afterLast(url()->current(), '/') === 'tomorrow')
                btn-primary
                @else
                btn-outline-primary
                @endif
                ">明日</a>
            </div>
        </div>
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
                    <td class="btn btn-outline-primary"><a href="{{ route('admin.reserve.show', $reserve->id) }}">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </tbody>
        </table>
    </x-container>
</x-layout>