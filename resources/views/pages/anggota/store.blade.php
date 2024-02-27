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
                            <label for="">no_sk</label>
                            <input class="form-controll" name="no_sk" name="{{ $item->no_sk }}" readonly type="text">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">nama</label>
                            <input class="form-controll" name="nama" name="{{ $item->nama }}" readonly type="text">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Jabatan</label>
                            <select id="jabatan_id" name="jabatan_id">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $Jitem)
                                    <option {{ $item->jabatan->id == $Jitem->id ? 'selected' : '' }}
                                        value="{{ $Jitem->id }}">{{ $Jitem->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Alamat</label>
                            <input class="form-controll" name="alamat" name="{{ $item->alamat }}" readonly type="text">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Tempat Lahir</label>
                            <input class="form-controll" name="tempat_lahir" name="{{ $item->tempat_lahir }}" readonly
                                type="text">
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Tanggal Lahir</label>
                            <input class="form-controll" name="tanggal_lahir" name="{{ $item->tanggal_lahir }}" readonly
                                type="text">
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
