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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $index => $inquiry)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><select name="type" id="selectStatus" class="{{ $inquiry->getStatusColor($inquiry->inquiry_status_id) }} bg-opacity-50"
                            onchange="changeInquiryStatus({{ $inquiry->id }}, this.value)">
                            @foreach ($inquiry_statuses as $inquiry_status)
                            <option value="{{ $inquiry_status->id }}" {{ $inquiry->inquiry_status_id ==
                                $inquiry_status->id ? 'selected' : ''}} >{{ $inquiry_status->status }}</option>
                            @endforeach
                    </td>
                    <td>{{ $inquiry->inquiryType->name }}</td>
                    <td>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</td>
                    <td>{{ $inquiry->email }}</td>
                    <td>{{ $inquiry->telephone_number }}</td>
                    <td>{{ $inquiry->stay_date }}</td>
                    <td><a href="{{ route('admin.inquiry.show', $inquiry->id) }}" class="btn btn-outline-primary">詳細</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <a href="{{ route('admin.index') }}" class="btn btn-outline-dark">戻る</a>
        </div>
    </x-container>
</x-layout>

<script>
    const changeInquiryStatus = (inquiryId, UpdateStatusId) => {
        console.log('問い合わせIDは' + inquiryId);
        console.log('ステータスは' + status);
        fetch(`/admin/inquiry/${inquiryId}/${UpdateStatusId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => {
            console.log(`問い合わせステータスID${UpdateStatusId}で更新成功`);
            location.reload();
        })
        .catch(error => {
            console.log('エラーが発生しました:', error);
        });
    }
</script>