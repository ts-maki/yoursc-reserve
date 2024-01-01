@php
if (session()->has('plan_reserve')) {
$session_reserve = session('plan_reserve');
}
@endphp
<x-layout>
    <x-container>
        <div>
            <div class="row">
                @if (!empty($plan_reserve->plan->images[0]))
                @foreach ($plan_reserve->plan->images as $image)
                <img src="{{ asset($image->path) }}" alt="{{ $plan_reserve->plan->title }}プランの画像" class="w-50"
                    class="col">
                @endforeach
                @endif
            </div>
            <h4 class="fs-4">{{ $plan_reserve->plan->title }}</h4>
            <div class="">
                <p>予約日:{{ $plan_reserve->reserveSlot->date }}</p>
                <p>料金:{{ $plan_reserve->fee }}円</p>
                <p>部屋タイプ:{{ $plan_reserve->reserveSlot->room->name }}</p>
            </div>
            <form action="{{ route('reserve.comfilm') }}" method="post">
                @csrf
                {{-- 画面に表示しない確認画面やDBに必要な情報をheddenでわたす --}}
                <input type="hidden" name="plan_id" value="{{ $session_reserve['plan_id'] ?? $plan_reserve->plan->id }}">
                <input type="hidden" name="reserve_slot_id" value="{{ $session_reserve['reserve_slot_id'] ??$plan_reserve->reserve_slot_id }}">
                <input type="hidden" name="title" value="{{ $session_reserve['title'] ?? $plan_reserve->plan->title }}">
                <input type="hidden" name="date" value="{{ $session_reserve['date'] ?? $plan_reserve->reserveSlot->date }}">
                <div>
                    <label for="first_name">姓</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $session_reserve['first_name'] ?? '' }}">
                </div>
                <div>
                    <label for="last_name">名</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $session_reserve['last_name'] ?? '' }}">
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{ $session_reserve['email'] ?? '' }}">
                </div>
                <div>
                    <label for="address">住所</label>
                    <input type="text" name="address" id="address" value="{{ $session_reserve['address'] ?? '' }}">
                </div>
                <div>
                    <label for="tel">電話番号</label>
                    <input type="tel" name="tel" id="tel" value="{{ $session_reserve['tel'] ?? '' }}">
                </div>
                <div>
                    <label for="message">ホテルへメッセージ</label>
                    <div><textarea name="message" id="" cols="90" rows="10" id="message">{{ $session_reserve['message'] ?? '' }}</textarea></div>
                </div>
                <input type="submit" value="入力内容の確認" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>