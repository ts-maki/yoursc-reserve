<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊プラン作成</h3>
        <div>
            <form action="{{ route('admin.plan.store') }}">
                <div>
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title">
                </div>
                <div>
                    <label for="description">説明</label>
                    <div><textarea name="description" id="description" cols="90" rows="10" id="message"></textarea>
                    </div>
                </div>
                <div>
                    @foreach ($reserve_slots as $reserve_slot)
                        <label class="block">
                            <input type="checkbox" name="reserve_slot" id="" value="{{ $reserve_slot->date }}">
                            {{ $reserve_slot->date }}:{{ $reserve_slot->room->name }}
                        </label>
                    @endforeach
                </div>
                <input type="submit" value="作成" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>