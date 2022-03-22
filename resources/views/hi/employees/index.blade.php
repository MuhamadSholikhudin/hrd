@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employees</h1> 
        <br>
        <a href="/hi/employees/create" class="btn  btn-info">+ Add Employee</a>
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


  <!-- Default box -->
  <div class="card">
      <div class="card-header">
        <h3 class="card-title">Responsive Hover Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Date</th>
              <th>Status</th>
              <th>Reason</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($employees as $employee)
            <tr>
              <td>{{ $employee->number_of_employees }}</td>
              <td>{{ $employee->name }}</td>
              <td>{{ $employee->email }}</td>
              <td><span class="tag tag-success">{{ $employee->phone_number }}</span></td>
              <td>
                  <a href="/hi/employees/{{ $employee->id }}" class="btn  btn-outline-primary">
Show                    </a>
                      <a href="/hi/employees/{{ $employee->id }}/edit" class="btn  btn-outline-warning">
                    Edit
                    </a>
                    <form action="/hi/employees/{{ $employee->id }}" method="POST" class="d-inline ">
                      @method('delete')
                      @csrf
                      <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                      Delete
                    </button>
                    </form>
              </td>
            </tr>
            @endforeach
     
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  <!-- /.card -->

</section>
<!-- /.content -->


</div>

@endsection