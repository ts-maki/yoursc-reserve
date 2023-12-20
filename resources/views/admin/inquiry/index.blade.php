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
                @php
                switch ($inquiry->inquiry_status_id) {
                case 1:
                $background_color = 'bg-danger';
                break;
                case 2:
                $background_color = 'bg-primary';
                break;
                case 3:
                $background_color = 'bg-success';
                break;
                default:
                $background_color = 'bg-danger';
                break;
                }
                @endphp
                <tr>
                    <th>{{ $index + 1 }}</th>
                    <th><select name="type" id="selectStatus" class="{{ $background_color }} bg-opacity-50"
                            onchange="changeInquiryStatus({{ $inquiry->id }}, this.value)">
                            @foreach ($inquiry_statuses as $inquiry_status)
                            <option value="{{ $inquiry_status->id }}" {{ $inquiry->inquiry_status_id ==
                                $inquiry_status->id ? 'selected' : ''}} >{{ $inquiry_status->status }}</option>
                            @endforeach
                    </th>
                    <th>{{ $inquiry->inquiryType->name }}</th>
                    <th>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</th>
                    <th>{{ $inquiry->email }}</th>
                    <th>{{ $inquiry->telephone_number }}</th>
                    <th>{{ $inquiry->stay_date }}</th>
                    <th><a href="{{ route('admin.inquiry.show', $inquiry->id) }}" class="btn btn-outline-primary">詳細</a></th>
                </tr>
                @endforeach
            </tbody>
        </table>
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