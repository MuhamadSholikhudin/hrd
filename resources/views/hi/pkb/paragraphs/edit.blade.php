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
          <li class="breadcrumb-item active">Blank Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-9">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Edit Pasal</h3>
            </div>
            <div class="card-body">
                    {{-- <h4 class="modal-title">Edit Pasal</h4> --}}
              <form role="form" action="/paragraphs/{{  $paragraph->id  }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                <!-- <p>One fine body&hellip;</p> -->
                <div class="form-group">
                    <label for="article_id">Pasal</label>
                    <input type="hidden" class="form-control" id="" name="id" value="{{ old('id', $paragraph->id) }}" placeholder="Nomor Pasal example : 27">      
                    <select class="form-control select2bs4"  name="article_id" id="article_id">
                      @foreach ($articles as $article)
                        @if(old('article_id', $paragraph->article_id) == $article->id)
                          <option value="{{ $article->id }}" selected>{{ $article->article}} </option>
                        @else
                          <option value="{{ $article->id }}" >{{ $article->article }} </option>
                        @endif
                      @endforeach
                    </select>
                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Pasal example : 27"> -->
                  </div>
                  <div class="form-group">
                    <label for="article_id">Ayat</label>
                    <input type="text" class="form-control" id="paragraph" name="paragraph" value="{{ old('paragraph', $paragraph->paragraph) }}" placeholder="BAB Pasal">
                  </div>
                  <div class="form-group">
                    <label for="description">Sub Bab</label>
                    <textarea  class="form-control" id="" name="sub_chapters"  placeholder="Bunyi pasal">{{ old('sub_chapters', $paragraph->sub_chapters) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Keterangan</label>
                    <textarea  class="form-control" id="" name="description" placeholder="Bunyi pasal">{{ old('description', $paragraph->description) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="type_of_verse">Jenis Ayat</label>
                    <select class="form-control select2bs4"  name="type_of_verse" id="type_of_verse">
                      @foreach ($type_of_verse as $type_of_verse)
                        @if(old('type_of_verse', $paragraph->type_of_verse) == $type_of_verse)
                          <option value="{{ $type_of_verse }}" selected>{{ $type_of_verse}} </option>
                        @else
                          <option value="{{ $type_of_verse }}" >{{ $type_of_verse }} </option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <a href="/paragraphs" class="btn btn-default" data-dismiss="modal">kembali</a>
                  <div class="modal-footer justify-content-between">
                <a href="/alphabets" class="btn btn-default" data-dismiss="modal">kembali</a>
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