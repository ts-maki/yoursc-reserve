<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊プラン一覧</h3>
        <div>
            @if ($has_reserve_slot)
            <a href="{{ route('admin.plan.create') }}" class="btn btn-outline-primary"
            >新規作成</a>
            @else
            <h3 class="text-danger fs-3">予約枠がないので登録できません</h3>
            <a href="{{ route('admin.reserve_slot.create') }}" class="btn btn-outline-primary">予約枠登録画面へ</a>
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>画像</th>
                    <th>タイトル</th>
                    <th>説明</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
                @forelse ($plans as $index => $plan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if (empty($plan->images[0]))
                        <p>画像なし</p>
                        @else
                        <img src="{{ asset($plan->images[0]->path) }}" alt="" width="100">
                        @endif
                    </td>
                    <td>{{ $plan->title }}</td>
                    <td>{{ $plan->description }}</td>
                    <td><a href="{{ route('admin.plan.edit', $plan->id) }}" class="btn btn-outline-primary">編集</a></td>
                    <td>
                        <a href="{{ route('admin.plan.check', $plan->id) }}" class="btn btn-outline-danger">削除</a>
                    </td>
                    <td>
                    </td>
                </tr>
                @empty
                <p>宿泊プランがありません</p>
                @endforelse
            </tbody>
        </table>
    </x-container>
</x-layout>