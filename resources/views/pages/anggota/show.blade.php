@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ url('/dash') }}"></a>/</span>
            {{ $title ?? '' }}
        </h4>
        <div class="w-full ">
            <table class="display responsive nowrap" id="tables" style="width:100%">
                <thead class="btn-primary text-white shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>No</th>
                        <th>nomor_surat</th>
                        <th>klasifikasi</th>
                        <th>tanggal</th>
                        <th>tanggal_dinas</th>
                        <th>perihal</th>
                        <th>tujuan_surat</th>
                        <th>pengirim</th>
                        <th>status_surat</th>
                        <th>lampiran</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>No</th>
                        <th>nomor_surat</th>
                        <th>klasifikasi</th>
                        <th>tanggal</th>
                        <th>tanggal_dinas</th>
                        <th>perihal</th>
                        <th>tujuan_surat</th>
                        <th>pengirim</th>
                        <th>status_surat</th>
                        <th>lampiran</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-300">
                            <td>No</td>
                            <td>{{ $item->nomor_surat ?? '-' }}</td>
                            <td>{{ $item->klasifikasi ?? '-' }}</td>
                            <td>{{ $item->tanggal ?? '-' }}</td>
                            <td>{{ $item->tanggal_dinas ?? '-' }}</td>
                            <td>{{ $item->perihal ?? '-' }}</td>
                            <td>{{ $item->tujuan_surat ?? '-' }}</td>
                            <td>{{ $item->pengirim ?? '-' }}</td>
                            <td>{{ $item->status_surat ?? '-' }}</td>
                            <td>{{ $item->lampiran ?? '-' }}</td>
                            <td>#</td>
                            <td>
                                <div>
                                    <a href="">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn" href="{{ url('jenis-surat/delete') }}"><i
                                            class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@include('inc.dt_tble.blade')
