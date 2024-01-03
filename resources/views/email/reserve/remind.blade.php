<x-mail::message>
{{ $previous_reserve->first_name }}様<br>
予約前日のご連絡です。<br>
お越しをお待ちしております。

### 予約情報<br>

宿泊プラン: {{ $previous_reserve->plan->title }}<br>
予約日: {{ $previous_reserve->reserveSlot->date }}<br>
部屋タイプ: {{ $previous_reserve->reserveSlot->room->name }}<br>
</x-mail::message>
