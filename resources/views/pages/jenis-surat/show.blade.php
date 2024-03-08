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
                        <th>Jenis Surat</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>No</th>
                        <th>Jenis Surat</th>
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
                            <td>{{ $item->jenis_surat ?? '' }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-edit" data-id="{{ $item->id }}"
                                        data-jenis_surat="{{ $item->jenis_surat }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a class="btn" href="{{ url('jenis-surat/destory/' . $item->id) }}"><i
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
                <form action="{{ url('jenis-surat/store') }}" id="form-data" method="post">
                    @csrf
                    <input name="id" type="hidden">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Entry Jenis Surat</h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="w-full mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Jenis Surat</label>
                                            <input class="form-control" name="jenis_surat" type="text">
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
            $("[name='jenis_surat']").val($(this).data("jenis_surat"))
            $("#form-data").attr("action", `{{ url('jenis-surat/update') }}/${$(this).data("id")}`)
        })
    </script>
@endpush
