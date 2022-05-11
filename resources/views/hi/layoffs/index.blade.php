@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pemutusan Hubungan Kerja</h1> 
        <br>
        <a href="/hi/layoffs/create" class="btn  btn-info">+ Pemutusan Hubungan Kerja</a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pemutusan Hubungan Kerja Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pemutusan Hubungan Kerja </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>No SK</th>
                <th>Tgl Pemutusan</th>
                <th>Tgl Mulai</th>
                <th>Pasal PHK</th>
                <th>Menimbang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach($layoffs as $layoff):
              <tr>
                <td>{{$layoff->id}}</td>

                <?php 
                      $d_l = new \DateTime($layoff->layoff_date .' 00:00:00');
                      $year = date_format($d_l, "Y"); //for Display Year

                ?>
                <td>{{ $layoff->no_layoff .'/SK-PHK/HRD-HWI/'.$layoff->rom_layoff.'/'. $year   }}</td>
                <td>{{ $layoff->layoff_date }}</td>
                <td>
                  {{ $layoff->layoff_date_start }}
                </td>
                <td>

                  <?php  $print_alphabet  = DB::table('alphabets')->find($layoff->alphabet_id); ?>
                  <?php  $print_paragraph  = DB::table('paragraphs')->find($print_alphabet->paragraph_id); ?>
                  <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                    

                  {{
                  $pal = "Pasal ". $print_article->article. " ayat " . $print_paragraph->paragraph. " " . $print_alphabet->alphabet }}

                </td>
                <td>{{$layoff->layoff_description}}</td>
                <td>
                  <a href="/hi/layoffs/{{$layoff->id }}" target="_blank" class="btn  btn-outline-primary">
                    Cetak                    
                  </a>

                  <form action="/hi/layoffs/{{$layoff->id }}" method="POST" class="d-inline ">
                        @method('delete')
                        @csrf
                        <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                          Delete
                        </button>
                    </form> 
                
                


                </td>
              </tr>
            @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div>
      <!-- /.card -->


    </div>


  </div>



</section>
<!-- /.content -->


</div>

@endsection