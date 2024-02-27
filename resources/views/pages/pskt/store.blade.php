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
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input class="form-controll" name="tanggal" type="date">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tanggal Dinas</label>
                        <input class="form-controll" name="tanggal_dinas" type="date">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Perihal</label>
                        <textarea cols="4" id="perihal" name="perihal" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Perihal</label>
                        <textarea cols="4" id="tujuan_surat" name="tujuan_surat" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Lampiran</label>
                        <input class="form-controll" name="lampiran" type="file">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
