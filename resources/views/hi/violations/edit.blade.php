@extends('layouts.main')

@section('container')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Employees Detail</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<!-- Main content -->
  <section class="content">

    <div  class="row">

      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{  $employee->name  }}</h3>
            <p class="text-muted text-center">
              <?php
                  $job = DB::table('jobs')->find($employee->job_id);
                  $department = DB::table('departments')->find($employee->department_id);
              ?>
                {{  $employee->number_of_employees  }} <br>
                {{  $job->job_level  }} <br>
                {{  $department->department  }} 
            </p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Tgl masuk</b> <a class="float-right">{{  $employee->hire_date  }}</a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{  $employee->email  }}</a>
              </li>
              <li class="list-group-item">
                <b>Phone Number</b> <a class="float-right">{{  $employee->phone  }}</a>
              </li>
              <!-- <li class="list-group-item">
                <b>Create at</b> <a class="float-right">{{  $employee->created_at  }}</a>
              </li> -->
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>{{ $employee->status_employee }}</b></a>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <div class="col-md-9">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">DAFTAR PELANGGARAN</h3>
          </div>
          <div class="card-body">                       
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>date</th>
                  <th>No Surat</th>
                  <th>Pasal</th>
                  <th>Pelanggran</th>
                  <th>Status </th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              @foreach($violations as $violation):
                <tr>
                  <td>{{ $iteration->loop }}</td>
                  <td>{{ $violation->date_violation }}</td>
                  <td>{{ $violation->date_violation }} </td>
                  <td>{{ $violation->alphabet_id }}</td>
                  <td>{{ $violation->date_violation }}</td>
                  <td>{{ $violation->violation_status  }}</td>
                  <td>
                      <a href="file:///c%3A/xampp/htdocs/hrd/resources/views/hi/violations/cetak_sp.html" class="btn  btn-outline-primary">
                        Cetak                    </a>
                          <!-- <a href="/hi/employees//edit" class="btn  btn-outline-warning">
                        Edit
                        </a> -->
                        <!-- <form action="/hi/employees/" method="POST" class="d-inline ">
                          @method('delete')
                          @csrf
                          <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                          Delete
                        </button>
                        </form> -->
                  </td>
                </tr>

              @endforeach
                <tr>
                  <td>1</td>
                  <td>2022-03-01</td>
                  <td>No. : 34/SP-HRD/IV/2022</td>
                  <td> Pasal 27 ayat (2) huruf "c"</td>
                  <td>SP 1 </td>
                  <td>Aktif</td>
                  <td>
                      <a href="file:///c%3A/xampp/htdocs/hrd/resources/views/hi/violations/cetak_sp.html" class="btn  btn-outline-primary">
                        Cetak                    </a>
                          <!-- <a href="/hi/employees//edit" class="btn  btn-outline-warning">
                        Edit
                        </a> -->
                        <!-- <form action="/hi/employees/" method="POST" class="d-inline ">
                          @method('delete')
                          @csrf
                          <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                          Delete
                        </button>
                        </form> -->
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>2022-03-01</td>
                  <td>No. : 35/SP-HRD/IV/2022</td>
                  <td> Pasal 27 ayat (3) huruf "b"</td>
                  <td><input type="text" name="select_violation_oldest" class="form-control" id="select_violation_oldest"></td>
                  <td>Aktif</td>
                  <td>
                      <a href="file:///c%3A/xampp/htdocs/hrd/resources/views/hi/violations/cetak_sp.html" target="_blna" class="btn  btn-outline-primary">
                        Cetak                    </a>
                          <!-- <a href="/hi/employees//edit" class="btn  btn-outline-warning">
                        Edit
                        </a> -->
                        <!-- <form action="/hi/employees/" method="POST" class="d-inline ">
                          @method('delete')
                          @csrf
                          <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                          Delete
                        </button>
                        </form> -->
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item">
                <!-- <input type="text" name="select_violation_last" id="select_violation_last"> -->
                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->

                <!-- <select name="select_violation_last" id="select_violation_last">
                  <option value="sp1">sp1</option>
                  <option value="sp2">sp2</option>
                  <option value="sp3">sp3</option>
                  <option value="sp4">sp4</option>
                </select> -->
              </li>
              <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
              <li class="page-item">
              </li>
            </ul>
          </div>
        </div>
                    <!-- /.card -->


                                        <!-- general form elements -->
        <div class="card card-warning">
          <div class="card-header mb-2">
            <h3 class="card-title">PROESS</h3>
          </div>
          <div class="card-body">                      
            <div class="form-group row"> 
              <label for="pkb" class="col-sm-1 col-form-label">PKB </label>                         
              <div class="col-sm-9">
                <select class="form-control select2bs4"  name="alphabet_id" id="select_violation_last">
                  @foreach($alphabets as $alphabet):
                    <?php  $print_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                    <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                    <option value="{{$alphabet->id}}" >PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->description}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-2">
              <button class="btn btn-button btn-primary"  onclick="btn_proses()" id="btn_proses" data-id="btn_proses" data-target="btn_proses" >Proses</button>
          
              </div>
            </div> 
          </div>
        </div>

        <?php
          $date_now = date('Y-m-d');
          echo date("l, d F Y", strtotime($date_now));
          echo '<br>';
          echo $day = gmdate("l", time()+60*60*7);
          echo '<br>';
          echo $month_m = gmdate("m", time()+60*60*7);
          echo '<br>';
          echo $month_n = gmdate("n", time()+60*60*7);

          $m_month = "'". $month_m ."'";
          echo '<br>';

          $tgl1 = $date_now;// pendefinisian tanggal awal
          $tgl2 = date('Y-m-d', strtotime('+180 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
          echo $tgl2; //print tanggal
          echo '<br>';

          // Nomer SP
         echo $num_no_sp = DB::table('violations')
                          ->where('month_of_violation', '=', $m_month)
                          ->count();
          echo '<br>';
          if($num_no_sp == 0){
            $no_sp = 1;
          }elseif($num_no_sp > 0){
            $sel_no_sp = DB::table('violations')
                          ->latest();

                          $no_sp = $sel_no_sp + 1 ;

          }

          $var = 1234567;
          echo is_numeric($var) ? "Jumlah digit dari bilangan ".$var." adalah ".strlen($var) : 'Bukan Termasuk Angka';
          echo '<br>';

          if(strlen($no_sp) == '1'){
            $p_no_sp = '00'. $no_sp;
          }elseif(strlen($no_sp) == '2'){
            $p_no_sp = '0'.$no_sp;
          }

          echo $p_no_sp;
          echo '<br>';

          // Hari ROMAWI
          if($day == 'Monday'){
            $day_num = '1';
            $day_indo = 'Senin';
          }elseif($day == 'Tuesday'){
            $day_num = '2';
            $day_indo = 'Selasa';            
          }elseif($day == 'Wednesday'){
            $day_num = '3';
            $day_indo = 'Rabu';            
          }elseif($day == 'Thursday'){
            $day_num = '4';
            $day_indo = 'Kamis';            
          }elseif($day == 'Friday'){
            $day_num = '5';
            $day_indo = 'Jumat';            
          }elseif($day == 'Saturday'){
            $day_num = '6';
            $day_indo = 'Sabtu';            
          }elseif($day == 'Sunday'){
            $day_num = '7';
            $day_indo = 'Minggu';            
          }
          echo $day_indo;
          echo '<br>';
          echo $day_num;

          echo '<br>';
          if($month_n == '1'){
            $ROM = 'I';
          }elseif($month_n == '2'){
            $ROM = 'II';
          }elseif($month_n == '3'){
            $ROM = 'III';
          }elseif($month_n == '4'){
            $ROM = 'IV';
          }elseif($month_n == '5'){
            $ROM = 'V';
          }elseif($month_n == '6'){
            $ROM = 'VI';
          }elseif($month_n == '7'){
            $ROM = 'VII';
          }elseif($month_n == '8'){
            $ROM = 'VIII';
          }elseif($month_n == '9'){
            $ROM = 'IX';
          }elseif($month_n == '10'){
            $ROM = 'X';
          }elseif($month_n == '11'){
            $ROM = 'XI';
          }elseif($month_n == '12'){
            $ROM = 'XII';
          }
          echo $ROM;

          echo "<br/>";
          $awal  = date_create('2022-04-10');
          $akhir = date_create(); // waktu sekarang
          $diff  = date_diff( $awal, $akhir );

          echo 'Selisih waktu: ';
          echo $diff->y . ' tahun, ';
          echo $diff->m . ' bulan, ';
          echo $diff->d . ' hari, ';
          echo $diff->h . ' jam, ';
          echo $diff->i . ' menit, ';
          echo $diff->s . ' detik, ';

          // Cari data pelanggan terakhir 
          $sel_num_vio = DB::table('violations')->where('employee_id', $employee->id)->count();
          if($sel_num_vio == 0){
            $sta_viol = 'notviolation';
          }else{
            $sel_vio = DB::table('violations')->where('employee_id', $employee->id)->latest()->first();
            $date_now = date('Y-m-d');
            $date_sta = $sel_vio->date_violation;
            $diff  = date_diff($date_sta, $date_now);

            if($diff->d <= 0){
              $sta_viol = 'notviolation';
            }else{
              $sta_viol = $sel_vio->status_violation;
            }
          }

        ?>
        <!-- INISIASI AKUMULASI PELANGGARAN -->
        <input type="text" name="last_vio" value="{{$sta_viol}}" id="last_vio">
        <input type="text" name="id_emp" value="{{$employee->id}}" id="id_emp">


        <button type="button" id="btn_modal_click1" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl1">
          Surat Peringatan asli
        </button>
        <div class="modal fade" id="modal-xl1">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambahkan pelanggaran 1</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form role="form" action="/hi/violations" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- <p>One fine body&hellip;</p> -->
  
                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Nomer SP </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" value="{{$p_no_sp}}/SP-HRD/{{$ROM}}/{{date('Y')}}" placeholder="Nomer Induk Karyawan" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Nama </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{  $employee->id  }}" placeholder="Nomer Induk Karyawan" >
                      <input type="text" class="form-control" value="{{  $employee->name  }}" placeholder="Nomer Induk Karyawan" >
                  </div>
                  <label for="number_of_employees" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" value="{{  $employee->number_of_employees  }}" placeholder="Finger ID" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Jabatan </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="job_level" name="job_level" value="{{  $job->job_level  }}" placeholder="Nomer Induk Karyawan" >
                  </div>
                  <label for="finger_id" class="col-sm-2 col-form-label">Bagian / Department</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="part" name="part" value="{{  $department->department  }}" placeholder="Finger ID" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Jenis Pelangaran</label>
                  <div class="col-sm-3">
                      <input type="text" class="form-control" id="jpn1" name="type_of_violation"  placeholder="Jenis Pelanggaran" >     
                  </div>
                </div> 
            
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Pasal Yang dilanggar : </label>
                  <input type="text" class="form-control" name="alphabet_id"  value="" placeholder="Alphabet ID" >                  
                  <div class="col-sm-10" >

                    <p id="pkb1">
                    </p>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Keterangan lain :</label>
                  <div class="col-sm-10">
                      <form …>
                          <input id="x" type="hidden" name="other_information">
                          <trix-editor input="x"></trix-editor>
                        </form>
                    {{-- <input type="text" class="form-control" id="jpn" name="jpn" value="-	Mencekrollkan absensi sdr. Arum Kusumaningtyas dan sdr. Arum Wahyunigsih pada Selasa, 5 April 2022">      --}}
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Remainder : </label>
                  <div class="col-sm-10" id="remainder">
                    
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-12 col-form-label">
                    Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran ) maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                  </label>
                  
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Tanggal Surat :</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control" id="date_of_violation" name="date_of_violation" value="<?= date('Y-m-d') ?>">     
                  </div>
                  <label for="inputName" class="col-sm-3 col-form-label">Human Resource Development :</label>
                  <div class="col-sm-3">
                      <?php  $signature  = DB::table('signatures')->where('status_signature', 'active')->latest()->first(); ?>

                    <input type="text" class="form-control" id="" name="signature_id" value="{{ $signature->signature_id }}">     
                    <input type="text" class="form-control" id=""  value="{{ $signature->name }}">     
                  </div>
                </div> 

              </div> 
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                <!-- /.modal -->

                
        <button type="button" id="btn_modal_click2" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl2">
          Surat Peringatan Akumulasi
        </button>
        <div class="modal fade" id="modal-xl2">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambahkan pelanggaran 2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- <p>One fine body&hellip;</p> -->
                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Nomer SP </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="number_of_employees" name="no_violation" value="{{ $p_no_sp }}/SP-HRD/{{$ROM}}/{{ date('Y') }}" placeholder="Nomer Induk Karyawan" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Nama </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}" placeholder="Nomer Induk Karyawan" >
                  </div>
                  <label for="finger_id" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="{{$employee->number_of_employees}}" placeholder="Finger ID" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Jabatan </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="number_of_employees" name="job_level" value="{{  $job->job_level  }}" placeholder="Nomer Induk Karyawan" >
                  </div>
                  <label for="finger_id" class="col-sm-2 col-form-label">Bagian / Department</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="department" name="department" value="{{  $department->department  }}" placeholder="Finger ID" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Jenis Pelangaran</label>
                  <div class="col-sm-3">
                      <input type="text" class="form-control" id="jpn2" name="jpn"  placeholder="Jenis Pelanggaran" >     
                  </div>
                </div> 
            
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Pasal Yang dilanggar : </label>
                  <div class="col-sm-10">
                    <p>
                        Perjanjian Kerja Bersama Pasal 27 ayat (5) huruf "c". Pekerja sudah diberikan Sanksi SP III (tiga), yang masa berlakunya belum habis tetapi melakukan pelanggaran kembali yang bobot sanksinya SP III (tiga) atau SP II (dua) atau SP I (satu)..
                    </p>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Keterangan lain :</label>
                  <div class="col-sm-10">
                      <form …>
                          <input id="x" type="hidden" name="content">
                          <trix-editor input="x">
                              -	Mangkir Tanggal 11 dan 26 Oktober 2021
                              -	Bobot Pelanggaran sekarang yaitu Perjanjian Kerja Bersama Pasal 27 ayat (2) huruf "g" Tidak masuk kerja tanpa keterangan/ Alpa selama 2 (dua) hari tidak berturut-turut selama satu bulan.
                              -	Dalam masa Surat Peringatan Ketiga Perjanjian Kerja Bersama Pasal 27 ayat (4) huruf "b"; Perjanjian Kerja Bersama Pasal 27 ayat (2) huruf "m"., Melakukan checkroll kehadiran, tetapi tidak berada di produksi tanpa keterangan dispensasi dan non-job
                              

                          </trix-editor>
                        </form>
                    {{-- <input type="text" class="form-control" id="jpn" name="jpn" value="-	Mencekrollkan absensi sdr. Arum Kusumaningtyas dan sdr. Arum Wahyunigsih pada Selasa, 5 April 2022">      --}}
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-12 col-form-label">
                    Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran ) maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                  </label>
                  
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Tanggal Surat :</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control" id="jpn" name="jpn" value="<?= date('Y-m-d') ?>">     
                  </div>
                  <label for="inputName" class="col-sm-3 col-form-label">Human Resource Development :</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="jpn" name="jpn" value="Nama manager">     
                  </div>
                </div> 

              </div> 
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                <!-- /.modal -->
    


      </div>
    </div>

  </section>
</div>

@endsection