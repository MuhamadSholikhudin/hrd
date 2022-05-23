

<table border="1">
    <thead>
        <tr style="alignt:center;">
            <th>NIK</th>
            <th>NAMA KARYAWAN</th>
            <th>JABATAN</th>
            <th>DEPARTEMENT</th>
            <th>TGL MASUK</th>
            <th>NO SP</th>
            <th>NO SP</th>
            <th>FORMAT AT</th>
            <th>BULAN SP</th>
            <th>ROM</th>
            <th>HARI LAP (angka)</th>
            <th>HARI LAPORAN</th>
            <th>TGL LAPORAN</th>
            <th>TAHUN</th>
            <th>KATA PENGANTAR</th>
            <th>PASAL YANG DI LANGGAR</th>
            <th>BUNYI PASAL PELANGGARAN SEKARANG JIKA SUDAH PERNAH </th>
            <th>BUNYI PASAL</th>
            <th>PASAL 25 AYAT 2A, 3A, 4A , B, 5A,B DAN C JIKA PERNAH DAPAT SP (PELANGGARAN SEKARANG)</th>
            <th>BUNYI PASAL1</th>
            <th>KETERANGAN LAIN</th>
            <th>KETENGAN LAIN 2</th>
            <th>KETERANGAN LAIN 1</th> 
            <th>PELANGGARAN SEBELUMNYA</th>
            <th>TGL SP</th>   					 	
            <th>KETERANGAN</th>
            <th>REKAP SESUAI DENGAN LAPORAN PELANGGARAN</th>
            <th>tambahan keterangan</th>
            <th>AN HRD</th>	
            <th>Resign</th>	
            <th>TANGGAL PENYAMPAIAN SP</th>	
            <th>CEKLIST</th>			
        </tr>
    </thead>
<tbody>
    @foreach($violations as $violation)
        <tr>
            <td>{{ $violation->employee->number_of_employees }}</td>
            <td>{{ $violation->employee->name }}</td>
            <td>{{ $violation->job_level }}</td>
            <td>{{ $violation->department }}</td>
            <td>{{ $violation->employee->hire_date }}</td>
            <td>NO</td>
            <td>
                <?php 
                    if(strlen($violation->no_violation) == '1'){
                        $p_no_s = '00'. $violation->no_violation;
                    }elseif(strlen($no_violation) == '2'){
                        $p_no_s = '0'.$violation->no_violation;
                    }   else{
                        $p_no_s = $violation->no_violation;
                    } 
                ?>
                    {{$p_no_s}}
            </td>

            <td>SP-HRD</td>
            <td>{{$violation->month_of_violation}}</td>
            <td>{{$violation->violation_ROM}}</td>
            <td>{{ hari_angka($violation->reporting_date); }}</td>
            <td>{{ hari_string($violation->reporting_date); }}</td>
            <td>{{ $violation->reporting_date }}</td>
            <td>{{ tahun($violation->reporting_date); }}</td>
            <td>Sehubungan yang bersangkutan telah melakukan pelanggaran peraturan/tata tertib/disiplin kerja yang berlaku di perusahaan, yaitu </td>
            <td>{{pasal_yang_dilanggar($violation->id); }} </td>
            <td>{{BUNYI_PASAL_PELANGGARAN_SEKARANG_JIKA_SUDAH_PERNAH_DAPAT_SP($violation->id); }} </td>
            <td>{{BUNYI_PASAL($violation->id); }} </td>
            <td>{{PASAL_25_AYAT_2A_3A_4A_B_5A_B_DAN_C_JIKA_PERNAH_DAPAT_SP_PELANGGARAN_SEKARANG($violation->id); }} </td>
            <td>{{BUNYI_PASAL1($violation->id); }} </td>
            <td>{{KETENGAN_LAIN_2($violation->id); }} </td>
            <td>{{KETERANGAN_LAIN_1($violation->id); }} </td>
            <td>{{PELANGGARAN_SEBELUMNYA($violation->id); }} </td>
            <td>{{PELANGGARAN_SEBELUMNYA($violation->id);}}</td>
            <td>
            <?php 
                $date_of_violation = new DateTime($violation->date_of_violation.' 00:00:00.0');
                 $result_date_of_violation = $date_of_violation->format('d/m/Y');
            ?>
            {{$result_date_of_violation}}
            </td>
            <td>{{$violation->type_of_violation}}</td>
          <td>- </td>
           <td>- </td>
            <td>{{an_hrd($violation->signature_id); }} </td>
           <td>
           <?php 
                $active = DB::table('employees')->find($violation->employee_id);

           ?>
           {{$active->status_employee}} </td>
            

        </tr>

        @endforeach
    </tbody>
</table>