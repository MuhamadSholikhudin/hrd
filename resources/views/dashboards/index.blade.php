@extends('layouts.main')

@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <?php 
          $num_sub_employees = DB::table('sub_menus')->where('url', '/employees')->count(); 
          if($num_sub_employees > 0){
              $print_sub_employees = DB::table('sub_menus')->where('url', '/employees')->first();
              $num_meth_employees = DB::table('methods')
                  ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                  ->where('methods.sub_menu_id', $print_sub_employees->id)
                  ->where('access_menus.role_id', auth()->user()->role_id)
                  ->count();
              if($num_meth_employees > 0){ ?>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <?php 
                          $num_employees = DB::table('employees')->count();
                      ?>
                      <h3>{{$num_employees}}</h3>
                      <p>Karyawan</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="/employees" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              <?php }else{  
            }
          }
        ?>

          <!-- ./col -->

          <?php 
          $num_sub_violations = DB::table('sub_menus')->where('url', '/violations')->count(); 
          if($num_sub_violations > 0){
              $print_sub_violations = DB::table('sub_menus')->where('url', '/violations')->first();
              $num_meth_violations = DB::table('methods')
                  ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                  ->where('methods.sub_menu_id', $print_sub_violations->id)
                  ->where('access_menus.role_id', auth()->user()->role_id)
                  ->count();
              if($num_meth_violations > 0){ ?>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <?php 
                          $num_violations = DB::table('violations')->count();
                      ?>
                      <h3>{{$num_violations}}</h3>
                      <p>Pelanggaran</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-document"></i>
                      <!-- <i class="fa-light fa-file-circle-info"></i> -->
                    </div>
                    <a href="/hiviolations" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <?php 
                          $bul = date('m');
                          $num_violations = DB::table('violations')->whereMonth('date_of_violation', $bul)->count();
                      ?>
                      <h3>{{$num_violations}}</h3>
                      <p>Pelanggaran Bulan ini</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-document"></i>
                      <!-- <i class="fa-light fa-file-circle-info"></i> -->
                    </div>
                    <a href="/hiviolations" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <?php 
                          $num_violations = DB::table('violations')->where('violation_status', 'active')->count();
                      ?>
                      <h3>{{$num_violations}}</h3>
                      <p>Pelanggaran Aktif</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-document"></i>
                      <!-- <i class="fa-light fa-file-circle-info"></i> -->
                    </div>
                    <a href="/hiviolations" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <?php 
                          $num_violations = DB::table('violations')->where('violation_status', 'notactive')->count();
                      ?>
                      <h3>{{$num_violations}}</h3>
                      <p>Pelanggaran Tidak Aktif</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-document"></i>
                      <!-- <i class="fa-light fa-file-circle-info"></i> -->
                    </div>
                    <a href="/hiviolations" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              <?php }else{  
            }
          }
        ?>



          <?php 
          $num_sub_layoffs = DB::table('sub_menus')->where('url', '/layoffs')->count(); 
          if($num_sub_layoffs > 0){
              $print_sub_layoffs = DB::table('sub_menus')->where('url', '/layoffs')->first();
              $num_meth_layoffs = DB::table('methods')
                  ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                  ->where('methods.sub_menu_id', $print_sub_layoffs->id)
                  ->where('access_menus.role_id', auth()->user()->role_id)
                  ->count();
              if($num_meth_layoffs > 0){ ?>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <?php 
                          $num_layoffs = DB::table('layoffs')->count();
                      ?>
                      <h3>{{$num_layoffs}}</h3>
                      <p>PHK</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-pulse"></i>
                    </div>
                    <a href="/layoffs" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              <?php }else{  
            }
          }
        ?>

         <?php 
            $num_sub_users = DB::table('sub_menus')->where('url', '/users')->count(); 
            if($num_sub_users > 0){
                $print_sub_users = DB::table('sub_menus')->where('url', '/users')->first();
                $num_meth_users = DB::table('methods')
                    ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                    ->where('methods.sub_menu_id', $print_sub_users->id)
                    ->where('access_menus.role_id', auth()->user()->role_id)
                    ->count();
                if($num_meth_users > 0){ ?>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                      <?php 
                            $num_users = DB::table('users')->count();
                        ?>
                        <h3>{{$num_users}}</h3>

                        <p>User Akses</p>
                      </div>
                      <div class="icon">
                        <i class="fa-solid fa-right-to-bracket"></i>
                      </div>
                      <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                <?php }else{  
              }
            }
          ?>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
 

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection