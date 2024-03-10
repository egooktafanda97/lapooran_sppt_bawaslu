@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mb-3">
            <a href="?type=pskt" class="btn btn-white">PSKT</a>
            <a href="?type=ptpsppds"  class="btn btn-white">PTPB-SPPDS</a>
        </div>
        @if(empty(request()->get("type")) || request()->get("type") == "pskt")
            @include('pages.Laporan.pskt')
        @else
            @include('pages.Laporan.ptpb-sppds')
        @endif
    </div>
@endsection
@include('inc.dt_tble')
