<x-mail::message>
### 宿泊予約が完了しました<br>
当館をご予約いただきありがとうございます。
当日お気をつけてお越しください<br><br>
### 予約情報<br>

宿泊プラン: {{ $reserve->plan->title }}<br>
予約日: {{ $reserve->reserveSlot->date }}<br>
部屋タイプ: {{ $reserve->reserveSlot->room->name }}<br>

お客様のお越しを楽しみにしております。
天気のいい日に満天の星空を望めますように。

{{ config('app.name') }}
</x-mail::message>
