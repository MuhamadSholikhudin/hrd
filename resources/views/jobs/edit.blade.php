@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Jobs</h1>
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
            <form role="form" action="/jobs/{{  $job->id  }}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Kode Job Level</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="code_job_level" value="{{  $job->code_job_level  }}" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Job Level</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="job_level" value="{{  $job->job_level  }}" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Level</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="level" value="{{  $job->level  }}" placeholder="" required>
              </div>
              <div class="card-footer">
                <?php 
                    $url_nowxz = url()->current();
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
                          echo '<button type="submit" class="btn btn-primary float-right">Update</button>';
                        }
                      }
                    }
                ?>
                  <!-- <button type="submit" class="btn btn-primary float-right">Update</button> -->
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