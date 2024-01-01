<x-mail::message>
### 新規宿泊予約を受け付けました<br>

### 予約情報<br>

宿泊プラン: {{ $reserve->plan->title }}<br>
予約日: {{ $reserve->reserveSlot->date }}<br>
部屋タイプ: {{ $reserve->reserveSlot->room->name }}<br>
### お客様からのメッセージ<br>
---<br>
{{ $reserve->message }}<br>
---<br>
{{ config('app.name') }}
</x-mail::message>
