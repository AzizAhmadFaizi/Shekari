<div class="card-header">
    <h4 class="card-title">لست کارمندان منفک شده</h4>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>شهرت</th>
                    <th>نمبرتذکره/پاسپورت</th>
                    <th>وظیفه</th>
                    <th>افغانی/خارجی</th>
                    <th>وظیفه</th>
                </tr>
            </thead>
            <tbody>
                @php $new_btn = 0; @endphp
                @foreach ($employees as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->name . ' - ' . $item->last_name . ' - ' . $item->father_name }}</td>
                        <th>{{ $item->national_id }}</th>
                        <th>{{ $item->position }}</th>
                        <td>{{ $item->nationality == 0 ? 'افغانی' : 'خارجی' }}</td>
                        <td>{{ $item->position }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
@include('organization.general_scripts')
