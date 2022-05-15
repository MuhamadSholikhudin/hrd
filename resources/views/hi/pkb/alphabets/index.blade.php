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
          <li class="breadcrumb-item"><a href="#">Huruf Pkb</a></li>
          <li class="breadcrumb-item active">Page</li>
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
              <h3 class="card-title">List Huruf</h3>
  
              <div class="card-tools">
                  <form action="/alphabets" >     
                      <div class="input-group input-group-sm" style="width: 200px;">
                          <button type="button" data-toggle="modal" data-target="#add_alphabets"  class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></button>
                        &nbsp;&nbsp;&nbsp;
                          <input type="text" name="search_alphabets" value="{{ request('search_alphabets') }}" class="form-control float-right" placeholder="Search">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>

            <div class="modal fade" id="add_alphabets">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Huruf</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form role="form" action="/alphabets" method="POST" enctype="multipart/form-data">
                      @csrf
                      <!-- <p>One fine body&hellip;</p> -->
                      <div class="form-group">
                        <label for="article_id">Ayat</label>
    
                        <select class="form-control select2bs4"  name="paragraph_id" id="paragraph_id">
                            @foreach($paragraphs as $paragraph):
                            <?php  $print_article  = DB::table('articles')->find($paragraph->article_id); ?>
                              <option value="{{$paragraph->id}}" selected>PASAL {{$print_article->article}} AYAT {{$paragraph->paragraph}} / {{$paragraph->sub_chapters}}</option>
                            @endforeach

                        </select>
                        <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Pasal example : 27"> -->
                      </div>
                      <div class="form-group">
                        <label for="alphabet">Huruf</label>
                        <input type="text" class="form-control" id="alphabet" name="alphabet" placeholder=" Huruf">
                      </div>

                      <div class="form-group">
                        <label for="alphabet_type">Pasal Akumulasi</label>
                        <select class="form-control" name="alphabet_type" id="alphabet_type" >
                              <option value="no" selected>Tidak</option>
                              <option value="accumulation" >Ya</option>
                        </select>
                      </div>
                      <div class="form-group row" id="check_acummulation" style="display:none;">
                        <label for="alphabet_acummulation" class="col-lg-2"></label>
                        <div class="col-lg-10">
                          @foreach($alphabets_accumulation as $accumulation)
                            <div class="form-check">
                              <input class=" chk" name="alphabet_accumulation[]" value="{{ $accumulation }}" type="checkbox">
                              <label class="form-check-label">{{ $accumulation }}</label>
                            </div>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea  class="form-control" id="" name="description" placeholder="Bunyi huruf"></textarea>
                      </div>
                      <div class="form-group row">
                        <label for="bank_branch" class="col-sm-3 col-form-label">Periode</label>
                        <div class="col-sm-3">
                          <input type="year" class="form-control" id="bank_branch" name="firts_periode" value="" >
                        </div>

                        <div class="col-sm-1">
                            -                          
                        </div>
                        <div class="col-sm-3">
                            <input type="year" class="form-control" id="bank_branch" name="last_periode" value="" >
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </form>
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
                    <th>Pasal Ayat</th>
                    <th>Huruf</th>
                    <th>Bunyi Ayat</th>
                    <th>Jenis Ayat</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($alphabets as $alphabet)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>
                        <?php  $print2_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                        <?php  $print2_article  = DB::table('articles')->find($print2_paragraph->article_id); ?>

                      
                     Pasal {{ $print2_article->article }} Ayat {{ $print2_paragraph->paragraph }}
                    
                    </td>
                    <td>{{ $alphabet->alphabet }}</td>
                    <td>{{ $alphabet->alphabet_sound }}</td>
                    <td> {{ $print2_paragraph->type_of_verse }}</td>
                    <td>{{ $alphabet->last_periode}} - {{ $alphabet->firts_periode }}</td>
                    <td>
                        <div class="tools">
                          <a href="/alphabets/{{ $alphabet->id }}/edit">
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
              <h6>Total ayat : {{ $count}}</h6>
              <ul class="pagination pagination-sm m-0 float-right">
                  {{ $alphabets->links() }}
              </ul>
            </div>
          </div>

    </div>
    

  </div>



</section>
<!-- /.content -->


</div>

@endsection