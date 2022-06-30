@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users</h1> 
        <br>
        <a href="/users/create" class="btn  btn-info">+ Add user</a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Users Page</li>
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
        <h3 class="card-title">Data Users Akses</h3>

        <div class="card-tools">
        <form action="/users" >     
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
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
              
              <?php $role = DB::table('roles')->find($user->role_id); ?>
              {{ $role->role }}
              </td>
              <td>
                  <a href="/users/{{ $user->id }}/password" class="btn  btn-outline-primary">
                    Change Password
                  </a>

                  
            <?php 
              $url_nowxz = url()->current();
              $jumlah_url = 23;
              $sum_url =SUM_URL_WEB;
            $url_scc = substr($url_nowxz, $sum_url); 
              $pecah = explode("/", $url_scc);
              $kalimat1 = $pecah[0];
              $num_sub = DB::table('sub_menus')->where('url', '/'.$kalimat1)->count(); 
              if($num_sub > 0){
                $print_sub = DB::table('sub_menus')->where('url', '/'.$kalimat1)->first();
                $num_meth = DB::table('methods')
                  ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                  ->where('methods.sub_menu_id', $print_sub->id)
                  ->where('access_menus.role_id', auth()->user()->role_id)
                  ->count();
                if($num_meth > 0){
                  $prt_meth = DB::table('methods')
                  ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                  ->select('methods.edit as edit', 'methods.delete as delete','methods.delete as view')
                  ->where('methods.sub_menu_id', $print_sub->id)
                  ->where('access_menus.role_id', auth()->user()->role_id)
                  ->first();
                  $edit = $prt_meth->edit;
                  
                  if($edit == 'true'){
                    echo '<a href="/users/'.$user->id .'/edit" class="btn  btn-outline-warning">Edit</a>';
                  }
                }
              }
            ?> 

                      <!-- <a href="/users/{{ $user->id }}/edit" class="btn  btn-outline-warning">
                    Edit
                    </a> -->
                    <!-- <form action="/users/{{ $user->id }}" method="POST" class="d-inline ">
                      @method('delete')
                      @csrf
                      <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                      Delete
                    </button>
                    </form> -->
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