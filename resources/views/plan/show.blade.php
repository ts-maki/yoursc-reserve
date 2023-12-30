<x-layout>
    <x-container>
        {{-- <h2 class="fs-2">{{ $plan->title }}</h2>
        <div class="d-flex">
            @foreach ($plan->images as $image)
            <img src="{{ asset($image->path) }}" alt="{{ $plan->title }}プランの画像" width="200">
            @endforeach
        </div>
        <p>{{ $plan->description }}</p> --}}
        <div class="w-50">
            <div id='calendar'></div>
        </div>
    </x-container>
</x-layout>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          timeZone: 'Asia/Tokyo',
          events: '/events',
        });
        calendar.render();
      });

</script>