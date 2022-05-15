@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>AYAT PKB</h1> 
        <br>
        {{-- <a href="/hi/articles/create" class="btn  btn-info">+ Add article</a> --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Ayat Pkb Page</li>
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
              <h3 class="card-title">AYAT PKB</h3>
  
              <div class="card-tools">
                  <form action="/hi/pkb" >     
                      <div class="input-group input-group-sm" style="width: 200px;">
                          <button type="button" data-toggle="modal" data-target="#add_paragraph"  class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></button>
                        &nbsp;&nbsp;&nbsp;
                          <input type="text" name="search_paragraph" value="{{ request('search_paragraph') }}" class="form-control float-right" placeholder="Search">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>

            <div class="modal fade" id="add_paragraph">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah AYAT</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form role="form" action="/paragraphs" method="POST" enctype="multipart/form-data">
                      @csrf
                      <!-- <p>One fine body&hellip;</p> -->
                      <div class="form-group">
                        <label for="article_id">Pasal</label>
    
                        <select class="form-control select2bs4"  name="article_id" id="article_id">
                            @foreach($articles as $article):
                              <option value="{{$article->id}}" selected>PASAL {{$article->article}} / {{$article->chapters}}</option>
                            @endforeach

                        </select>
                        <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Pasal example : 27"> -->
                      </div>
                      <div class="form-group">
                        <label for="article_id">Ayat</label>
                        <input type="text" class="form-control" id="paragraph" name="paragraph" placeholder="BAB Pasal">
                      </div>
                      <div class="form-group">
                        <label for="description">Sub Bab</label>
                        <textarea  class="form-control" id="" name="sub_chapters" placeholder="Bunyi pasal"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea  class="form-control" id="" name="description" placeholder="Bunyi pasal"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="type_of_verse">Jenis Ayat</label>
                        <select class="form-control select2bs4"  name="type_of_verse" id="type_of_verse">
                            <option value="Peringatan Lisan" selected>Peringatan Lisan</option>
                            <option value="Surat Peringatan Pertama" >Surat Peringatan Pertama</option>
                            <option value="Surat Peringatan Kedua" >Surat Peringatan Kedua</option>
                            <option value="Surat Peringatan Ketiga" >Surat Peringatan Ketiga</option>
                            <option value="Surat Peringatan Terakhir" >Surat Peringatan Terakhir</option>
                            <option value="PHK Tanpa Pesangon" >PHK Tanpa Pesangon</option>
                            <option value="PHK Pesangon" >PHK Pesangon</option>
                        </select>
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
                    <th>Pasal</th>
                    <th>Ayat</th>
                    <th>Sub bab</th>
                    <th>Bunyi Ayat</th>
                    <th>Jenis Ayat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($paragraphs as $paragraph)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $paragraph->article->article }}</td>
                    <td>{{ $paragraph->paragraph }}</td>
                    <td> {{ $paragraph->sub_chapters }}</td>
                    <td>{{ $paragraph->description }}</td>
                    <td>{{ $paragraph->type_of_verse }}</td>
                    <td>
                        <div class="tools">
                          <a href="/paragraphs/{{ $paragraph->id }}/edit">
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
                  {{ $paragraphs->links() }}
              </ul>
            </div>
          </div>

    </div>
    

  </div>



</section>
<!-- /.content -->


</div>

@endsection