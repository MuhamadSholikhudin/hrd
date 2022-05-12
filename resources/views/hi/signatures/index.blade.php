@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Manager HRD </h1> 
        <br>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Penandatangani Page</li>
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
              <h3 class="card-title">List Data Manager HRD</h3>
  
              <div class="card-tools">
                  <form action="/hi/pkb" >     
                      <div class="input-group input-group-sm" style="width: 200px;">
                          <button type="button" data-toggle="modal" data-target="#add_signature" id="modal_signature" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></button>
                        &nbsp;&nbsp;&nbsp;
                          <input type="text" name="search_signature" value="{{ request('search_signature') }}" class="form-control float-right" placeholder="Search">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
            
            <div class="modal fade" id="add_signature">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Penandatangan</h4>
                      <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form role="form" action="/hi/signatures" method="POST" enctype="multipart/form-data">
                          @csrf
                      <!-- <p>One fine body&hellip;</p> -->

                      <div class="form-group">
                      <div id="pkl">
                      
                      </div>
                        <label for="">Cari</label>
                        <select class="form-control select2bs4" style="width: 100%;" id="signature_employee" name="employee_id">
                           
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="signature_name" name="name" placeholder="Nama Penandatangan">
                      </div>
                      <div class="form-group">
                        <label for="">Department</label>
                        <input type="text" class="form-control" id="signature_department" name="department" placeholder="department">
                      </div>
                      <div class="form-group">
                        <label for="">Bagian</label>
                        <input type="text" class="form-control" id="signature_part" name="part" placeholder="department">
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
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
                    <th>Nama</th>
                    <th>Department</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($signatures as $signature)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $signature->name }}</td>
                    <td>
                        {{ $signature->department }}
                    </td>
                    <td>{{ $signature->status_signature }}</td>
                    <td>
                        <div class="tools">
                          <a href="/hi/signatures/{{ $signature->id }}/edit">
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
              </ul>
            </div>
          </div>

    </div>


  </div>



</section>
<!-- /.content -->


</div>

@endsection