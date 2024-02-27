@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ url('/dash') }}"></a>/</span>
            {{ $title ?? '' }}
        </h4>
        <form action="{{ url('ptp-sppds') }}">
            <div class="w-full ">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Nama</label>
                            <input class="form-controll" name="nama" type="text">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tanggal Keluar ST</label>
                            <input class="form-controll" name="tanggl_keluar_st" type="date">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tanggal Berangkat</label>
                            <input class="form-controll" name="tanggal_berangkat" type="date">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tanggal Pulang</label>
                            <input class="form-controll" name="tanggal_pulang" type="date">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">No Spt</label>
                            <input class="form-controll" name="no_spt" type="file">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Jenis Surat</label>
                            <select id="jenis_surat_id" name="jenis_surat_id">
                                <option value="">Pilih Jenis Surat</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
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
                            <label for="">Lampiran</label>
                            <input class="form-controll" name="lampiran" type="file">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
