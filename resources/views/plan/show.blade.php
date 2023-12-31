<x-layout>
    {{-- <x-slot name="calendar_theme_bootstrap">
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    </x-slot> --}}
    <x-container>
        <h2 class="fs-2">{{ $plan->title }}</h2>
        <div class="d-flex">
            @foreach ($plan->images as $image)
            <img src="{{ asset($image->path) }}" alt="{{ $plan->title }}プランの画像" width="200">
            @endforeach
        </div>
        <p>{{ $plan->description }}</p>
        <div class="w-75">
            <div id='calendar'></div>
        </div>
    </x-container>
</x-layout>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
{{-- <script src="../../resources/js/index.global.js"></script> --}}
<script>
    let planId = {{ $plan->id }};
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap5',
          initialView: 'dayGridMonth',
          timeZone: 'Asia/Tokyo',
          events: `/events/${planId}`,
        });
        calendar.render();
      });

</script>