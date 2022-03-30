@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Karyawan</h1>
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
          <!-- Kelola karyawan =>   -->
          &nbsp;
            <!-- Button trigger modal -->
            <a href="employee_by_id.html" class="btn btn-outline-primary " >
                <i class="fa fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tambah 1 Karyawan"></i>
            </a>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a  class="btn btn-outline-primary btn-xs" data-toggle="modal"  data-target="#excel_karyawan_baru" >
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
                      <div class="modal-body">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
            &nbsp;
            <a class="btn btn-outline-primary btn-xs" data-toggle="modal"  data-target="#excel_karyawan_update" >
              <i class="fas fa-upload" data-toggle="tooltip" data-placement="bottom" title="Upload Excel Update Data Karyawan"></i>
            </a>
             <!-- Modal -->
             <div class="modal fade"  id="excel_karyawan_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Upload excel Update data karyawan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            &nbsp;
            <a  class="btn btn-outline-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Download Excel Data Karyawan">
              <i class="fas fa-download"></i>
            </a>
        </div>
      
    </div>

  <!-- Default box -->
  <div class="card">
      <div class="card-header">
        <h3 class="card-title">Responsive Hover Table</h3>
        <div class="card-tools">
            <form action="/hi/employees" >     
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
                        <a href="/datamaster/employees/{{ $employee->id }}" class="btn  btn-outline-primary">
                            Show
                        </a>
                            <a href="/datamaster/employees/{{ $employee->id }}/edit" class="btn  btn-outline-warning">
                            Edit
                            </a>
                            <form action="/datamaster/employees/{{ $employee->id }}" method="POST" class="d-inline ">
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
      <div class="card-footer">
        {{-- <h3 class="card-title">Responsive Hover Table</h3> --}}
        <div class="row justify-content-center mb-3">
          <div class="col-lg-6">
            {{ $employees->links() }}
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  <!-- /.card -->
</section>
<!-- /.content -->
</div>

@endsection