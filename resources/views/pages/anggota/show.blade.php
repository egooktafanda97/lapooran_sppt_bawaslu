@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="flex justify-end mb-2">
            <a class="btn btn-primary" href="{{ url('anggota/create') }}">
                Tambah Data
            </a>
        </div>
        <div class="w-full ">
            <table class="display responsive nowrap" id="tables" style="width:100%">
                <thead class="btn-primary text-white shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>No</th>
                        <th>Bawaslu</th>
                        <th>Jabatan</th>
                        <th>No SK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>No</th>
                        <th>Bawaslu</th>
                        <th>Jabatan</th>
                        <th>No SK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($Items as $item)
                        <tr class="hover:bg-gray-300">
                            <td>No</td>
                            <td>{{ $item->bawaslu->nama ?? '-' }}</td>
                            <td>{{ $item->jabatan->nama ?? '-' }}</td>
                            <td>{{ $item->no_sk ?? '-' }}</td>
                            <td>{{ $item->nama ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $item->alamat ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td>
                            <td>{{ $item->tanggal_lahir ?? '-' }}</td>
                            <td>
                                <div>
                                    <a href="{{ url('anggota/create/' . $item->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn" href="{{ url('anggota/destory/' . $item->id) }}"><i
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
@include('inc.dt_tble')
