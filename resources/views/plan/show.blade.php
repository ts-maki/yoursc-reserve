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
        <div>
            <div class="flex">
                @if ($is_jp_room)
                <a href="{{ route('plan.show.jp', $plan->id) }}" class="btn
                    @if (Str::contains(url()->current(), 'jp-room'))
                    bg-primary text-white
                    @else
                    btn-outline-primary
                    @endif
                    ">和室</a>
                @endif
                @if ($is_wes_room)
                <a href="{{ route('plan.show.wes', $plan->id) }}" class="btn
                    @if (Str::contains(url()->current(), 'wes-room'))
                    bg-primary text-white
                    @else
                    btn-outline-primary
                    @endif
                    ">洋室</a>
                @endif
                @if ($is_mix_room)
                <a href="{{ route('plan.show.mix', $plan->id) }}" class="btn
                    @if (Str::contains(url()->current(), 'mix-room'))
                    bg-primary text-white
                    @else
                    btn-outline-primary
                    @endif
                    ">和洋室</a>
                @endif
                @if ($is_party_room)
                <a href="{{ route('plan.show.party', $plan->id) }}" class="btn
                    @if (Str::contains(url()->current(), 'party-room'))
                    bg-primary text-white
                    @else
                    btn-outline-primary
                    @endif
                    ">宴会会場</a>
                @endif
            </div>
            <div id='calendar'></div>
        </div>
        <div class="mt-4">
            <a href="{{ route('plan.index') }}" class="btn btn-outline-dark">戻る</a>
        </div>
    </x-container>
</x-layout>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
{{-- <script src="../../resources/js/index.global.js"></script> --}}
<script>
    let planId = {{ $plan->id }};
    let url = location.href;
    //部屋タイプ切り替え用エンドポイントURL
    if (url.includes('jp-room')) {
        url = `/jp-room`
    } else if (url.includes('wes-room')) {
        url = `/wes-room`
    } else if (url.includes('mix-room')) {
        url = `/mix-room`
    } else if (url.includes('party-room')) {
        url = `/party-room`
    } else  {
        url = ''
    }
    let requestUrl = `/events/${planId}${url}`
    console.log(location.href);
    console.log(requestUrl);
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'ja',
          themeSystem: 'bootstrap5',
          initialView: 'dayGridMonth',
          timeZone: 'Asia/Tokyo',
          events: requestUrl,
         dateClick: function(info) {
            console.log(location.href);
            }
        });
        calendar.render();
      });

</script>