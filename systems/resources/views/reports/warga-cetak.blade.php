<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_TITLE') }} Cetak Laporan Warga</title>
    <link rel="shortcut icon" href="{{ asset(env('APP_FAVICON_PATH')) }}" type="image/x-icon">
    <style>
        /* Pengaturan Kertas (A4) */
        @page {
            /* size: A4; */
            size: A4 landscape;
            /* Menentukan ukuran A4 dengan orientasi landscape */
            margin: 1cm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            /* Font standar dokumen resmi */
            font-size: 12px;
            color: #000;
            line-height: 1.4;
            width: 100%;
            /* Pastikan body memenuhi lebar landscape */
        }

        /* Styling Kop Surat */
        .header-table {
            width: 100%;
            border: none;
            border-bottom: 3px double #000;
            /* Garis ganda di bawah kop */
            margin-bottom: 20px;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo {
            width: 80px;
            /* Sesuaikan ukuran logo */
            padding-right: 15px;
        }

        .header-text {
            text-align: center;
            line-height: normal;
        }

        .header-text h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h1 {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 11px;
            font-style: italic;
        }

        .contact-info {
            font-size: 10px !important;
            font-style: normal !important;
        }

        /* Judul Laporan */
        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Styling Tabel Data */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 8px 5px;
        }

        table.data-table th {
            background-color: #d0d0d0;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        /* Optimasi Cetak */
        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <!-- Kop Surat -->
    <table class="header-table">
        <tr>
            <td class="logo">
                <!-- Ganti source image dengan path logo Pemkab Kukar anda -->
                <img src="{{ asset(env('APP_FAVICON_PATH')) }}" width="70" alt="Logo">
            </td>
            <td class="header-text">
                <h2>PEMERINTAH KABUPATEN KUTAI KARTANEGARA</h2>
                <h2>KECAMATAN LOA KULU</h2>
                <h1>DESA LOA KULU KOTA RT. 013</h1>
                <p>Loa Kulu Kota, Kec. Loa Kulu, Kabupaten Kutai Kartanegara, Kalimantan Timur 75571</p>
                <p class="contact-info">Website: <span style="color: blue;">https://loakulukota.desa.id/</span> |
                    Email: <span style="color: blue;">loakulukota.rt013@gmail.com</span></p>
            </td>
        </tr>
    </table>

    <!-- Judul Laporan -->
    <div class="report-title">LAPORAN DATA WARGA</div>

    <!-- Tabel Data -->
    <!-- Tabel Data (Mode Landscape) -->
    <table class="data-table">
        <thead>
            <tr>
                <th width="3%">No</th>
                {{-- <th>No. KK</th> --}}
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th width="8%">JK</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Status Warga</th>
                <th>Status Hubungan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wargas as $index => $warga)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    {{-- <td class="text-center">{{ $warga->no_kk }}</td> --}}
                    <td class="text-center">{{ $warga->nik }}</td>
                    <td class="text-nowrap">{{ $warga->nama }}</td>
                    <td class="text-center">{{ $warga->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $warga->tempat_lahir }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d-m-Y') }}
                    </td>
                    <td class="text-center">{{ $warga->agama }}</td>
                    <td>{{ $warga->pendidikan }}</td>
                    <td>{{ $warga->pekerjaan }}</td>
                    <td class="text-center text-capitalize">{{ $warga->status_warga }}</td>
                    <td class="text-center text-capitalize">{{ $warga->status_hubungan }}</td>
                </tr>
            @empty
                <tr>
                    <!-- Colspan diubah menjadi 12 sesuai jumlah kolom di atas -->
                    <td colspan="12" class="text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Opsional: Tanda Tangan -->
    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Tenggarong, {{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>(....................................)</strong></p>
    </div>

</body>

</html>
