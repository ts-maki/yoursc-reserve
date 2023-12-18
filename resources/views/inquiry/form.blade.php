<x-layout>
    <x-container>
        <h3 class="fs-4">お問い合わせフォーム</h3>
        <div>
            <form action="{{ route('inquiry.comfilm') }}" method="post">
                @csrf
                <div>
                    <label for="type">お問い合わせ内容</label>
                    <select name="type" id="type">
                        <option hidden>選択してください</option>
                        @foreach ($inquiry_types as $inquiry_type)
                            <option value="{{ $inquiry_type }}">{{ $inquiry_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="first_name">姓</label>
                    <input type="text" name="first_name" id="first_name">
                </div>
                <div>
                    <label for="last_name">名</label>
                    <input type="text" name="last_name" id="last_name">
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="tel">電話番号</label>
                    <input type="tel" name="tel" id="tel">
                </div>
                <div>
                    <label for="date">宿泊予定日</label>
                    <input type="date" name="date" id="date" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}">
                </div>
                <div>
                    <label for="message">問い合わせ内容</label>
                    <div><textarea name="message" id="" cols="90" rows="10" id="message"></textarea></div>
                </div>
                <input type="submit" value="入力内容の確認" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>