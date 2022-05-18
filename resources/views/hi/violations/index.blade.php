@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Input Pelanggaran </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Pelanggaran Page</li>
      </ol>
    </div>
  </div>
</div>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-md-12">
        
      <div class="card mb-3">
          <div class="card-body table-responsive p-0">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>
            {{ session('success') }}
          </strong>
          </div>
        @else

        @endif

          
      </div>
    </div>


  <!-- Default box -->
  <div class="card">
      <div class="card-header">
         <div class="card-tools">
            <form action="/violations" >     
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Nomer KTP</th>
              <th>JOb Level / Departemen</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->number_of_employees }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->national_id }}</td>
                    <td>
                      {{ $employee->job->job_level }} / {{ $employee->department->department  }}
                    </td>
                    <td>{{ $employee->status_employee }}</td>
                    <td>
                        <!-- <a href="/violations/{{ $employee->id }}" class="btn  btn-outline-primary">
                          Lihat
                        </a> -->
                        <a href="/violations/{{ $employee->id }}/edit" class="btn  btn-outline-warning">
                          Pelanggran
                        </a>

                            <!-- <form action="/datamaster/employees/{{ $employee->id }}" method="POST" class="d-inline ">
                                @method('delete')
                                @csrf
                                <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                                    Delete
                                </button>
                            </form> -->
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div> --}}
      <div class="card-footer">
        <h3 class="card-title">Total : {{$count}}</h3>
        <div class="pagination pagination-sm m-0 float-right">
            {{ $employees->links() }}
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </div>



</section>
<!-- /.content -->
</div>

@endsection