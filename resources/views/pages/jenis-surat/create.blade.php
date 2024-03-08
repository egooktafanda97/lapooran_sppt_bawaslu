@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ url('jenis-surat/store') }}">
            <input type="hidden" value="{{ $jenis_surat->id ?? '' }}">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="w-full card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="form-group ">
                                        <label for="">Jenis Surat</label>
                                        <input class="form-control mb-2" name="jenis_surat"
                                            name="{{ $jenis_surat->jenis_surat ?? '' }}" type="text">
                                        @error('jenis_surat')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
