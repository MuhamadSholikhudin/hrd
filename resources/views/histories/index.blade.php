@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Histories Page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Histories Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <!-- <h3 class="card-title">Title</h3> -->
      

    <div class="card-tools">
        <form action="/histories" >     
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <div class="card-body">
        
        <table class="table table-hover text-nowrap table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th>Oleh</th>
              <th>aksi</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td> <a href="#"  class="histories" data-id="{{ $history->id }}" data-role="{{ $history->role_id }}">{{ $history->id }}</a> </td>
                    <td>{{ $history->created_at }}</td>
                    <td>{{ $history->user_id }}</td>
                    <td>{{ $history->action }}</td>
                    <td>{{ $history->remark }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>

    </div>

    
    <!-- /.card-body -->
    <div class="card-footer">
        <h3 class="card-title">Total : {{$count}}</h3>
        <div class="pagination pagination-sm m-0 float-right">
            {{ $histories->links() }}
        </div>
      <!-- Footer -->
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Informasi</h3> 
        </div>
        <div class="card-body">

        <!-- 
            Data User, data role , convert date


         -->
            proses date : <span id="proses_date" >q</span><br>
            proses : <span id="proses_action" >q</span><br>
            Keterangan : <span id="proses_keterangan" >q</span> <br>
            oleh : <span id="proses_oleh" >q</span>  <span id="proses_bagian" >q</span><br>
        </div>
    </div>

</section>
<!-- /.content -->


</div>

@endsection