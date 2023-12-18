<x-layout>
    <x-container >
        <h3 class="fs-4">お問い合わせフォーム</h3>
        <div>
            <form action="{{ route('inquiry.store') }}" method="post">
                @csrf
                {{-- セッションデータを入力確認画面で表示・値をhiddenでおくる --}}
                <input type="hidden" name="type" value="{{ $inquiry_data['type']}}">
                <input type="hidden" name="first_name" value="{{ $inquiry_data['first_name']}}">
                <input type="hidden" name="last_name" value="{{ $inquiry_data['last_name']}}">
                <input type="hidden" name="email" value="{{ $inquiry_data['email']}}">
                <input type="hidden" name="tel" value="{{ $inquiry_data['tel']}}">
                <input type="hidden" name="date" value="{{ $inquiry_data['date']}}">
                <input type="hidden" name="message" value="{{ $inquiry_data['message']}}">
                <div class="d-flex">
                    <p>お問い合わせ内容</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['type']}}</p>
                </div>
                <input type="hidden" name="{{ $inquiry_data['type']}}">
                <div class="d-flex my-2">
                    <p>姓</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['first_name']}}</p>
                </div>
                <div class="d-flex my-2">
                    <p>名</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['last_name']}}</p>
                </div>
                <div class="d-flex my-2">
                    <p>メールアドレス</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['email'] }}</p>
                </div>
                <div class="d-flex my-2">
                    <p>電話番号</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['tel'] }}</p>
                </div>
                <div class="d-flex my-2">
                    <p>宿泊予定日</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['date'] }}</p>
                </div>
                <div class="d-flex my-2">
                    <p>問い合わせ内容</p>
                    <p class="border p-2 rounded">{{ $inquiry_data['message'] }}</p>
                </div>
                <input type="submit" value="登録" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>