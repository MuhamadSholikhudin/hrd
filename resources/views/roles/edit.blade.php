@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Role Page</li>
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
                        <h3 class="card-title">Form Edit Role {{$role->role}}</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      
                        <div class="card-body">
                          {{-- <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" name="role" id="role" placeholder="Role">
                          </div> --}}
                          <div class="form-group">
                            {{-- <label for="role">Menu</label> --}}
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Menu</th>
                                  <th>Checked</th>
                                  <th>Sub Menu</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($menus as $menu)
                                <tr>
                                  <td valign="top">{{$menu->menu}}</td>
                                  <td valign="top">
                                    <div class="form-check text-align">
                                      <?php $num_access = DB::table('access_menus')->where('menu_id', $menu->id)->where('role_id', $role->id)->count(); ?> 
                                      <input class="form-check-input" type="checkbox"
                                      <?php 
                                        if($num_access > 0){
                                            echo  'checked="checked"'; 
                                        }else{

                                        }
                                      ?>
                                        data-menu="{{$menu->id}}" data-role="{{ $role->id }}" >
                                      
                                    </div>
                                  </td>
                                  <td valign="top">
                                    <?php $sub_menus = DB::table('sub_menus')->where('menu_id', $menu->id)->get(); ?>
                                    @foreach($sub_menus as $sub_menu)
                                      {{$sub_menu->title}} <br>
                                    @endforeach
                                  </td>
                                  
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>

                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <a href="/roles" type="submit" class="btn btn-primary">Kembali</a>
                        </div>
                     
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
        
                  </div>
    </div>



</section>
<!-- /.content -->


</div>

@endsection