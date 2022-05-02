@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create Menu</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Menu Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div  class="row">
            <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form Add Menu</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" action="/menus" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                          <label for="menu">Menu</label>
                          <input type="text" class="form-control" name="menu" id="menu" placeholder="menu">
                        </div>
                                 
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
        
                  </div>
    </div>



</section>
<!-- /.content -->


</div>

@endsection