<x-mail::message>
{{ $inquiry->first_name }} {{ $inquiry->last_name }}様

お問い合わせありがとうございます。<br>
担当より回答いたしますのでお待ちください。
<br><br>
お問い合わせ内容は以下の通りです。<br>
--------<br>
{{ $inquiry->message }}<br>
--------<br>

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

ありがとうございました<br>
{{ config('app.name') }}
</x-mail::message>
