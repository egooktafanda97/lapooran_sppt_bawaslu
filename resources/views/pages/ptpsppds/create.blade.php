@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('ptpsppds/store/' . _val($ptpsppds->id ?? '')) }}" enctype="multipart/form-data"
            id="from-ptpsppds-create" method="POST">
            @csrf
            <div class="w-full card">
                <div class="card-header">
                    <h5>Permohonan Surat Tugas Dan Pecairan SPPD</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control" id="nama" name="nama" type="text"
                                    value="{{ _val($ptpsppds->nama ?? '') }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="tanggal_keluar_st">Tanggal Keluar</label>
                                <input class="form-control" id="tanggal_keluar_st" name="tanggal_keluar_st" type="date"
                                    value="{{ _val(\Carbon\Carbon::parse($ptpsppds->tanggal_keluar_st ?? now())->format('Y-m-d') ?? '') }}">
                                @error('tanggal_keluar_st')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="tanggal_berangkat">Tanggal Berangkat</label>
                                <input class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" type="date"
                                    value="{{ _val(\Carbon\Carbon::parse($ptpsppds->tanggal_berangkat ?? now())->format('Y-m-d') ?? '') }}">
                                @error('tanggal_berangkat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="tanggal_pulang">Tanggal Pulang</label>
                                <input class="form-control" id="tanggal_pulang" name="tanggal_pulang" type="date"
                                    value="{{ _val(\Carbon\Carbon::parse($ptpsppds->tanggal_pulang ?? now())->format('Y-m-d') ?? '') }}">
                                @error('tanggal_pulang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="no_spt">Nomor SPT</label>
                                <input class="form-control" id="no_spt" name="no_spt" type="text"
                                    value="{{ _val($ptpsppds->no_spt ?? '') }}">
                                @error('no_spt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="jenis_surat_id">Jenis Surat</label>
                                <select class="form-control" id="jenis_surat_id" name="jenis_surat_id">
                                    <option value="">Pilih Jenis Surat</option>
                                    @foreach ($jenis_surat as $item)
                                        <option {{ setSelected($ptpsppds ?? null, $item->id) }}
                                            value="{{ $item->id }}">
                                            {{ $item->jenis_surat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_surat_id')
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
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea class="form-control summernote" id="perihal" name="perihal" rows="4">{{ _val($ptpsppds->perihal ?? '') }}</textarea>
                                @error('perihal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="w-full  d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
