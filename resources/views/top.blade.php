<x-layout>
    <x-container>
        <h2 class="fs-2">TOPページ</h2>
        @if (session('complete_inquiry'))
            <p>{{ session('complete_inquiry') }}</p>
        @endif
    </x-container>
</x-layout>