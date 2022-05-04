@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">User Page</li>
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
                        <h3 class="card-title">Form Edit User</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" action="/users/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="{{$user->id}}" placeholder="Nama">
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="Nama">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{$user->email}}" placeholder="email">
                          </div>

                          <div class="form-group">
                            <label for="phone_number">Role Id</label>
                            <select class="form-control" name="role_id" id="">
                              @foreach ($roles as $role)
                                @if(old('role_id', $user->role_id) == $role->id)
                                  <option value="{{ $role->id }}" selected>{{ $role->role}} </option>
                                @else
                                  <option value="{{ $role->id }}" >{{ $role->role }} </option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="phone_number">Is Active</label>
                            <select class="form-control" name="is_active" id="">
                              @foreach ($is_active as $x => $x_value)
                                @if(old('is_active', $user->is_active) == $x)
                                  <option value="{{ $x_value }}" selected>{{ $x}} </option>
                                @else
                                  <option value="{{ $x_value }}" >{{ $x }} </option>
                                @endif
                              @endforeach

                            </select>
                          </div>
                     
                          {{-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div> --}}
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <a href="/userslist" class="btn btn-success">Kembali</a>
                          <button type="submit" class="btn btn-primary">Update</button>
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