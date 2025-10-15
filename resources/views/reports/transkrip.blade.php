<!DOCTYPE html>
<html>
<head>
    <title>Transkrip Nilai Mahasiswa</title>
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
        <h1>TRANSKRIP NILAI</h1>
        <h2>UNIVERSITAS XYZ</h2>
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
                <th>Semester</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Huruf</th>
            </tr>
        </thead>
        <tbody>
            @php $currentSemester = null; @endphp
            @foreach ($grades as $index => $grade)
                @if ($grade['semester'] !== $currentSemester)
                    <tr>
                        <td colspan="6" style="background-color: #e0e0e0; font-weight: bold;">Semester {{ $grade['semester'] }}</td>
                    </tr>
                    @php $currentSemester = $grade['semester']; @endphp
                @endif
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $grade['semester'] }}</td>
                    <td>{{ $grade['kode_mk'] }}</td>
                    <td>{{ $grade['nama_mk'] }}</td>
                    <td>{{ $grade['sks'] }}</td>
                    <td>{{ $grade['nilai_huruf'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right;">Total SKS Kumulatif</td>
                <td>{{ $totalSks }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Indeks Prestasi Kumulatif (IPK)</td>
                <td>{{ number_format($ipk, 2) }}</td>
                <td></td>
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
