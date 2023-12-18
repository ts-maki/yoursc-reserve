<x-layout>
    <x-container>
        <h3 class="fs-3">お問い合わせ一覧</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ステータス</th>
                    <th>種別</th>
                    <th>名前</th>
                    <th>email</th>
                    <th>電話番号</th>
                    <th>宿泊日</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $index => $inquiry)
                <a href="">
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <th>{{ $inquiry->inquiryStatus->status }}</th>
                        <th>{{ $inquiry->inquiryType->name }}</th>
                        <th>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</th>
                        <th>{{ $inquiry->email }}</th>
                        <th>{{ $inquiry->telephone_number }}</th>
                        <th>{{ $inquiry->stay_date }}</th>
                        <th>{{ $inquiry->message }}</th>
                    </tr>
                </a>
                @endforeach
            </tbody>
        </table>
    </x-container>
</x-layout>