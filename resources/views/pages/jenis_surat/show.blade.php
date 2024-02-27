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
                        <th>Jenis Surat</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th>Jenis Surat</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-300">
                            <td>{{ $item->jenis_surat ?? '' }}</td>
                            <td>
                                <div>
                                    <button class="btn">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a class="btn" href="{{ url('jenis-surat/delete') }}"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <form action="{{ url('jenis-surat') }}" method="post">
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
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label for="">Jenis Surat</label>
                                        <input class="form-controll" name="jenis_surat" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@include('inc.dt_tble.blade')
