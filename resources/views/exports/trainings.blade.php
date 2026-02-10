<table>
    <thead>
    <tr>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">NAMA PELATIHAN</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">PENYELENGGARA</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">TANGGAL MULAI PENYELENGGARAAN</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">TANGGAL SELESAI PENYELENGGARAAN</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">NAMA PEGAWAI</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">NIP PEGAWAI</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">UNIT KERJA PEGAWAI</th>
        <th colspan="4" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">KETERANGAN</th>
        <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: center; font-weight: bold;">UPLOAD SERTIFIKAT</th>
    </tr>
    <tr>
        <th style="border: 1px solid #000; text-align: center; font-weight: bold;">sudah</th>
        <th style="border: 1px solid #000; text-align: center; font-weight: bold;">belum</th>
        <th style="border: 1px solid #000; text-align: center; font-weight: bold;">lulus</th>
        <th style="border: 1px solid #000; text-align: center; font-weight: bold;">tidak</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trainings as $training)
    <tr>
        <td style="border: 1px solid #000;">{{ $training->training_name }}</td>
        <td style="border: 1px solid #000;">{{ $training->organizer }}</td>
        <td style="border: 1px solid #000;">{{ $training->start_date }}</td>
        <td style="border: 1px solid #000;">{{ $training->end_date }}</td>
        <td style="border: 1px solid #000;">{{ $training->employee->name ?? '' }}</td>
        <td style="border: 1px solid #000;">'{{ $training->employee->nip ?? '' }}</td>
        <td style="border: 1px solid #000;">{{ $training->employee->unit ?? ($training->employee->institute->name ?? '') }}</td>
        <td style="border: 1px solid #000; text-align: center;"></td>
        <td style="border: 1px solid #000; text-align: center;"></td>
        <td style="border: 1px solid #000; text-align: center;"></td>
        <td style="border: 1px solid #000; text-align: center;"></td>
        <td style="border: 1px solid #000;">
            @if($training->certificate_file)
                {{ url('storage/' . $training->certificate_file) }}
            @else
                -
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
