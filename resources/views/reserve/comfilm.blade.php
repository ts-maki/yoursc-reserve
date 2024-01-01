<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊内容確認</h3>
        @if ($is_overlap_reserve !== false)
        <h3 class="fs-3 text-danger">同じ宿泊プランと日にち、部屋タイプで既に予約済みなので予約できません</h3>
        @endif
        <h4 class="fs-4">{{ $plan_reserve['title'] }}</h4>
        <div class="d-flex">
            <p>予約日:{{ $plan_reserve['date'] }}</p>
        </div>
        <div class="">
            <p for="first_name">姓</p>
            <p>{{ $plan_reserve['first_name'] }}</p>
        </div>
        <div>
            <p>名</p>
            <p>{{ $plan_reserve['last_name'] }}</p>
        </div>
        <div>
            <p>メールアドレス</p>
            <p>{{ $plan_reserve['email'] }}</p>
        </div>
        <div>
            <p>住所</p>
            <p>{{ $plan_reserve['address'] }}</p>
        </div>
        <div>
            <p>電話番号</p>
            <p>{{ $plan_reserve['tel'] }}</p>
        </div>
        <div>
            <p>ホテルへメッセージ</p>
            <p>{{ $plan_reserve['message'] }}</p>
        </div>
        <form action="{{ route('reserve.store') }}" method="post">
            @csrf
            @if ($is_overlap_reserve == false)
            <input type="submit" value="予約する" class="btn btn-outline-primary">
            @endif
        </form>
        <div class="mt-2 btn btn-outline-primary"><a
                href="{{ route('reserve.create', ['id' => $plan_reserve['plan_id'], 'reserve_slot_id' => $plan_reserve['reserve_slot_id']]) }}">入力画面に戻る</a>
        </div>
        </form>
        </div>
    </x-container>
</x-layout>