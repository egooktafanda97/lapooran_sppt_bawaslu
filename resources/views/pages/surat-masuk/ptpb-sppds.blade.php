<div class="w-100 card p-2">
    <div class="flex justify-between mb-2">
        <h5><strong>Permohonan Surat Tugas Dan Pecairan SPPD</strong></h5>
        <div class="d-flex">
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
    </div>
    <table class="display responsive nowrap" id="tables" style="width:100%">
        <thead class="btn-primary text-white shadow-md">
        <tr>
            <th>No</th>
            <th>Bawaslu</th>
            <th>Anggota Pemohon</th>
            <th>Nama</th>
            <th>Tanggal Keluar</th>
            <th>Tanggal Berangkat</th>
            <th>Tanggal Pulang</th>
            <th>Nomor SPT</th>
            <th>Jenis Surat</th>
            <th>Perihal</th>
            <th>Status Surat</th>
            <th>Lampiran</th>
            <th>#</th>
        </tr>
        </thead>
        <tfoot class="btn-primary text-white shadow-md">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Bawaslu</th>
            <th>Anggota Pemohon</th>
            <th>Tanggal Keluar</th>
            <th>Tanggal Berangkat</th>
            <th>Tanggal Pulang</th>
            <th>Nomor SPT</th>
            <th>Jenis Surat</th>
            <th>Perihal</th>
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
            <tr>
                <td>
                    {{ $no++ }}
                </td>
                <td>{{ $item->bawaslu->nama ?? '-' }}</td>
                <td>{{ \App\Models\Anggota::whereuserId($item->user_id)->first()->nama ?? '-' }}</td>
                <td>{{ $item->nama ?? '-' }}</td>
                <td>{{ Carbon\Carbon::parse($item->tanggal_keluar_st)->format('Y-m-d') ?? '-' }}</td>
                <td>{{ Carbon\Carbon::parse($item->tanggal_berangkat)->format('Y-m-d') ?? '-' }}</td>
                <td>{{ Carbon\Carbon::parse($item->tanggal_pulang)->format('Y-m-d') ?? '-' }}</td>
                <td>{{ $item->no_spt ?? '-' }}</td>
                <td>{{ $item->jenis_surat->jenis_surat ?? '-' }}</td>
                <td>{{ $item->perihal ?? '-' }}</td>
                <td>
                                <span
                                    class="badge {{ $item->status_surat == 'pending' ? 'bg-label-primary' : ($item->status_surat == 'verify' ? 'bg-label-success' : 'bg-label-danger') }}">
                                    {{ $item->status_surat ?? '-' }}
                                </span>
                </td>
                <td><a href="{{ asset('lampiran-ptpsppds/' . $item->lampiran ?? '-') }}" style="color: blue"
                       target="_blank">{{ $item->lampiran ?? '-' }}</a>
                </td>

                <td>
                    <div>

                        <a href="{{ url('surat-masuk/' . $item->id.'/verify?type=ptpsppds') }}"
                           class="btn-sm btn btn-success">
                            <i class="fa fa-edit"></i> Verifikasi
                        </a>

                        <a href="{{ url('surat-masuk/' . $item->id . '/reject?type=ptpsppds') }}"
                           class="btn-sm btn btn-warning">
                            <i class="fa fa-edit "></i> Rejected
                        </a>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
