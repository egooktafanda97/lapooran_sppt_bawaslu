<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://cdn.tailwindcss.com"></script>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet">
    <style>
        /* pint lanscape */
        @page {
            size: A4 landscape;
        }
    </style>
</head>

<body class="w-screen overflow-x-hidden">
    <div class="w-full">
        <div class="flex justify-center items-center mt-8 mb-2 flex-col">
            <h2 class="text-1xl underline">SURAT PERNYATAAN TANGGUNGJAWAB BELANJA (SPTB)</h2>

            <h2 class="text-md">Nomor: {{ $keuangan->no_surat }}</h2>
        </div>
        {{-- <div class="w-full" style="height: 1px; background: gray"></div> --}}

        <table class="text-sm">
            <tr>
                <td>Nama Satuan Kerja</td>
                <td class="pr-2 pl-2">:</td>
                <td>{{ $keuangan->bawaslu->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal DIPA/No.DIPA</td>
                <td class="pr-2 pl-2">:</td>
                <td>{{ $keuangan->no_dipa }}</td>
            </tr>
            <tr>
                <td>Klarifikasi Belanja</td>
                <td class="pr-2 pl-2">:</td>
                <td>{{ $keuangan->klarifikasi_belnja }}</td>
            </tr>
        </table>
    </div>
    <div class="mt-2 text-sm">
        <p>Yang bertandatangan dibawah ini atas nama Kuasa Pengguna Anggaran Satuan Kerja Badan Pengawas Pemilihan Umum
            menyatakan bahwa saya bertanggungjawab formal dan material atas segala pengeluaran yang sudah dibayar lunas
            oleh Bendahara Pengeluaran kepada yang berhak menerima serta kebenaran perhitungan dan setoran pajak yang
            telah dipungut atas pembayaran tersebut dengan perincian sebagai berikut :</p>
    </div>
    <div class="mt-2">
        <table class="border-collapse w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="text-center text-sm border border-gray-400 px-2 py-2" rowspan="2">NO</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2" rowspan="2">NAMA PENERIMA</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2" rowspan="2">URAIAN</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2" colspan="2">BUKTI</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2" rowspan="2">JUMLAH (RP)</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2" colspan="2">PAJAK</th>
                </tr>
                <tr class="bg-gray-200">

                    <th class="text-center text-sm border border-gray-400 px-2 py-2">TANGGAL</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2">NOMOR</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2">PPN</th>
                    <th class="text-center text-sm border border-gray-400 px-2 py-2">PPH</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keuangan->items as $it)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $loop->iteration }}</td>

                        <td class="border border-gray-400 px-4 py-2">{{ $it->nama_penerima }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $it->uraian }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $it->tanggal }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $it->nomor }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ 'Rp. ' . number_format($it->jumlah) }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ 'Rp. ' . number_format($it->ppn) }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ 'Rp. ' . number_format($it->pph) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2 text-sm">
        <p>Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) tersebut di atas disimpan oleh Pengguna
            Anggaran/Kuasa Pengguna Anggaran untuk
            kelengkapan administrasi dan pemeriksaan aparat pengawasan fungsional.
            Demikian Surat Pernyataan ini dibuat dengan sebenarnya.</p>
    </div>
    <div class="mt-2 text-sm">
        <p>Lampiran</p>
        <table>
            <tr>
                <td>Pengeluaran</td>
                <td>{{ 'Rp. ' . number_format($keuangan->pengeluaran ?? 0) }}</td>
            </tr>
            <tr>
                <td>STS</td>
                <td>{{ 'Rp. ' . number_format($keuangan->sts ?? 0) }}</td>
            </tr>

        </table>
    </div>

    <div class="w-screen h-2 mt-4">
        <div class="w-full">
            <div class="flex w-full justify-between items-end">
                <div class="flex items-center flex-col">
                    <div>
                        Pejabat Pembuat Komitmen
                    </div>
                    <div class="h-10"></div>
                    <div class="text-center">
                        {{ \App\Models\Anggota::where('jabatan_id', 1)->first()->nama }}
                        <br>
                        NIP. {{ \App\Models\Anggota::where('jabatan_id', 1)->first()->no_sk }}
                    </div>

                </div>
                <div class="flex items-center flex-col">
                    <div class="flex flex-col justify-center items-center">
                        <div>
                            {{ $keuangan->bawaslu->kecamatan->nama_kecamatan }},
                            {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                        </div>
                        <div>
                            Bendahara Pengeluaran Pembantu
                        </div>
                        <div>Sekretaria Panwaslu {{ $keuangan->bawaslu->kecamatan->nama_kecamatan }} Kabupaten
                            {{ $keuangan->bawaslu->kabupaten->nama_kabupaten }}
                            Singingi
                        </div>
                    </div>
                    <div class="h-10"></div>
                    <div class="text-center">
                        {{ \App\Models\Anggota::where('jabatan_id', 2)->first()->nama ?? null }}
                        <br>
                        NIP. {{ \App\Models\Anggota::where('jabatan_id', 2)->first()->no_sk ?? null }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        window.print()
    </script>
</body>

</html>
