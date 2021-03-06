@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>jobs</h1> 
        <br>
        <a href="/jobs/create" class="btn  btn-info">+ Add Jobs</a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">jobs Page</li>
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
        <h3 class="card-title">Data Job Level</h3>

        <div class="card-tools">
        <form action="/jobs" >     
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
              <th>Kode Jobs</th>
              <th>Descripition</th>
              <th>Level</th>
              <th>Reason</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($jobs as $job)
            <tr>
              <td>{{ $job->id }}</td>
              <td>{{ $job->code_job_level }}</td>
              <td>{{ $job->job_level }}</td>
              <td>{{ $job->level }}</td>
              <td>
                  <a href="/jobs/{{ $job->id }}/edit" class="btn  btn-outline-warning">
                    Edit
                  </a>
                    {{-- <form action="/jobs/{{ $job->id }}" method="POST" class="d-inline ">
                      @method('delete')
                      @csrf
                      <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                      Delete
                    </button>
                    </form> --}}
              </td>
            </tr>
            @endforeach

          </tbody>

        </table>
      </div>
      <div class="card-footer">
        {{-- <h3 class="card-title">Data</h3> --}}
      
        <div class="pagination pagination-sm m-0 float-right">
          {{ $jobs->links() }}
        </div>
        
      </div>
     
      <!-- /.card-body -->
    </div>
  <!-- /.card -->

</section>
<!-- /.content -->


</div>

@endsection