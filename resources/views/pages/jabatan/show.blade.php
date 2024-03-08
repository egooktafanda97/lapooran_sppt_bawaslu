@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="flex justify-end mb-2">
            <button class="btn btn-primary text-primary" data-bs-target="#exampleModal" data-bs-toggle="modal" id="add-data"
                type="button">
                Tambah Data
            </button>
        </div>
        <div class="w-full ">
            <table class="display responsive nowrap" id="tables" style="width:100%">
                <thead class="btn-primary text-white shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th class="w-[30px]">No</th>
                        <th>Nama jabatan</th>
                        <th>keterangan</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th class="w-[30px]">No</th>
                        <th>Nama jabatan</th>
                        <th>keterangan</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($Items as $item)
                        <tr class="hover:bg-gray-300">
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama ?? '' }}</td>
                            <td>{{ $item->keterangan ?? '' }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-edit" data-id="{{ $item->id }}"
                                        data-keterangan="{{ $item->keterangan }}" data-nama="{{ $item->nama }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a class="btn" href="{{ url('jabatan/destory/' . $item->id) }}"><i
                                            class="fa fa-trash"></i></a>
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
