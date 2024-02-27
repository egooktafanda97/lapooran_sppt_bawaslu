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
                        <th>nama</th>
                        <th>tanggl_keluar_st</th>
                        <th>tanggal_berangkat</th>
                        <th>tanggal_pulang</th>
                        <th>no_spt</th>
                        <th>jenis_surat_id</th>
                        <th>perihal</th>
                        <th>status_surat</th>
                        <th>lampiran</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>No</th>
                        <th>nama</th>
                        <th>tanggl_keluar_st</th>
                        <th>tanggal_berangkat</th>
                        <th>tanggal_pulang</th>
                        <th>no_spt</th>
                        <th>jenis_surat_id</th>
                        <th>perihal</th>
                        <th>status_surat</th>
                        <th>lampiran</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-300">
                            <td>No</td>
                            <td>{{ $item->nama ?? '-' }}</td>
                            <td>{{ $item->tanggl_keluar_st ?? '-' }}</td>
                            <td>{{ $item->tanggal_berangkat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pulang ?? '-' }}</td>
                            <td>{{ $item->no_spt ?? '-' }}</td>
                            <td>{{ $item->jenis_surat ?? '-' }}</td>
                            <td>{{ $item->perihal ?? '-' }}</td>
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
