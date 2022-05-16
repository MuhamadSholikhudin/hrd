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
                          <?php 
                            $url_nowxz = url()->current();
                            $url_scc = substr($url_nowxz, 22); 
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
                                  echo '<button type="submit" class="btn btn-primary">Simpan</button>';
                                }
                              }
                            }
                          ?>
                          <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
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