@extends('inc.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
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
