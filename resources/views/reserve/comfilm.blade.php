<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊内容確認</h3>
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
            <input type="submit" value="予約する" class="btn btn-outline-primary">
            </form>
            {{-- <div><a href="{{ route('reser') }}"></a></div> --}}
        </form>
        </div>
    </x-container>
</x-layout>