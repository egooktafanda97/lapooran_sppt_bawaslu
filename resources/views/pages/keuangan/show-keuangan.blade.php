@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="flex justify-end mb-2">
            <a class="btn btn-primary text-white" href="{{ url('keuangan/create') }}">
                <i class="fa fa-plus mr-2"></i> Buat Laporan
            </a>
        </div>
        <div class="w-full ">
            <table class="display responsive nowrap" id="tables" style="width:100%">
                <thead class="btn-primary text-white shadow-md">
                    <tr>
                        <th class="w-[30px]">No</th>
                        <th>Nomor Surat</th>
                        <th>Nama Satuan Kerja</th>
                        <th>Total Anggaran</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr>
                        <th class="w-[30px]">No</th>
                        <th>Nomor Surat</th>
                        <th>Nama Satuan Kerja</th>
                        <th>Total Anggaran</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($keuangan as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_surat }}</td>
                            <td>{{ $item->bawaslu->nama }}</td>
                            <td>{{ collect($item->items)->sum('jumlah') }}</td>
                            <td>
                                <div>
                                    <a class="btn btn-primary text-white" href="{{ url('keuangan/report/' . $item->id) }}"
                                        target="_blank" title="laporan">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    <a class="btn btn-warning text-white" href="{{ url('keuangan/create/' . $item->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger text-white" href="{{ url('keuangan/destroy/' . $item->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- modal --}}


    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('jabatan/store') }}" id="form-data" method="post">
                    @csrf
                    <input name="id" type="hidden">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Entry Jabatan</h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="w-full mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Nama Jabatan</label>
                                            <input class="form-control" name="nama" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Keterangan</label>
                                            <input class="form-control" name="keterangan" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary text-primary" type="submit">Simpan</button>
                            <button class="btn btn-secondary text-primary" data-dismiss="modal"
                                type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('inc.dt_tble')
@push('script')
    <script>
        $(".btn-edit").click(function() {
            $("#add-data").click();
            $("[name='nama']").val($(this).data("nama"))
            $("[name='keterangan']").val($(this).data("keterangan"))
            $("#form-data").attr("action", `{{ url('jabatan/update') }}/${$(this).data("id")}`)
        })
    </script>
@endpush
