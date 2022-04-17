@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manager Penandatangi</h1> 
        <br>
        {{-- <a href="/hi/signatures/create" class="btn  btn-info">+ Add article</a> --}}
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
              <h3 class="card-title">Form Edit Siganture</h3>
             </div>
             <div class="card-body">

                    {{-- <h4 class="modal-title">Edit Pasal</h4> --}}

                        <form role="form" action="/hi/signatures/{{  $signature->id  }}" method="POST" enctype="multipart/form-data">
                          @method('put')
                          @csrf
                      <!-- <p>One fine body&hellip;</p> -->
                      <div class="form-group">
                        <label for="">Nama</label>
                        <input type="hidden" class="form-control" id="" name="id" value="{{ old('id', $signature->id) }}" placeholder="Nomor Pasal example : 27">
                        <input type="hidden" class="form-control" id="" name="employee_id" value="{{ old('employee_id', $signature->employee_id) }}" placeholder="Nomor Pasal example : 27">
                        <input type="text" class="form-control" id="" name="name" value="{{ old('name', $signature->name) }}" placeholder="Nomor Pasal example : 27" >
                      </div>
                      <div class="form-group">
                        <label for="">Department</label>
                        <input type="text" class="form-control" id="" name="department" value="{{ old('department', $signature->department) }}" placeholder="BAB Pasal">
                      </div>
                      <div class="form-group">
                        <label for="">Bagian</label>
                        <input  class="form-control" id="" name="part" value="{{ old('part', $signature->part) }}" placeholder="Bunyi pasal"> 
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="status_signature">
                          @foreach ($status as $status)
                            @if(old('status_signature', $signature->status_signature) == $status)
                              <option value="{{ $status }}" selected>{{ $status}} </option>
                            @else
                              <option value="{{ $status }}" >{{ $status }} </option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a href="/hi/signatures" class="btn btn-default" data-dismiss="modal">kembali</a>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
    </div>


          














  
  </div>



</section>
<!-- /.content -->


</div>

@endsection