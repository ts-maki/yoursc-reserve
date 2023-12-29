<x-layout>
    <x-container>
        <h2 class="fs-2">{{ $plan->title }}</h2>
        <div class="d-flex">
            @foreach ($plan->images as $image)
            <img src="{{ asset($image->path) }}" alt="{{ $plan->title }}プランの画像" width="200">
            @endforeach
        </div>
            <p>{{ $plan->description }}</p>
    </x-container>
</x-layout>