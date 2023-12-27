<x-layout>
    <x-container>
        <h3 class="fs-3">宿泊プラン一覧</h3>
        <div>
            <a href="{{ route('admin.plan.create') }}" class="btn btn-outline-primary">新規作成</a>
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
            <tbody>
                @forelse ($plans as $index => $plan)
                <tr>
                    <th>{{ $index + 1 }}</th>
                    <th>
                        @if (empty($plan->images[0]))
                        <p>画像なし</p>
                        @else
                        <img src="{{ asset($plan->images[0]->path) }}" alt="" width="100">
                        @endif
                    </th>
                    <th>{{ $plan->title }}</th>
                    <th>{{ $plan->description }}</th>
                    <th><a href="{{ route('admin.plan.edit', $plan->id) }}" class="btn btn-outline-primary">編集</a></th>
                    <th>
                        {{-- <form action="{{ route('admin.plan.delete', $plan->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" class="btn btn-outline-danger">
                        </form> --}}
                    </th>
                </tr>
                @empty
                    <p>宿泊プランがありません</p>
                @endforelse
            </tbody>
        </table>
    </x-container>
</x-layout>