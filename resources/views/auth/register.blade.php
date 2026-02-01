@extends('layouts.app')
@section('content')
    <div class="card-header">
        <h4 class="card-title">کاربرجدید</h4>
    </div>
    <div class="card-body">
        <form class="form form-vertical" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1" for="name">نام کاربر</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="نام کاربر را بنوسید">
                        <input type="hidden" name="data_id">
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1" for="email">ایمیل</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ایمیل کاربر را بنوسید">
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1">صلاحیت کاربر</label>
                        <select name="role_id" id="" class="form-control @error('role_id') is-invalid @enderror" required>
                            <option value="" selected disabled>صلاحیت کاربر را انتخاب نمایید</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == old('role_id') ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="valid-feedback"><b>{{ $message }}</b></div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1" for="password" class="">رمز عبور</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="رمز عبور" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1" for="password-confirm">تایید رمز عبور</label>
                        <input id="password-confirm" type="password" class="form-control" placeholder="تایید رمز عبور" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mt-3 ps-5">
                    <button type="submit" class="btn btn-outline-primary btn-sm me-1 waves-effect waves-float waves-light ms-3"><span data-feather="save"></span></button>
                    <button type="reset" id="reset" class="btn btn-outline-secondary btn-sm waves-effect ms-5"><span data-feather="refresh-ccw"></span></button>
                </div>
            </div>
        </form>

        <div class="card-header border-bottom">
            <h4 class="card-title">لست کاربران</h4>
        </div>
        <div class="m-1">
            <div class="table-responsive">
                <table class="datatables-ajax table">
                    <thead class="table-dark">
                        <tr>
                            <th>شماره</th>
                            <th>اسم</th>
                            <th>ایمیل</th>
                            <th>صلاحیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <th class="text-center">
                                    <a href="#!" class="btn btn-outline-primary btn-sm waves-effect round edit-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" email="{{ $user->email }}" data-role="{{ $user->role_id }}"><span data-feather="edit"></span></a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session()->has('success_store'))
        <script>
            success_msg("{{ session()->get('success_store') }}");
        </script>
    @endif
    @if (session()->has('success_update'))
        <script>
            success_msg("{{ session()->get('success_update') }}");
        </script>
    @endif
    <script>
        const generateMail = () => {
            $('#email').val($('#name').val().replaceAll(' ', '') + '@' + "moi.gov.af");
        };
        $('#name').focusout(function() {
            generateMail();
        });

        $('.edit-btn').click(function() {
            $("input[name=name]").val($(this).attr('data-name'));
            $("input[name=email]").val($(this).attr('email'));
            $("select[name=role_id]").val($(this).attr('data-role'));
            $("input[name=password_confirmation]").prop('required', false);
            $("input[name=password]").prop('required', false);
            $("input[name=data_id]").val($(this).attr('data-id'));
            $("form").attr("action", "{{ route('user-update') }}");
        });

        $('#reset').click(function() {
            $("form").attr("action", "{{ route('register') }}");
        });

        $('.datatables-ajax').dataTable({
            "bInfo": false,
            "lengthChange": false,
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                "sSearch": "Search",
                "sEmptyTable": "Empty Table",
                "zeroRecords": "Zero Record",
                "processing": "Processing",
            }
        });
    </script>
@endsection
