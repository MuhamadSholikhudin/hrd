@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Promosi Karyawan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Promosi Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nama Karyawan</h3>
                <p class="text-muted text-center">
                  Jabatan <br>
                  Departemen
                </p>
                <div class="form-group">
                      <select class="form-control" id="pil_karyawan">
                        <option value="baru">Karyawan baru</option>
                        <option value="karyawan_lama">Mantan karyawan</option>
                      </select>
                    </div>
                <div id="t_karyawan_lama">


                </div>
                <!-- <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul> -->

                <a href="#" class="btn btn-primary btn-block"><b>active</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Informasi</h3>
              </div>
              <div class="card-body">

              @foreach ($errors->all() as $message)
                          {{$message}} <br>
                            @endforeach
              
              </div>
              
            </div>
            <!-- About Me Box -->
            <!-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              
            </div> -->
            
          </div>
          

          <!-- NAV PILLS -->
          <div class="col-md-9">
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Promosi Karyawan</h3>
                  </div>
                  <div class="card-body">
                    <!-- Date -->
                    <form class="form-horizontal">
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Pilih Job level Promosi</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                              <select class="form-control select2bs4" style="width: 100%;">
                                  <option selected="selected">Staff / HRD</option>
                                  <option>Senior Staff / HRD</option>
                                  <option>Supervisor / HRD</option>
                                  <option>Leader / Cutting</option>
                                  <option>Superviser / Cutting</option>

                                </select>
                          </div>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                            <!-- <label for="inputName2" class="col-sm-2 col-form-label">Tempat lahir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                            </div> -->

                            <label for="inputName2" class="col-sm-2 col-form-label">Tanggal Promosi</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="inputName2" placeholder="Name">
                            </div>
                        </div>

                        
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Bagian</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" placeholder="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Cell</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" placeholder="">
                          </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                </label>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group row">

                        </div>
                    </form>
                  <!-- /.card-body -->
                </div>
              </div>

              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Riwayat Promosi</h3>
                  </div>
                  <div class="card-body">
                    <!-- Date -->
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Promosi</th>
                            <th>Tanggal Promosi</th>
                            <th>Bagian</th>
                            <th>Cell</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Asisten Manager / Cutting</td>
                            <td>
                                2022-04-10
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <!-- <a href="employee_show_by_id.html" class="btn  btn-outline-danger btn-sm">Lihat</a> -->
                                <a href="promotion_edit_by_id.html" class="btn  btn-outline-warning btn-sm">edit</a>
                            </td>
                          </tr>
                          <tr>
                              <td>2.</td>
                              <td>Superviser / Cutting</td>
                              <td>
                                  2022-04-10
                              </td>
                              <td></td>
                              <td></td>
                              <td>
                                  <!-- <a href="employee_show_by_id.html" class="btn  btn-outline-danger btn-sm">Lihat</a> -->
                                  <a  class="btn  btn-outline-warning btn-sm">edit</a>
                              </td>
                          </tr>
                          <tr>
                              <td>3.</td>
                              <td>Leader / Cutting</td>
                              <td>
                                  2022-04-10
                              </td>
                              <td></td>
                              <td></td>
                              <td>
                                  <!-- <a href="employee_show_by_id.html" class="btn  btn-outline-danger btn-sm">Lihat</a> -->
                                  <a  class="btn  btn-outline-warning btn-sm">edit</a>
                              </td>
                          </tr>

                        </tbody>
                      </table>
                  <!-- /.card-body -->
                </div>
              </div>
            <!-- /.card -->
          </div>
        </div>

      </div>
</section>



</div>


<script>
    $('#pil_karyawan').change(function() {
    var pil_kar = $(this).val();

    if( pil_kar == 'karyawan_lama'){
      // alert("karyawan lama");
      $('#t_karyawan_lama').append("<select class='form-control select2bs4' style='width: 100%;' id='car_kar' name='job_id'>  <option value='nama' selected>Nama karyawa / no ktp</option>  </select>" );


    }else{
      $( "#car_kar" ).remove();
    }

  })
</script>
@endsection