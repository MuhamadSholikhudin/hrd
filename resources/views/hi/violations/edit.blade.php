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
                            // $job = DB::table('jobs')
                            //       ->where(['id', '=' , $employee->job_id])
                            //       ->get();

                            // $department = DB::table('departments')
                            //       ->whereColumn(['id', '=' ,  $employee->department_id])
                            //       ->get();
                            // DB::table('jobs')->where('votes', 100)->get();
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
                    <!-- /.card -->
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
                          <select class="form-control select2bs4"  name="select_violation_last" id="select_violation_last">
                            <option value="sp1" selected>PASAL 27 1 a / 1.PERINGATAN LISAN / a.Tidak mematuhi peraturan atau kebijakan Perusahaan dalam bentuk anjuran atau larangan.</option>
                            <option value="sp2" >PASAL 27 2 a / 2.PEMBINAAN DAN SURAT PERINGATAN KE-1 (SP I) / a.Pekerja yang telah diberikan peringatan lisan, dalam masa 6 (enam) bulan mengulangi kesalahan dengan bobot Surat Peringatan Lisan.</option>
                            <option value="sp3" >PASAL 27 3 a / 3.PEMBINAAN DAN SURAT PERINGATAN SP-2 (SP II) / a.Pekerja yang sudah diberikan sanksi SP-I yang masa berlakunya belum habis, dan mengulangi pelanggaran kembali yang bobot sanksinya SP I.</option>
                            <option value="sp4" >PASAL 27 5 a / 3.PEMBINAAN DAN SURAT PERINGATAN SP-2 (SP II) / a.Pekerja yang sudah diberikan sanksi SP-I yang masa berlakunya belum habis, dan mengulangi pelanggaran kembali yang bobot sanksinya SP I.</option>
                          </select>
                        </div>
                        <div class="col-sm-2">
                        <button class="btn btn-button btn-primary"  onclick="btn_proses()" id="btn_proses" data-id="btn_proses" data-target="btn_proses" >Proses</button>
                              <script>
                                 function btn_proses(){
                                //  var select_violation = 'notviolation';
                                    var select_violation = document.getElementById("select_violation_oldest").value;
                                    var violation_now = document.getElementById("select_violation_last").value;
                                //  alert(select_violation);
                                  //  alert(select_violation + ' ' + violation_now);
                                  //  alert();
                                  if(select_violation == '' && violation_now == 'sp1'){
                                    document.getElementById("btn_modal_click1").click();
                                      document.getElementById("jpn1").value = "SP1";
                                   }
                                  if(select_violation == '' && violation_now == 'sp2'){
                                    document.getElementById("btn_modal_click1").click();
                                      document.getElementById("jpn1").value = "SP2";
                                   }
                                  if(select_violation == '' && violation_now == 'sp3'){
                                    document.getElementById("btn_modal_click1").click();
                                      document.getElementById("jpn1").value = "SP3";
                                   }
                                  if(select_violation == '' && violation_now == 'sp4'){
                                    document.getElementById("btn_modal_click1").click();
                                      document.getElementById("jpn1").value = "SP4";
                                   }
                                   if(select_violation == 'notviolation' && violation_now == 'sp1'){
                                      document.getElementById("btn_modal_click1").click();
                                      document.getElementById("jpn1").value = "SP1";
                                   }
                                   if(select_violation == 'sp1' && violation_now == 'sp1'){
                                      document.getElementById("btn_modal_click2").click();
                                      document.getElementById("jpn1").value = "SP2";
                                    // alert("SP 2");
                                   } 
                                   if(select_violation == 'sp1' && violation_now == 'sp2'){
                                    document.getElementById("btn_modal_click2").click();
                                      document.getElementById("jpn2").value = "SP3";
                                   }
                                   if(select_violation == 'sp2' && violation_now == 'sp1'){
                                      document.getElementById("btn_modal_click2").click();
                                      document.getElementById("jpn2").value = "SP3";
                                   }
                                   if(select_violation == 'sp2' && violation_now == 'sp2'){
                                    // alert("SP 4");
                                    document.getElementById("btn_modal_click2").click();
                                      document.getElementById("jpn2").value = "SP4";
                                   }
                                   if(select_violation == 'sp2' && violation_now == 'sp3'){
                                    // alert("SP 4");
                                    document.getElementById("btn_modal_click2").click();
                                      document.getElementById("jpn2").value = "SP4";
                                   }
                                   if(select_violation == 'sp3' && violation_now == 'sp4'){
                                    // alert("SP PHK");
                                    document.getElementById("btn_modal_click2").click();
                                      document.getElementById("jpn2").value = "PHK";
                                   }
                                 }
                               </script>
                        </div>
                      </div> 
                    </div>

                  </div>

                </div>

                <button type="button" id="btn_modal_click1" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl2">
                    Launch Extra Large Modal
                  </button>
                <div class="modal fade" id="modal-xl1">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Tambahkan pelanggaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- <p>One fine body&hellip;</p> -->
                        <div class="form-group row">
                          <label for="number_of_employees" class="col-sm-2 col-form-label">Nomer SP </label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value=" 34/SP-HRD/IV/2022" placeholder="Nomer Induk Karyawan" >
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="number_of_employees" class="col-sm-2 col-form-label">Nama </label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="Nama orang" placeholder="Nomer Induk Karyawan" >
                          </div>
                          <label for="finger_id" class="col-sm-2 col-form-label">NIK</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="finger_id" name="finger_id" value="NIK" placeholder="Finger ID" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="number_of_employees" class="col-sm-2 col-form-label">Jabatan </label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="Jabatan" placeholder="Nomer Induk Karyawan" >
                          </div>
                          <label for="finger_id" class="col-sm-2 col-form-label">Bagian / Department</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="finger_id" name="finger_id" value="Department" placeholder="Finger ID" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Jenis Pelangaran</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control" id="jpn1" name="jpn"  placeholder="Jenis Pelanggaran" >     
                          </div>
                        </div> 
                    
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Pasal Yang dilanggar : </label>
                          <div class="col-sm-10">
                            <p>
                            Perjanjian Kerja Bersama Pasal 27 ayat (4) huruf "t" Menitipkan dan/atau dititipi scanning absensi.
                            </p>
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Keterangan lain :</label>
                          <div class="col-sm-10">
                              <form …>
                                  <input id="x" type="hidden" name="content">
                                  <trix-editor input="x">
                                  -	Mencekrollkan absensi sdr. Arum Kusumaningtyas dan sdr. Arum Wahyunigsih pada Selasa, 5 April 2022
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
                            <input type="date" class="form-control" id="jpn" name="jpn" value="">     
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

                
                <button type="button" id="btn_modal_click2" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl2">
                    Launch Extra Large Modal
                  </button>
                <div class="modal fade" id="modal-xl2">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Tambahkan pelanggaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- <p>One fine body&hellip;</p> -->
                        <div class="form-group row">
                          <label for="number_of_employees" class="col-sm-2 col-form-label">Nomer SP </label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value=" 34/SP-HRD/IV/2022" placeholder="Nomer Induk Karyawan" >
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="number_of_employees" class="col-sm-2 col-form-label">Nama </label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="Nama orang" placeholder="Nomer Induk Karyawan" >
                          </div>
                          <label for="finger_id" class="col-sm-2 col-form-label">NIK</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="finger_id" name="finger_id" value="NIK" placeholder="Finger ID" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="number_of_employees" class="col-sm-2 col-form-label">Jabatan </label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="Jabatan" placeholder="Nomer Induk Karyawan" >
                          </div>
                          <label for="finger_id" class="col-sm-2 col-form-label">Bagian / Department</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" id="finger_id" name="finger_id" value="Department" placeholder="Finger ID" >
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
                            <input type="date" class="form-control" id="jpn" name="jpn" value="">     
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
<!-- /.content -->


</div>

@endsection