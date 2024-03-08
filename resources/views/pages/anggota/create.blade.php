@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ url('anggota/store' . (!empty($id) ? '/' . $id : '')) }}" method="post">
            @csrf
            <div class="w-full card">
                <div class="card-header">
                    <h5>Entry Data Anggota</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="no_sk">no_sk</label>
                                <input class="form-control @error('no_sk') is-invalid @enderror" id="no_sk"
                                    name="no_sk" type="text" value="{{ old('no_sk') ?? ($no_sk ?? '') }}">
                                @error('no_sk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Add similar error handling for other input fields -->
                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="nama">nama</label>
                                <input class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" type="text" value="{{ old('nama') ?? ($nama ?? '') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="">Username</label>
                                <input class="form-control" name="username" type="text">
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="">Password</label>
                                <input class="form-control" name="password" type="password">
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="">Jabatan</label>
                                <select class="form-control" id="jabatan_id" name="jabatan_id">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatan as $Jitem)
                                        <option {{ ($jabatan_id ?? '') == ($Jitem->id ?? '') ? 'selected' : '' }}
                                            value="{{ $Jitem->id }}">{{ $Jitem->nama ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Add similar error handling for other input fields -->
                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                    name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option {{ ($jenis_kelamin ?? '') == 'Laki-Laki' ? 'selected' : '' }} value="Laki-Laki">
                                        Laki Laki</option>
                                    <option {{ ($jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}
                                        value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Add similar error handling for other select fields -->
                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="alamat">Alamat</label>
                                <input class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" type="text" value="{{ old('alamat') ?? ($alamat ?? '') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Add similar error handling for other input fields -->
                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                                    name="tempat_lahir" type="text"
                                    value="{{ old('tempat_lahir') ?? ($tempat_lahir ?? '') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Add similar error handling for other input fields -->
                        <div class="col-6 mb-3">
                            <div class="form-group ">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                                    name="tanggal_lahir" type="date"
                                    value="{{ old('tanggal_lahir') ?? ($tanggal_lahir ?? '') }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Add similar error handling for other input fields -->
                        <div class="col-12 mb-3 w-full">
                            <div class="flex justify-end text-end mb-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
