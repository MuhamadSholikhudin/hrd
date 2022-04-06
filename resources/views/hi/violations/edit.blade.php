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
                        <table class="table table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Jenis Pelanggran</th>
                                <th>Status </th>
                                <th>Reason</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>2022-03-01</td>
                                <td>SP 1 </td>
                                <td>Aktif</td>
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
                        </div>

                    <!-- /.card -->
        
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