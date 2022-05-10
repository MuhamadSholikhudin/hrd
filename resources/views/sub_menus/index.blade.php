@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sub Menu</h1> 
        <br>
        <a href="/sub_menus/create" class="btn  btn-info">+ Add Sub Menu</a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Sub Menu Page</li>
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
              <th>Sub Menu</th>
              <th>URL</th>
              <th>Icon</th>
              <th>Is active</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($sub_menus as $sub_menu)
            <tr>
              <td>{{ $sub_menu->id }}</td>
              <?php $menu = DB::table('menus')->find($sub_menu->menu_id) ?>
              <td>{{ $menu->menu }}</td>
              <td>{{ $sub_menu->title }}</td>
              <td>{{ $sub_menu->url }}</td>
              <td>{{ $sub_menu->icon }}</td>
              <td>{{ $sub_menu->is_active }}</td>
              <td>
                  <a href="/sub_menus/{{ $sub_menu->id }}" class="btn  btn-outline-primary">
                    Show
                  </a>
                      <a href="/sub_menus/{{ $sub_menu->id }}/edit" class="btn  btn-outline-warning">
                    Edit
                    </a>
                    <form action="/sub_menus/{{ $sub_menu->id }}" method="POST" class="d-inline ">
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