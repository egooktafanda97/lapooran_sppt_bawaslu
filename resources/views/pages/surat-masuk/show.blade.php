@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mb-3">
            <a href="?type=pskt" class="btn btn-white">PSKT</a>
            <a href="?type=ptpsppds"  class="btn btn-white">PTPB-SPPDS</a>
        </div>
        @if(empty(request()->get("type")) || request()->get("type") == "pskt")
            @include('pages.surat-masuk.pskt')
        @else
            @include('pages.surat-masuk.ptpb-sppds')
        @endif
    </div>
@endsection
@include('inc.dt_tble')
