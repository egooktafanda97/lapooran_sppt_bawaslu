@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- all error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('pskt/store/' . _val($pskt->id ?? '')) }}" enctype="multipart/form-data" id="from-pskt-create"
            method="POST">
            @csrf
            <div class="w-full card">
                <div class="card-header">
                    <h5>Permohonan Surat Keluar</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="nomor_surat">Klasifikasi</label>
                                <input class="form-control" id="klasifikasi" name="klasifikasi" readonly type="text"
                                    value="{{ !empty($pskt) ? $pskt->klasifikasi : $no_surat }}">
                                @error('klasifikasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="nomor_surat">Judul Surat</label>
                                <input class="form-control" id="judul" name="judul"
                                    placeholder="judul surat pengajuan" type="text"
                                    value="{{ _val($pskt->Judul ?? '') }}">
                                @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input class="form-control" id="tanggal" name="tanggal" type="date"
                                    value="{{ _val($pskt->tanggal ?? '') }}">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="tanggal_dinas">Tanggal Dinas</label>
                                <input class="form-control" id="tanggal_dinas" name="tanggal_dinas" type="date"
                                    value="{{ _val($pskt->tanggal_dinas ?? '') }}">
                                @error('tanggal_dinas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="lampiran">Lampiran</label>
                                <input class="form-control" id="lampiran" name="lampiran" type="file">
                                @error('lampiran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="tujuan_surat">Tujuan Surat</label>
                                <input class="form-control" id="tujuan_surat" name="tujuan_surat" type="text"
                                    value="{{ _val($pskt->tujuan_surat ?? '') }}">
                                @error('tujuan_surat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea class="form-control" id="perihal" name="perihal" rows="4">{{ _val($pskt->perihal ?? '') }}</textarea>
                                @error('perihal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="w-full  d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
