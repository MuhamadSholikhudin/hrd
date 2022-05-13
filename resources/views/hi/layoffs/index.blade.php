@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Pemutusan Hubungan Kerja </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Pemutusan Hubungan Kerja Page</li>
      </ol>
    </div>
  </div>
</div>
</section>

<!-- Main content -->
<section class="content">


<div class="card">
      <div class="card-header">
         <div class="card-tools">
            <form action="/hi/layoffs" >     
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
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
                <td>{{ $layoff->name }}</td>
                <td>{{ $layoff->number_of_employees }}</td>
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
                  {{ $pal = "Pasal ". $print_article->article. " ayat " . $print_paragraph->paragraph. " " . $print_alphabet->alphabet }}

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
      <div class="card-footer">
        <h3 class="card-title">Total : {{$count}}</h3>
        <div class="pagination pagination-sm m-0 float-right">
            {{ $layoffs->links() }}
        </div>
      </div>



</section>
<!-- /.content -->


</div>

@endsection