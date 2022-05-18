<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>NO SP</th>
            <th>Tanggal Laporan</th>
            <th>Tanggal SP</th>
            <th>Tanggal Berakhir</th>
            <th>Pelangaran</th>
            <th>Pasal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
<tbody>
    @foreach($violations as $violation)
        <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $violation->employee->name }}</td>
        <td>{{ $violation->employee->number_of_employees }}</td>
        <td>{{nomer_sp($violation->no_violation, $violation->id);}}           </td>
        <td> {{ tanggal_pelanggaran($violation->reporting_date); }} </td>
        <td>{{ tanggal_pelanggaran($violation->date_of_violation); }}  </td>
        <td>{{ tanggal_pelanggaran($violation->date_end_violation); }}  </td>
        <td>{{selang($violation->date_end_violation);}}</td>
        <td>{{ $violation->type_of_violation }}</td>
        <td> {{pasal($violation->alphabet_id);}} </td>
        <td>{{ $violation->other_information  }}</td>                
        <td>{{ $violation->violation_status  }}</td>
        <td>     </td>
        </tr>

        @endforeach
    </tbody>
</table>