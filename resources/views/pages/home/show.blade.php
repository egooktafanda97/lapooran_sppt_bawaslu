@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ url('/dash') }}"><i class="menu-icon tf-icons ti ti-smart-home"></i></a>/</span>
            {{ $title ?? '' }}
        </h4>
    </div>
@endsection
