<x-layout>
    <x-container>
        <h3 class="fs-3">お問い合わせ詳細</h3>
        <div>
            <p>ステータス</p>
            <p class="border p-2 rounded">{{ $inquiry->inquiryStatus->status }}</p>
            <p>種別</p>
            <p class="border p-2 rounded">{{ $inquiry->inquiryType->name }}</p>
            <p>名前</p>
            <p class="border p-2 rounded">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</p>
            <p>メールアドレス</p>
            <p class="border p-2 rounded">{{ $inquiry->email }}</p>
            <p>電話番号</p>
            <p class="border p-2 rounded">{{ $inquiry->telephone_number }}</p>
            <p>宿泊予定日</p>
            <p class="border p-2 rounded">{{ $inquiry->stay_date }}</p>
            <p>メッセージ</p>
            <p class="border p-2 rounded">{{ $inquiry->message }}</p>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.inquiry.index') }}" class="btn btn-outline-dark">戻る</a>
        </div>
    </x-container>
</x-layout>