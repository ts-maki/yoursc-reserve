<x-layout>
    <x-container>
        <h2 class="fs-2">宿泊プラン一覧</h2>
        <div class="row">
            @forelse ($plans as $plan)
            <div class="col mt-4">
                <div class="card" style="width: 18rem;">
                    @if (empty($plan->images[0]))
                    <p class="border">画像なし</p>
                    @else
                    <img src="{{ asset($plan->images[0]->path) }}" alt="宿泊プランの画像" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $plan->title }}</h5>
                        <p class="card-text">{{ $plan->description }}</p>
                        <a href="{{ route('plan.show', $plan->id) }}" class="btn btn-outline-primary">詳細</a>
                    </div>
                    {{ config('global.cache.time') }}
                </div>
            </div>
            @empty
            <p>宿泊プランが登録されていません</p>
            @endforelse
        </div>
    </x-container>
</x-layout>