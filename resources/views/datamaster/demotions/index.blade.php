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
        <li class="breadcrumb-item active">Blank Page</li>
      </ol>
    </div>
  </div>
</div>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-md-12">
        
      <div class="card">
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
        


<!-- Kelola karyawan =>   -->
&nbsp;
<!-- Button trigger modal -->
<a href="/datamaster/demotions/create" class="btn btn-outline-primary " >
  <i class="fa fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tambah 1 Karyawan"></i>
</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="btn btn-outline-primary" data-toggle="modal"  data-target="#excel_karyawan_baru" >
<i class="fa fa-arrow-up"  data-toggle="tooltip" data-placement="bottom" title="Upload Excel Tambah Data Karyawan Baru "></i>
</a>
<!-- Modal -->
<div class="modal fade" id="excel_karyawan_baru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload excel data karyawan baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('demotions.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
            <p class="text-justify-right">
                <a href="{{asset('excel/FORMAT_DEMOSI_DATA.xlsx')}}">Format Uploads Input Demosi </a>
                <br>
            </p>
          <div class="input-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a  class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Download Excel Data Karyawan">
<i class="fas fa-download"></i>
</a>
        <div class="card-tools">
            <form action="/datamaster/demotions" >     
                <div class="input-group input-group-sm" style="width: 150px;">
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
              <th>NIK ID</th>
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
                    <td>{{ $employee->job->job_level }} / {{ $employee->department->department  }}</td>
                    <td>
                        <a href="/datamaster/demotions/{{ $employee->id }}" class="btn  btn-outline-primary">
                            Lihat
                        </a>
                            <a href="/datamaster/demotions/{{ $employee->id }}/edit" class="btn  btn-outline-warning">
                            Demosi
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

@endsection