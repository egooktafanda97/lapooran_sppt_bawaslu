@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="flex justify-between mb-2 mt-2">
                                <h2 class="text-lg font-bold">Tambahkan Item</h2>
                                <button class="btn btn-primary btn-md text-white"data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" type="button">
                                    <i class="fa fa-plus mr-2"></i> Tambah Items
                                </button>
                            </div>
                            <div class="w-full table-responsive shadow">
                                <table class="table display responsive nowrap" id="item-tables" style="width:100%">
                                    <thead class="shadow-md bg-gray-300 text-sm text-dark">
                                        <tr>
                                            <th class="w-[30px]">No</th>
                                            <th>No Surat</th>
                                            <th>No Surat Pencairan</th>
                                            <th>Dikeluarkan Oleh</th>
                                            <th>Nama Penerima</th>
                                            <th>Uraian</th>
                                            <th>Tanggal Surat</th>
                                            <th>Tanggal Terima</th>
                                            <th>Jumlah</th>
                                            <th>PPN</th>
                                            <th>PPH</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="shadow-md bg-gray-300 text-dark">
                                        <tr>
                                            <th class="w-[30px]">No</th>
                                            <th>No Surat</th>
                                            <th>No Surat Pencairan</th>
                                            <th>Dikeluarkan Oleh</th>
                                            <th>Nama Penerima</th>
                                            <th>Uraian</th>
                                            <th>Tanggal Surat</th>
                                            <th>Tanggal Terima</th>
                                            <th>Jumlah</th>
                                            <th>PPN</th>
                                            <th>PPH</th>
                                            <th>#</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="bodyTb">
                                        @foreach ($keuangan as $item)
                                            <tr>
                                                <td style="padding:10px">{{ $loop->iteration }}</td>
                                                <td style="padding:10px">{{ $item->nomor }}</td>
                                                <td style="padding:10px">{{ $item->no_surat_pencairan }}</td>
                                                <td style="padding:10px">{{ $item->dikeluarkan_oleh }}</td>
                                                <td style="padding:10px">{{ $item->nama_penerima }}</td>
                                                <td style="padding:10px">{{ $item->uraian }}</td>
                                                <td style="padding:10px">{{ $item->tanggal_surat }}</td>
                                                <td style="padding:10px">{{ $item->tanggal_terima }}</td>
                                                <td style="padding:10px">{{ number_format($item->jumlah, 0, ',', '.') }}
                                                </td>
                                                <td style="padding:10px">{{ number_format($item->ppn, 0, ',', '.') }}</td>
                                                <td style="padding:10px">{{ number_format($item->pph, 0, ',', '.') }}</td>
                                                <td style="padding:10px">
                                                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}"
                                                        onClick="destory({{ $item->id }})"
                                                        type="button">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Keuangan</h1>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ url('keuangan/store-unit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nomor Surat</label>
                                <input class="form-control mb-2" name="nomor" type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="">Nomor Surat Pencairan</label>
                                <input class="form-control mb-2" name="no_surat_pencairan" type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="">Dikeluarkan Oleh Penerima</label>
                                <input class="form-control mb-2" name="dikeluarkan_oleh" type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="">Nama Penerima</label>
                                <input class="form-control mb-2" name="nama_penerima" placeholder="nama penerima"
                                    type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="">Uraian</label>
                                <input class="form-control mb-2" name="uraian" type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="">Tanggal</label>
                                <input class="form-control mb-2" name="tanggal_surat" type="date"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Tanggal</label>
                                <input class="form-control mb-2" name="tanggal_terima" type="date"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Jumlah</label>
                                <input class="form-control mb-2" name="jumlah" type="number">
                            </div>
                            <div class="col-md-6">
                                <label for="">PPN</label>
                                <input class="form-control mb-2" name="ppn" type="number">
                            </div>
                            <div class="col-md-6">
                                <label for="">PPH</label>
                                <input class="form-control mb-2" name="pph"type="number">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('inc.dt_tble')
@push('script')
    <script>
        // (function() {
        //     const keuangan = JSON.parse(`@json($keuangan)`) || {};
        //     sessionStorage.setItem("data", JSON.stringify(keuangan.items ?? []));
        //     console.log(keuangan);
        //     pushTables()
        // })()
        // $("#addItems").click(function() {
        //     const data = JSON.parse(sessionStorage.getItem("data")) || [];

        //     const items = {
        //         "max": $("[name='max']").val(),
        //         "nama_penerima": $("[name='nama_penerima']").val(),
        //         "uraian": $("[name='uraian']").val(),
        //         "tanggal": $("[name='tanggal']").val(),
        //         "nomor": $("[name='nomor']").val(),
        //         "jumlah": $("[name='jumlah']").val(),
        //         "ppn": $("[name='ppn']").val(),
        //         "pph": $("[name='pph']").val()
        //     }
        //     // append data
        //     data.push(items);
        //     sessionStorage.setItem("data", JSON.stringify(data));
        //     pushTables()
        // });
        // let USDollar = new Intl.NumberFormat('en-US', {
        //     style: 'currency',
        //     currency: 'USD',
        // });
        //remove data
        // function destory(Id) {
        //     const id = Id;
        //     const data = JSON.parse(sessionStorage.getItem("data"));
        //     data.splice(id, 1);
        //     sessionStorage.setItem("data", JSON.stringify(data));
        //     pushTables()
        // }

        // function pushTables() {
        //     let IDRupiah = new Intl.NumberFormat('id-ID', {
        //         style: 'currency',
        //         currency: 'IDR'
        //     });
        //     $("#bodyTb").html("");
        //     const data = JSON.parse(sessionStorage.getItem("data"));
        //     $("#string-items").val(JSON.stringify(data));
        //     if (data != null && data != undefined) {
        //         data.forEach((item, index) => {
        //             $("#bodyTb").append(`
    //             <tr>
    //                 <td style="padding:10px">${index + 1}</td>
    //                 <td style="padding:10px">${item.max}</td>
    //                 <td style="padding:10px">${item.nama_penerima}</td>
    //                 <td style="padding:10px">${item.uraian}</td>
    //                 <td style="padding:10px">${item.tanggal}</td>
    //                 <td style="padding:10px">${item.nomor}</td>
    //                 <td style="padding:10px">${IDRupiah.format(item.jumlah)}</td>
    //                 <td style="padding:10px">${IDRupiah.format(item.ppn)}</td>
    //                 <td style="padding:10px">${IDRupiah.format(item.pph)}</td>
    //                 <td style="padding:10px">
    //                     <button class="btn btn-danger btn-sm" onClick="destory(${item.id})" data-id="${index}" type="button">Hapus</button>
    //                 </td>
    //             </tr>
    //         `)
        //         })
        //     }
        // }
    </script>
@endpush
