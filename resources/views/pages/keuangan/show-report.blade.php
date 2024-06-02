@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- search unit --}}
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form action="" method="get">
                    <div class="flex">
                        <select class="form-control mb-2" id="unit" name="unit">
                            <option value="">=== Unit Kerja ===</option>
                            @foreach ($unit_kerja as $item)
                                <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <div>
                            <button class="btn btn-primary text-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-end mb-2">

            <div class="w-full ">
                <table class="display responsive nowrap" id="tables" style="width:100%">
                    <thead class="btn-primary text-white shadow-md">
                        <tr>
                            <th class="w-[30px]">No</th>
                            <th>Nomor Surat</th>
                            <th>Laporn Tanggl</th>
                            <th>Nama Satuan Kerja</th>
                            <th>Total Anggaran</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot class="btn-primary text-white  shadow-md">
                        <tr>
                            <th class="w-[30px]">No</th>
                            <th>Nomor Surat</th>
                            <th>Laporn Tanggl</th>
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
                                <td>{{ $item->tanggal_start }} / {{ $item->tanggal_end }}</td>
                                <td>{{ $item->user->anggota->nama }}</td>
                                <td>{{ 'Rp. ' . collect($item->items)->sum('jumlah') }}</td>
                                <td>
                                    <div>
                                        <a class="btn btn-primary text-white"
                                            href="{{ url('keuangan/report-super/' . $item->id) }}" target="_blank"
                                            title="laporan">
                                            <i class="fa fa-file"></i>
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
