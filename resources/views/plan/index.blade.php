<x-layout>
    <x-container>
        <h2 class="fs-2">宿泊プラン一覧</h2>
        <div class="mt-2">
            <form action="{{ route('plan.filter') }}" method="get">
                <div class="plan__date">
                    @switch($date)
                    @case('today')
                    <input type="date" name="from" id="" min="{{ now()->toDateString() }}"
                        value="{{ now()->toDateString() }}"><span>～</span>
                    <input type="date" name="to" id="" min="{{ now()->toDateString() }}"
                        value="{{ now()->toDateString() }}">
                    @break
                    @case('tomorrow')
                    <input type="date" name="from" id="" min="{{ now()->toDateString() }}" value="{{ date("Y-m-d",strtotime("tomorrow")) }}"><span>～</span>
                    <input type="date" name="to" id="" min="{{ now()->toDateString() }}" value="{{ date("Y-m-d",strtotime("tomorrow")) }}">
                    @break
                    @case('filter')
                    <input type="date" name="from" id="" min="{{ now()->toDateString() }}"
                        value="{{ $from }}"><span>～</span>
                    <input type="date" name="to" id="" min="{{ date(" Y-m-d",strtotime("tomorrow")) }}"
                        value="{{ $to }}">
                    @break
                    @default
                    @endswitch
                    <input type="submit" value="検索" class="btn btn-outline-primary">
                </div>
            </form>
            <form action="{{ route('plan.filter') }}" method="get">
                <div class="mt-2">
                    @switch($date)
                    @case('today')
                    <input type="submit" value="今日" name="today" class="btn bg-primary text-white">
                    <input type="submit" value="明日" name="tomorrow" class="btn btn-outline-primary">
                    @break
                    @case('tomorrow')
                    <input type="submit" value="今日" name="today" class="btn btn-outline-primary">
                    <input type="submit" value="明日" name="tomorrow" class="btn bg-primary text-white">
                    @break
                    @case('filter')
                    <input type="submit" value="今日" name="today" class="btn btn btn-outline-primary">
                    <input type="submit" value="明日" name="tomorrow" class="btn btn-outline-primary">
                    @break
                    @default
                    @endswitch
                </div>
            </form>

        </div>
        <div class="row">
            @forelse ($plans as $plan)
            <div class="col mt-4">
                <div class="card" style="width: 18rem;">
                    @if (empty($plan->images[0]))
                    <p class="border">画像なし</p>
                    @else
                    <img src="{{ asset($plan->images[0]->path) }}" alt="宿泊プランの画像" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $plan->title }}</h5>
                        <p class="card-text">{{ $plan->description }}</p>
                        <a href="{{ route('plan.show', $plan->id) }}" class="btn btn-outline-primary">詳細</a>
                    </div>
                </div>
            </div>
            @empty
            <p>宿泊プランが登録されていません</p>
            @endforelse
        </div>
    </x-container>
</x-layout>