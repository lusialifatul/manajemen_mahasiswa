<!DOCTYPE html>
<html>
<head>
    <title>KRS Mahasiswa</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 0.5in;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 16pt;
        }
        .header h2 {
            margin: 0;
            font-size: 14pt;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 2px 0;
        }
        .course-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .course-table th,
        .course-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .course-table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .footer div {
            width: 45%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <h2>UNIVERSITAS XYZ</h2>
        <p>Tahun Akademik: {{ $krs->tahun_akademik }} Semester: {{ $semester }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="20%">Nama</td>
            <td width="30%">: {{ $mahasiswa->nama_lengkap }}</td>
            <td width="20%">NIM</td>
            <td width="30%">: {{ $mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: Teknik Informatika</td> {{-- Asumsi program studi --}}
            <td>Dosen Pembimbing</td>
            <td>: {{ $dosen_pembimbing->name ?? '-' }}</td>
        </tr>
    </table>

    <table class="course-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSks = 0; @endphp
            @foreach ($krs->krsDetails as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->mataKuliah->kode_mk }}</td>
                    <td>{{ $detail->mataKuliah->nama_mk }}</td>
                    <td>{{ $detail->mataKuliah->sks }}</td>
                </tr>
                @php $totalSks += $detail->mataKuliah->sks; @endphp
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;">Total SKS</td>
                <td>{{ $totalSks }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div>
            <p>Mahasiswa Ybs,</p>
            <br><br><br>
            <p>( {{ $mahasiswa->nama_lengkap }} )</p>
        </div>
        <div>
            <p>Dosen Pembimbing,</p>
            <br><br><br>
            <p>( {{ $dosen_pembimbing->name ?? '-' }} )</p>
        </div>
    </div>
</body>
</html>
