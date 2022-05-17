@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>PASAL PKB</h1> 
        <br>
        {{-- <a href="/articles/create" class="btn  btn-info">+ Add article</a> --}}
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
  <div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Edit Pasal</h3>
             </div>
             <div class="card-body">

                    {{-- <h4 class="modal-title">Edit Pasal</h4> --}}

                        <form role="form" action="/articles/{{  $article->id  }}" method="POST" enctype="multipart/form-data">
                          @method('put')
                          @csrf
                      <!-- <p>One fine body&hellip;</p> -->
                      <div class="form-group">
                        <label for="">PASAL</label>
                        <input type="hidden" class="form-control" id="" name="id" value="{{ old('id', $article->id) }}" placeholder="Nomor Pasal example : 27">
                        <input type="text" class="form-control" id="" name="article" value="{{ old('article', $article->article) }}" placeholder="Nomor Pasal example : 27">
                      </div>
                      <div class="form-group">
                        <label for="">BAB</label>
                        <input type="text" class="form-control" id="" name="chapters" value="{{ old('chapters', $article->chapters) }}" placeholder="BAB Pasal">
                      </div>
                      <div class="form-group">
                        <label for="">BUNYI PASAL</label>
                        <textarea  class="form-control" id="" name="article_sound"  placeholder="Bunyi pasal"> {{ old('article_sound', $article->article_sound) }}</textarea>
                      </div>
                      <!-- <div class="form-group row">
                          <label for="bank_branch" class="col-sm-3 col-form-label">Periode</label>
                          <div class="col-sm-3">
                            <input type="year" class="form-control" id="bank_branch" name="firts_periode" value="{{ old('firts_periode', $article->firts_periode) }}" >
                          </div>

                          <div class="col-sm-1">
                              -                          
                          </div>
                          <div class="col-sm-3">
                              <input type="year" class="form-control" id="bank_branch" name="last_periode" value="{{ old('last_periode', $article->last_periode) }}" >
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a href="/articles" class="btn btn-default" data-dismiss="modal">kembali</a>
                      <?php 
                        $url_nowxz = url()->current();
                        $url_scc = substr($url_nowxz, 23); 
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
                              echo '<button type="submit" class="btn btn-primary">Update</button>';
                            }
                          }
                        }
                        ?>
                      <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                    </div>
                  </form>
    </div>


          














  
  </div>



</section>
<!-- /.content -->


</div>

@endsection