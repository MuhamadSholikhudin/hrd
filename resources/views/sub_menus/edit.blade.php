@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Menu</h1>
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

    <div  class="row">
            <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form Edit Sub Menu</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" action="/sub_menus/{{$sub_menu->id}}" method="POST" enctype="multipart/form-data">
                        @method('put') 
                        @csrf
                        <div class="card-body">
                        <input type="hidden" class="form-control" name="id" value="{{ old('id', $sub_menu->id) }}" >
                        
                            <div class="form-group">
                              <label for="phone_number">Menu</label>
                              <select class="form-control" name="menu_id" id="">
                                @foreach ($menus as $menu)
                                  @if(old('menu_id', $sub_menu->menu_id) == $menu->id)
                                    <option value="{{ $menu->id }}" selected>{{ $menu->menu }} </option>
                                  @else
                                    <option value="{{ $menu->id }}" >{{ $menu->menu }} </option>
                                  @endif
                                @endforeach

                              </select>
                            </div>
                          <div class="form-group">
                            <label for="title">Sub Menu</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $sub_menu->title) }}" id="title" placeholder="menu">
                          </div>
                          <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" name="url" value="{{ old('url', $sub_menu->url) }}" id="menu" placeholder="menu">
                          </div>
                          <div class="form-group">
                            <label for="icon">icon</label>
                            <input type="text" class="form-control" name="icon" value="{{ old('url', $sub_menu->icon) }}" id="icon" placeholder="menu">
                          </div>
                    
                          <div class="form-group">
                            <label for="phone_number">Is Active</label>
                            <select class="form-control" name="is_active" id="">
                              @foreach ($is_active as $x => $x_value)
                                @if(old('is_active', $sub_menu->is_active) == $x_value)
                                  <option value="{{ $x_value }}" selected>{{ $x}} </option>
                                @else
                                  <option value="{{ $x_value }}" >{{ $x }} </option>
                                @endif
                              @endforeach

                            </select>
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