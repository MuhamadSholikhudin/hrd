@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mutasi Karyawan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Mutasi Page</li>
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
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{  $employee->number_of_employees  }}</h3>
                <h3 class="profile-username text-center">{{  $employee->name  }}</h3>
                  <p class="text-muted text-center">{{ $get_job->job_level }} <br>
                      {{ $get_department->department }}
                  </p>
                <div id="t_karyawan_lama">
                </div>
                <a href="#" class="btn btn-primary btn-block"><b>active</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->            
          </div>
          

          <!-- NAV PILLS -->
          <div class="col-md-9">

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
                        <tbody> 
                            @foreach ($startwork_get as $startwork_get)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $startwork_get->job_level }} / {{ $startwork_get->department }} (awal kerja)</td>
                              <td>
                                  {{ $startwork_get->startwork_date }}
                              </td>
                              <td>
                                  {{ $startwork_get->bagian }}
                              </td>
                              <td>
                                  {{ $startwork_get->cell }}
                              </td>
                              <td>
                                  <!-- <a href="employee_show_by_id.html" class="btn  btn-outline-danger btn-sm">Lihat</a> -->
                                  {{-- <a href="promotion_edit_by_id.html" class="btn  btn-outline-warning btn-sm">edit</a> --}}
                              </td>
                            </tr>
                          @endforeach     
                 
                          @foreach ($mutations as $mutation)
                            <tr>
                              <td>{{ $loop->iteration + 1 }}</td>
                              <td>{{ $mutation->department }} / {{ $mutation->job_level }}</td>
                              <td>
                                  {{ $mutation->mutation_date }}
                              </td>
                              <td>
                                  {{ $mutation->bagian }}
                              </td>
                              <td>
                                  {{ $mutation->cell }}
                              </td>
                              <td>
                                  <!-- <a href="employee_show_by_id.html" class="btn  btn-outline-danger btn-sm">Lihat</a> -->
                                  <a href="mutation_edit_by_id.html" class="btn  btn-outline-warning btn-sm">edit</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
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