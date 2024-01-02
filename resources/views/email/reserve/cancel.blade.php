<x-mail::message>
### 宿泊予約をキャンセルしました<br>
またのご予約をお待ちしております<br><br>
### 予約情報<br>

宿泊プラン: {{ $reserve->plan->title }}<br>
予約日: {{ $reserve->reserveSlot->date }}<br>
部屋タイプ: {{ $reserve->reserveSlot->room->name }}<br>

{{ config('app.name') }}
</x-mail::message>