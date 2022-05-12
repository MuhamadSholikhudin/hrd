@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Menu</h1> 
        <br>
        <a href="/menus/create" class="btn  btn-info">+ Add Menu</a>
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


  <!-- Default box -->
  <div class="card">
      <div class="card-header">
        <h3 class="card-title">Responsive Hover Table</h3>

        <div class="card-tools">
        <form action="/userlist" >     
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
              <th>Menu</th>
  
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($menus as $menu)
            <tr>
              <td>{{ $menu->id }}</td>

              <td>{{ $menu->menu }}</td>
              <td>
                  <!-- <a href="/menus/{{ $menu->id }}" class="btn  btn-outline-primary">
                    Show
                  </a> -->
                      <a href="/menus/{{ $menu->id }}/edit" class="btn  btn-outline-warning">
                    Edit
                    </a>
                    <form action="/menus/{{ $menu->id }}" method="POST" class="d-inline ">
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