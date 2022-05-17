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
        {{-- <a href="/hi/articles/create" class="btn  btn-info">+ Add article</a> --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pasal PKB Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Pasal</h3>
  
              <div class="card-tools">
                  <form action="/hi/pkb" >     
                      <div class="input-group input-group-sm" style="width: 200px;">
                          <button type="button" data-toggle="modal" data-target="#add_pasal"  class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></button>
                        &nbsp;&nbsp;&nbsp;
                          <input type="text" name="search_pasal" value="{{ request('search_pasal') }}" class="form-control float-right" placeholder="Search">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
            
            <div class="modal fade" id="add_pasal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Pasal</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="/articles" method="POST" enctype="multipart/form-data">
                          @csrf
                      <!-- <p>One fine body&hellip;</p> -->
                      <div class="form-group">
                        <label for="">PASAL</label>
                        <input type="text" class="form-control" id="" name="article" placeholder="Nomor Pasal example : 27">
                      </div>
                      <div class="form-group">
                        <label for="">BAB</label>
                        <input type="text" class="form-control" id="" name="chapters" placeholder="BAB Pasal">
                      </div>
                      <div class="form-group">
                        <label for="">BUNYI PASAL</label>
                        <textarea  class="form-control" id="" name="article_sound" placeholder="Bunyi pasal"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                              echo '<button type="submit" class="btn btn-primary">Simpan</button>';
                            }
                          }
                        }
                        ?>
                      <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                    </div>
                  </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

          <!-- /.card-header -->
          <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Pasal</th>
                    <th>Bab</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $article->article }}</td>
                    <td>
                        {{ $article->chapters }}
                    </td>
                    <td>{{ $article->article_sound }}</td>
                    <td>
                        <div class="tools">
                          <a href="/articles/{{ $article->id }}/edit">
                            <i class="fas fa-edit"></i>
                            edit
                          </a>
                          </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                  {{ $articles->links() }}
              </ul>
            </div>
          </div>

    </div>


  </div>



</section>
<!-- /.content -->


</div>

@endsection