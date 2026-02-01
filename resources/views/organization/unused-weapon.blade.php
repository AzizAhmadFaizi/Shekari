<div class="card-header">
    <h4 class="card-title">لست سلاح تسلیم شده</h4>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>سلاح</th>
                    <th>نمبر سلاح</th>
                    <th>قطر سلاح</th>
                    <th>نوعیت</th>
                    <th>تعداد جبه</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weapons as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->weapon_type_details->name_en }}</td>
                        <td>{{ $item->weapon_no }}</td>
                        <td>{{ $item->weapon_diameter }}</td>
                        <td>{{ $item->is_used == 1 ? 'جدید' : 'مستعمل' }}</td>
                        <td>{{ $item->magazine_quantity }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>

@include('organization.general_scripts')
