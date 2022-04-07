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
                      <p class="text-muted text-center">{{  $employee->number_of_employees  }}</p>
                      <ul class="list-group list-group-unbordered mb-3">
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
                    <!-- general form elements -->
                   <!--  <div class="card card-warning">
                      <div class="card-header mb-2">
                        <h3 class="card-title">List Investigation</h3>
                      </div> -->
                      <!-- /.card-header -->
                      <!-- form start -->
                      <!-- <a href="/hi/investigation/create" class="btn btn-block btn-primary mb-2" width="50px">+ add investigation</a>

                      <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>date</th>
                              <th>Kronologi</th>
                              <th>Status</th>
                              <th>Reason</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>2022-03-01</td>
                              <td>telah mencuri</td>
                              <td>Harus diberi SP 1</td>
                              <td>
                                  <a href="/hi/employees/" class="btn  btn-outline-primary">
                                    Show                    </a>
                                      <a href="/hi/employees//edit" class="btn  btn-outline-warning">
                                    Edit
                                    </a>
                                    <form action="/hi/employees/" method="POST" class="d-inline ">
                                      @method('delete')
                                      @csrf
                                      <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                                      Delete
                                    </button>
                                    </form>
                              </td>
                            </tr>
                     
                          </tbody>
                        </table>
                    </div> -->
                    <!-- /.card -->
                    <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title">List Warning Letter</h3>
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
                                    <a href="/hi/violations/" class="btn  btn-outline-primary">
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
                                    <a href="/hi/violations/" class="btn  btn-outline-primary">
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
                        <button type="button" id="btn_modal_click" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl">
                          Launch Extra Large Modal
                        </button>
                        
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <select class="form-control select2bs4"  name="select_violation_last" id="select_violation_last">
                                  <option value="sp1" selected>PASAL 27 1 a / 1.PERINGATAN LISAN / a.Tidak mematuhi peraturan atau kebijakan Perusahaan dalam bentuk anjuran atau larangan.</option>
                                  <option value="sp2" >PASAL 27 2 a / 2.PEMBINAAN DAN SURAT PERINGATAN KE-1 (SP I) / a.Pekerja yang telah diberikan peringatan lisan, dalam masa 6 (enam) bulan mengulangi kesalahan dengan bobot Surat Peringatan Lisan.</option>
                                  <option value="sp3" >PASAL 27 3 a / 3.PEMBINAAN DAN SURAT PERINGATAN SP-2 (SP II) / a.Pekerja yang sudah diberikan sanksi SP-I yang masa berlakunya belum habis, dan mengulangi pelanggaran kembali yang bobot sanksinya SP I.</option>
                                  <option value="sp4" >PASAL 27 5 a / 3.PEMBINAAN DAN SURAT PERINGATAN SP-2 (SP II) / a.Pekerja yang sudah diberikan sanksi SP-I yang masa berlakunya belum habis, dan mengulangi pelanggaran kembali yang bobot sanksinya SP I.</option>
                                </select>
                              </div>
                            </div>
      
                          <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item">
                  
                              <!-- <input type="text" name="select_violation_last" id="select_violation_last"> -->
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                              <!-- <select name="select_violation_last" id="select_violation_last">
                                <option value="sp1">sp1</option>
                                <option value="sp2">sp2</option>
                                <option value="sp3">sp3</option>
                                <option value="sp4">sp4</option>
                              </select> -->

                            </li>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="page-item">
                              <button class="page-link"  onclick="btn_proses()" id="btn_proses" data-id="btn_proses" data-target="btn_proses" >Proses</button>
                                  <!-- 
                                        // cari jenis pelanggaran aktif
  
                                    //Logika pelanggaran
                                   -->
                              <script>

                                 function btn_proses(){
                                //  var select_violation = 'notviolation';
                                //  alert(violation_now);
                                    var select_violation = document.getElementById("select_violation_oldest").value;
                                    var violation_now = document.getElementById("select_violation_last").value;
                                  //  alert(select_violation + ' ' + violation_now);
                                  //  alert();
                                  if(select_violation == '' && violation_now == 'sp1'){
                                    document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP1";
                                   }
                                   if(select_violation == 'notviolation' && violation_now == 'sp1'){
                                      document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP1";
                                   }
                                   if(select_violation == 'sp1' && violation_now == 'sp1'){
                                      document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP2";
                                    // alert("SP 2");
                                   }
                                   if(select_violation == 'sp1' && violation_now == 'sp2'){
                                    document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP3";
                                   }
                                   if(select_violation == 'sp2' && violation_now == 'sp1'){
                                      document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP3";
                                   }
                                   if(select_violation == 'sp2' && violation_now == 'sp2'){
                                    // alert("SP 4");
                                    document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP4";
                                   }
                                   if(select_violation == 'sp2' && violation_now == 'sp3'){
                                    // alert("SP 4");
                                    document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "SP4";
                                   }
                                   if(select_violation == 'sp3' && violation_now == 'sp4'){
                                    // alert("SP PHK");
                                    document.getElementById("btn_modal_click").click();
                                      document.getElementById("jpn").value = "PHK";
                                   }

                                 }
                               </script>
                            </li>
                     
                          </ul>
                        </div>
                      </div>
                    <!-- /.card -->

                    
                <div class="modal fade" id="modal-xl">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Tambahkan pelanggaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    <div class="form-group row">
                      <label for="number_of_employees" class="col-sm-2 col-form-label">NOmer SP </label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="NAma orang" placeholder="Nomer Induk Karyawan" >
                      </div>
                     
                    </div>

                    <div class="form-group row">
                      <label for="number_of_employees" class="col-sm-2 col-form-label">Nama </label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="NAma orang" placeholder="Nomer Induk Karyawan" >
                      </div>
                      <label for="finger_id" class="col-sm-2 col-form-label">NIK</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="finger_id" name="finger_id" value="NIK" placeholder="Finger ID" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="number_of_employees" class="col-sm-2 col-form-label">Jabatan </label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="NAma orang" placeholder="Nomer Induk Karyawan" >
                      </div>
                      <label for="finger_id" class="col-sm-2 col-form-label">Bagian / Department</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="finger_id" name="finger_id" value="NIK" placeholder="Finger ID" >
                      </div>
                    </div>

                    <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Jenis Pelangaran</label>
                    <div class="col-sm-3">
                                 
                          <input type="text" class="form-control" id="jpn" name="jpn"  placeholder="Finger ID" >
                                 
                    </div>
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
        
                    <div class="card card-danger">
                        <div class="card-header">
                          <h3 class="card-title">List Work Termination</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <table class="table table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Kronologi</th>
                                <th>Status</th>
                                <th>Reason</th>
                              </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                          </table>
                        </div>

                    <!-- /.card -->
                  </div>
    </div>



</section>
<!-- /.content -->


</div>

@endsection