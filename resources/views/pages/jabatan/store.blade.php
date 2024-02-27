@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ url('/dash') }}"></a>/</span>
            {{ $title ?? '' }}
        </h4>
        <div class="w-full ">
            <div class="row">

                <div class="col-6">
                    <div class="form-group ">
                        <label for="">Klasifikasi</label>
                        <input class="form-controll" name="nomor_surat" readonly type="text">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
