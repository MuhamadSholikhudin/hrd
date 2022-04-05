@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Demosi Karyawan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Demosi Page</li>
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
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{  $demotion->number_of_employees  }}</h3>
                <h3 class="profile-username text-center">{{  $demotion->name  }}</h3>

                  <p class="text-muted text-center">{{ $demotion->job_level }} <br>
                      {{ $demotion->department }}
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
                <a href="#" class="btn btn-primary btn-block"><b>{{  $demotion->status_employee  }}</b></a>
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
                    <h3 class="card-title">Demosi Karyawan</h3>
                  </div>
                  <div class="card-body">
                    <!-- Date -->
                    <form role="form" action="/datamaster/demotions" method="POST" enctype="multipart/form-data">
                    @method('put')  
                    @csrf
                    <input type="hidden" class="form-control"  name="id" value="{{ old('id', $demotion->id) }}">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Job level</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" style="width: 100%;" name="job_id">
                            @foreach ($jobs as $job)
                              @if(old('job_id', $demotion->job_id) == $job->id)
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
                              @if(old('department_id', $demotion->department_id) == $department->id)
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
                            <label for="inputName2" class="col-sm-2 col-form-label">Tanggal Promosi</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="inputName2" name="demotion_date" value="<?php echo date("Y-m-d") ?>">
                            </div>
                        </div>
                       
                         <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Bagian</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" name="bagian" value="{{ old('bagian', $demotion->bagian) }}" placeholder="">
                          </div>
                        </div>
                       
                         <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Cell</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" name="cell" value="{{ old('cell', $demotion->cell) }}" placeholder="">
                          </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-sm-10">
                        </div>
                        
                          <div class="col-sm-2">
                            <button type="submit" class="btn btn-success "><i class="fas fa-edit"> </i>Update</button>
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