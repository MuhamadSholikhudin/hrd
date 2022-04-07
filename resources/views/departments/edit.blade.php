@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit departments</h1>
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
    <div class="col-md-6">
      <div class="card card-primary">    
        <div class="card-body">
            <form role="form" action="/departments/{{  $department->id  }}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf

              <div class="form-group">
                <label for="exampleInputPassword1">Departemant</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="department" value="{{  $department->department  }}" placeholder="" required>
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Update</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->


</div>

@endsection