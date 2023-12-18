<x-mail::message>
新規の問い合わせが来ました。<br>
問い合わせ者: {{ $inquiry->first_name }} {{ $inquiry->last_name }}様
{{-- # Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br> --}}
{{ config('app.name') }}
</x-mail::message>
