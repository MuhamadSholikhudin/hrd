@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Department Detail</h1>
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
  <div  class="row">
    <div class="col-md-6">
      <div class="card card-primary">    
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputPassword1">Departeman</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="department" value="{{  $department->department  }}" placeholder="" required>
            </div>
            <div class="card-footer">
              <a href="/departments"  class="btn btn-primary float-right">kembali</a>
            </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->


</div>

@endsection