<x-layout>
    <x-container>
        <h2 class="fs-2">{{ $plan->title }}</h2>
        <div class="row">
            <div class="col mt-4">
                <div class="card">
                    <div class="row">
                        @foreach ($plan->images as $image)
                            <img src="{{ asset($image->path) }}" alt="{{ $plan->title }}プランの画像" class="col" style="width: 50px">
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $plan->title }}</h5>
                        <p class="card-text">{{ $plan->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-layout>