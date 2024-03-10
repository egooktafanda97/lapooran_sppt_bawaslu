@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mb-3">
            <a class="btn btn-white" href="?search=pending&tanggal={{request()->get("tanggal")}}">Pending</a>
            <a class="btn btn-white" href="?search=verify&tanggal={{request()->get("tanggal")}}">Divalidasi</a>
            <a class="btn btn-white" href="?search=reject&tanggal={{request()->get("tanggal")}}">Ditolak</a>
        </div>
        <div class="w-100 card p-2">
            <div class="flex justify-between mb-2">
                <h5><strong>Permohonan Surat Keluar Bawaslu</strong></h5>
               <div>
                   <a class="btn btn-primary" href="{{ url('pskt/create') }}">
                       Tambah Data
                   </a>
                   <a class="btn btn-success"
                      href="{{ url('pskt/excel?status=' . request()->get('status') . (!empty(request()->get('tanggal')) ? '&tanggal' . request()->get('tanggal') : '')) }}"
                      target="_blank">
                       Export
                   </a>
               </div>
            </div>
            <div>

                <form action="">
                    <div class="flex justify-end mb-2">
                        <div>
                            <input class="form-control" name="tanggal" type="date"
                                   value="{{ request()->get('tanggal') ?? '' }}">
                        </div>
                        <div class="ml-2">
                            <button class="btn bg:blue-500 btn-primary text-dark" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="display responsive nowrap" id="tables" style="width:100%">
                <thead class="bg-primary text-white shadow-md">
                <tr>
                    <th>Nomor</th>
                    <th>Klasifikasi</th>
                    <th>Tanggal</th>
                    <th>Tanggal Dinas</th>
                    <th>Perihal</th>
                    <th>Tujuan Surat</th>
                    <th>Pengirim</th>
                    <th>Status Surat</th>
                    <th>Lampiran</th>
                    <th>#</th>
                </tr>
                </thead>
                <tfoot class="bg-primary text-white shadow-md">
                <tr>
                    <th>Nomor</th>
                    <th>Klasifikasi</th>
                    <th>Tanggal</th>
                    <th>Tanggal Dinas</th>
                    <th>Perihal</th>
                    <th>Tujuan Surat</th>
                    <th>Pengirim</th>
                    <th>Status Surat</th>
                    <th>Lampiran</th>
                    <th>#</th>
                </tr>
                </tfoot>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($Items as $item)
                    <tr class="hover:bg-gray-300">
                        <td>
                            {{ $no++ }}
                        </td>
                        <td>{{ $item->klasifikasi ?? '-' }}</td>
                        <td>{{ $item->tanggal ?? '-' }}</td>
                        <td>{{ $item->tanggal_dinas ?? '-' }}</td>
                        <td>{{ $item->perihal ?? '-' }}</td>
                        <td>{{ $item->tujuan_surat ?? '-' }}</td>
                        <td>{{ \App\Models\Anggota::whereId($item->pengirim)->first()->nama ?? '-' }}</td>
                        <td>

                                <span
                                    class="badge {{ $item->status_surat == 'pending' ? 'bg-label-primary' : ($item->status_surat == 'verify' ? 'bg-label-success' : 'bg-label-danger') }}">
                                    {{ $item->status_surat ?? '-' }}
                                </span>

                        </td>
                        <td><a href="{{ asset('lampiran/' . $item->lampiran ?? '-') }}" style="color: blue"
                               target="_blank">{{ $item->lampiran ?? '-' }}</a>
                        </td>
                        <td>
                            <div>
                                <a class="{{ $item->status_surat != 'pending' ? 'disabled' : '' }}"
                                   href="{{ url('pskt/create/' . $item->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn {{ $item->status_surat != 'pending' ? 'disabled' : '' }}"
                                   href="{{ url('pskt/destory/' . $item->id) }}"><i class="fa fa-trash"></i></a>
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
