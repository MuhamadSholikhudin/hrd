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
  
  
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>
            {{ session('success') }}
          </strong>
          </div>
        @else

        @endif

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="http://10.10.100.148/hwi/Photo/10000/{{  $employee->number_of_employees  }}.jpg" alt="User profile picture">

                  <!-- <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture"> -->
                </div>

                <h3 class="profile-username text-center">{{  $mutation->number_of_employees  }}</h3>
                <h3 class="profile-username text-center">{{  $mutation->name  }}</h3>

                  <p class="text-muted text-center">{{ $mutation->job_level }} <br>
                      {{ $mutation->department }}
                  </p>

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
          </div>
          

          <!-- NAV PILLS -->
          <div class="col-md-9">
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Mutasi Karyawan</h3>
                  </div>
                  <div class="card-body">
                    <!-- Date -->
                    <form role="form" action="/mutations" method="POST" enctype="multipart/form-data">
                    @method('put')  
                    @csrf
                    <input type="hidden" class="form-control"  name="id" value="{{ old('id', $mutation->id) }}">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Job level</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" style="width: 100%;" name="job_id">
                            @foreach ($jobs as $job)
                              @if(old('job_id', $mutation->job_id) == $job->id)
                                <option value="{{ $job->id }}" selected>{{ $job->code_job_level }} / {{ $job->job_level }}</option>
                              @else
                                <option value="{{ $job->id }}" >{{ $job->code_job_level }} / {{ $job->job_level }}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <label for="inputName" class="col-sm-2 col-form-label">Departemen</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" name="department_id" style="width: 100%;">
                            @foreach ($departments as $department)
                              @if(old('department_id', $mutation->department_id) == $department->id)
                                <option value="{{ $department->id }}" selected>{{ $department->department }} </option>
                              @else
                                <option value="{{ $department->id }}" >{{ $department->department }}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                        
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Tanggal Mutasi</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="inputName2" name="mutation_date" value="<?php echo date("Y-m-d") ?>">
                            </div>
                        </div>
                       
                         <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Bagian</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" name="bagian" value="{{ old('bagian', $mutation->bagian) }}" placeholder="">
                          </div>
                        </div>
                       
                         <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Cell</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" name="cell" value="{{ old('cell', $mutation->cell) }}" placeholder="">
                          </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-sm-10">
                        </div>
                        
                          <div class="col-sm-2">
                          <?php 
                                $url_nowxz = url()->current();
                                $sum_url =SUM_URL_WEB;
                                $url_scc = substr($url_nowxz, $sum_url); 
                                $pecah = explode("/", $url_scc);
                                $kalimat1 = $pecah[0];
                                $num_sub = DB::table('sub_menus')->where('url', '/'.$kalimat1)->count(); 
                                if($num_sub > 0){
                                  $print_sub = DB::table('sub_menus')->where('url', '/'.$kalimat1)->first();
                                  $num_meth = DB::table('methods')
                                    ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                                    ->where('methods.sub_menu_id', $print_sub->id)
                                    ->where('access_menus.role_id', auth()->user()->role_id)
                                    ->count();
                                  if($num_meth > 0){
                                    $prt_meth = DB::table('methods')
                                    ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                                    ->select('methods.edit as edit', 'methods.delete as delete','methods.delete as view')
                                    ->where('methods.sub_menu_id', $print_sub->id)
                                    ->where('access_menus.role_id', auth()->user()->role_id)
                                    ->first();
                                    $edit = $prt_meth->edit;
                                    if($edit == 'true'){
                                      echo '<button type="submit" class="btn btn-primary "><i class="fas fa-arrows-rotate"></i> Mutasikan</button>';
                                    }
                                  }
                                }
                            ?>


                            <!-- <button type="submit" class="btn btn-success "><i class="fas fa-edit"> </i>Update</button> -->
                          </div>
                        </div>
                    </form>
                  <!-- /.card-body -->
                </div>
              </div>

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