@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="flex justify-end mb-2">
            <button class="btn btn-primary text-primary" data-bs-target="#exampleModal" data-bs-toggle="modal" id="add-data"
                type="button">
                Tambah Data
            </button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-full ">
            <table class="display responsive nowrap" id="tables" style="width:100%">
                <thead class="btn-primary text-white shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th class="w-[30px]">No</th>
                        <th>Nama</th>
                        <th>Singkatan</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot class="btn-primary text-white  shadow-md">
                    <tr class="hover:bg-gray-300">
                        <th class="w-[30px]">No</th>
                        <th>Nama</th>
                        <th>Singkatan</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
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
                            <td>{{ $item->singkatan_penomoran_surat ?? '' }}</td>
                            <td>{{ $item->provinsi->nama_provinsi ?? '' }}</td>
                            <td>{{ $item->kabupaten->nama_kabupaten ?? '' }}</td>
                            <td>{{ $item->kecamatan->nama_kecamatan ?? '' }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-edit" data-id="{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a class="btn" href="{{ url('bawaslu/destory/' . $item->id) }}"><i
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

                <form action="{{ url('bawaslu/store') }}" id="form-data" method="post">
                    @csrf
                    <input name="id" type="hidden">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Entry Data Bawaslu</h5>

                        </div>
                        <div class="modal-body">
                            <div class="w-full mt-2">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Nama Bawaslu</label>
                                            <input class="form-control" name="nama" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Singkatan Penomoran Surat</label>
                                            <input class="form-control" name="singkatan_penomoran_surat" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Username</label>
                                            <input class="form-control" name="username" type="text">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Password</label>
                                            <input class="form-control" name="password" type="password">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Provinsi</label>
                                            <select class="form-control" name="provinsi_id" type="text">
                                                @foreach ($provinsi as $it)
                                                    <option value="{{ $it->id_provinsi }}">{{ $it->nama_provinsi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">


                                        <div class="form-group ">
                                            <label for="">Kabupaten</label>
                                            <select class="form-control" name="kabupaten_id" type="text">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="">Kecamatan</label>
                                            <select class="form-control" name="kecamatan_id" type="text">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary text-primary" type="submit">Simpan</button>
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
        $("[name='provinsi_id']").change(function() {
            getDistrictsByProvince($(this).val()).then((res) => {
                const options = res.map((item) => {
                    return `<option value="${item.id_kabupaten}">${item.nama_kabupaten}</option>`
                })
                $("[name='kabupaten_id']").html(options)
            });
        });
        $("[name='kabupaten_id']").change(function() {
            getSubdistrictsByDistrict($(this).val()).then((res) => {
                const options = res.map((item) => {
                    return `<option value="${item.id_kecamatan}">${item.nama_kecamatan}</option>`
                })
                $("[name='kecamatan_id']").html(options)
            });
        });
        $(".btn-edit").click(function() {
            $("#add-data").click();
            const url = $("meta[name='url']").attr("content");
            (`${url}/api/bawaslu/find`).findById($(this).data("id")).then((res) => {
                $("[name='id']").val(res.id);
                $("[name='nama']").val(res.nama);
                $("[name='provinsi_id']").val(res.provinsi_id).trigger('change');
                setTimeout(() => {
                    $("[name='kabupaten_id']").val(res.kabupaten_id).trigger('change');
                }, 500);
                setTimeout(() => {
                    $("[name='kecamatan_id']").val(res.kecamatan_id);
                }, 1000);

                //username
                $("[name='username']").val(res.user.username);

            });
            $("#form-data").attr("action", `{{ url('bawaslu/store') }}/${$(this).data("id")}`)
        });
    </script>
@endpush
