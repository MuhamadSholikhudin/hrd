@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Job Level Page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Department Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="col-md-4">     
    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Department</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="/departments" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">

        <div class="form-group">
            <label for="exampleInputPassword1">Departeman</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="department" placeholder="" required>
        </div>
        <div class="card-footer">
        <button type="submit" class="btn btn-primary float-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- /.content -->


</div>

@endsection