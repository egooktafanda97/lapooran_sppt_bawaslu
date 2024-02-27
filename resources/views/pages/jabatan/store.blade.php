@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ url('/dash') }}"></a>/</span>
            {{ $title ?? '' }}
        </h4>
        <form action="{{ url('store-jabatan') }}">
            <div class="w-full ">
                <div class="row">

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Nama Jabatan</label>
                            <input class="form-controll" name="jabatan" name="{{ $jabatan->nama }}" readonly type="text">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Keterangan</label>
                            <textarea class="form-controll" name="keterangan">{{ $jabatan->keterangan ?? '' }}</textarea>
                        </div>
                    </div>


                </div>
            </div>
        </form>
    </div>
@endsection
