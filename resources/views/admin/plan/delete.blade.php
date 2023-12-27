<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊プラン削除</h3>
        <div>
                <div>
                    <label for="title">タイトル</label>
                    <p class="class="border p-2 rounded"">{{ $plan->title }}</p>
                </div>
                <div>
                    
                    <div class="row">
                        @forelse ($plan->images as $index => $image)
                            <div class="d-flex flex-column justify-content-between col">
                                <img src="{{ asset($image->path) }}" alt="{{ $plan->title }}に登録している画像" width="150">
                            </div>
                            @empty
                            <p>画像が登録されていません</p>
                        @endforelse
                        <p class="mt-4">画像を登録</p>
                    </div>
                </div>
                <div>
                    <label for="description">説明</label>
                   <p class="border p-2 rounded">{{ $plan->description }}</p>
                </div>
                <p>予約枠</p>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>部屋</th>
                                <th>料金</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plan->planReserveSlots as $plan_reserve)
                            <tr>
                                <th>{{ $plan_reserve->reserveSlot->date }}</th>
                                <th>{{ $plan_reserve->reserveSlot->room->name }}</th>
                                <th>{{ $plan_reserve->fee }}円</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('admin.plan.delete', $plan->id) }}" method="post" >
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" class="btn btn-outline-danger">
                </form>
        </div>
    </x-container>
</x-layout>

<script>
    const checkBoxes = document.querySelectorAll('.checkbox');
    const inputFees = document.querySelectorAll('.reserve-slot');

    checkBoxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                inputFees[index].required = true;
            } else {
                inputFees[index].required = false;
            }
        });
    });
</script>