<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊プラン編集</h3>
        <div>
                <div>
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $plan->title) }}" form="plan">
                </div>
                <div>
                    
                    <div class="row">
                        @forelse ($plan->images as $index => $image)
                            <div class="d-flex flex-column justify-content-between col">
                                <img src="{{ asset($image->path) }}" alt="{{ $plan->title }}に登録している画像" width="150">
                                <form action="{{ route('admin.plan.image.delete', $image->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" class="btn btn-outline-danger" class="btn-sm">
                                </form>
                                <p>画像差し替え</p>
                                <input type="file" name="image[{{ $image->id }}]" id="" form="plan">
                            </div>
                            @empty
                            <p>画像が登録されていません</p>
                        @endforelse
                        <p class="mt-4">画像を登録</p>
                        <input type="file" name="image_plus[]" id="" multiple form="plan">
                    </div>
                </div>
                <div>
                    <label for="description">説明</label>
                    <div><textarea name="description" id="description" cols="70" rows="5"
                            id="message" form="plan">{{ old('description', $plan->description) }}</textarea>
                    </div>
                </div>
                <p>予約枠</p>
                <div>
                    @foreach ($reserve_slots as $index => $reserve_slot)
                    <div>
                        <label><input type="checkbox" name="reserve_slot[]" id="reserve_slot"
                                value="{{ old('reserve_slot', $reserve_slot->id) }}" class="checkbox"
                                @foreach ($plan_reserve_slots as $plan_reserve_slot)
                                    @if ($plan_reserve_slot->reserve_slot_id ==  $reserve_slot->id)
                                        checked
                                    @endif
                                @endforeach
                                form="plan"
                                >
                        {{ $reserve_slot->date }} :{{ $reserve_slot->room->name }}
                        </label>
                        <input type="number" name="reserve_slot_fee[{{ $reserve_slot->id }}]" id="" step="100"
                            placeholder="予約枠の料金" class="reserve-slot"
                            @foreach ($plan_reserve_slots as $plan_reserve_slot)
                                @if ($plan_reserve_slot->reserve_slot_id ==  $reserve_slot->id)
                                    value="{{ old('reserve_slot_fee', $plan_reserve_slot->fee) }}"
                                @endif
                            @endforeach
                            form="plan"
                            >
                    </div>
                    @endforeach
                </div>
                <form action="{{ route('admin.plan.update', $plan->id) }}" method="post" enctype="multipart/form-data" id="plan">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="更新" class="btn btn-outline-primary">
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