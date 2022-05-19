@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>HURUF PKB</h1> 
        <br>
        {{-- <a href="/hi/articles/create" class="btn  btn-info">+ Add article</a> --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Huruf Page</li>
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
            <h3 class="card-title">Form Edit Huruf PKB</h3>
          </div>
        <div class="card-body">

        {{-- <h4 class="modal-title">Edit Pasal</h4> --}}

            <form role="form" action="/alphabets/{{  $alphabet->id  }}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="form-group row">
                <label for="article_id" class="col-sm-3 col-form-label">Ayat</label>
                <div class="col-sm-9">
                  <input type="hidden" class="form-control" id="" name="id" value="{{ old('id', $alphabet->id) }}" placeholder="Nomor Pasal example : 27">                
                  <select class="form-control select2bs4"  name="paragraph_id" id="paragraph_id">      
                    @foreach ($paragraphs as $paragraph)
                    <?php  $print_article  = DB::table('articles')->find($paragraph->article_id); ?>                                
                      @if(old('paragraph_id', $alphabet->paragraph_id) == $paragraph->id)
                      <option value="{{$paragraph->id}}" selected>PASAL {{$print_article->article}} AYAT {{$paragraph->paragraph}} / {{$paragraph->sub_chapters}}</option>

                      @else
                      <option value="{{$paragraph->id}}" >PASAL {{$print_article->article}} AYAT {{$paragraph->paragraph}} / {{$paragraph->sub_chapters}}</option>
                      @endif
                    @endforeach
                  </select>                  
                </div>


                <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Pasal example : 27"> -->
              </div>
              <div class="form-group row">
                <label for="alphabet" class="col-sm-3 col-form-label">Huruf</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="alphabet" name="alphabet" value="{{ old('alphabet', $alphabet->alphabet) }}" placeholder=" Huruf">
                </div>
              </div>

              <div class="form-group row">
                <label for="alphabet_sound" class="col-sm-3 col-form-label">Keterangan</label>

              <div class="col-sm-9">
                <textarea  class="form-control" id="" name="alphabet_sound" placeholder="Bunyi huruf">{{ old('alphabet_sound', $alphabet->alphabet_sound) }}</textarea>                       
                </div>
              </div>
              <div class="form-group row">
                <label for="bank_branch" class="col-sm-3 col-form-label">Periode</label>
                <div class="col-sm-3">
                  <input type="year" class="form-control" id="bank_branch" name="firts_periode" value="{{ old('firts_periode', $alphabet->firts_periode) }}" >
                </div>

                <div class="col-sm-1">
                    -                          
                </div>
                <div class="col-sm-3">
                    <input type="year" class="form-control" id="bank_branch" name="last_periode" value="{{ old('last_periode', $alphabet->last_periode) }}" >
                  </div>
              </div>

              <div class="form-group row">
                <label for="bank_branch" class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                    <select class="form-control"  name="alphabet_status" id="alphabet_status">      
                      @foreach ($alphabet_status as $x => $x_value)
                        @if(old('alphabet_status', $alphabet->alphabet_status) == $x_value)
                          <option value="{{ $x_value }}" selected>{{ $x}} </option>
                        @else
                          <option value="{{ $x_value }}" >{{ $x }} </option>
                        @endif
                      @endforeach
                    </select>
                  </div>
            
              </div>
            
              <!-- <p>One fine body&hellip;</p> -->
      
              <div class="modal-footer justify-content-between">
                <a href="/alphabets" class="btn btn-default" data-dismiss="modal">kembali</a>
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