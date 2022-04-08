@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>PKB</h1> 
        <br>
        <a href="/hi/employees/create" class="btn  btn-info">+ Add Employee</a>
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
    <div class="col-lg-4">
      <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            PASAL
          </h3>

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
                  <!-- <p>One fine body&hellip;</p> -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">PASAL</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Pasal example : 27">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">BAB</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="BAB Pasal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">BUNYI PASAL</label>
                    <textarea  class="form-control" id="" placeholder="Bunyi pasal"></textarea>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

        </div>


        <!-- /.card-header -->
        <div class="card-body">
          <ul class="todo-list ui-sortable" data-widget="todo-list">
            <li>
              <span class="text">Design a nice theme</span>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <!-- <i class="fas fa-trash-o"></i> -->
              </div>
            </li>

          </ul>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
        <div class="card-tools">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a href="#" class="page-link">«</a></li>
              <li class="page-item"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link">»</a></li>
            </ul>
          </div>
        </div>
      </div>


    </div>
    <div class="col-lg-4">
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            AYAT
          </h3>
          <div class="card-tools">
            <form action="/datamaster/employees" >     
                <div class="input-group input-group-sm" style="width: 200px;">
                    <button type="button" data-toggle="modal" data-target="#add_paragraph"  class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></button>
                  &nbsp;&nbsp;&nbsp;
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
          <!-- <button type="button" data-toggle="modal" data-target="#add_paragraph"  class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add</button> -->
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
                  <!-- <p>One fine body&hellip;</p> -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pasal</label>

                    <select class="form-control select2bs4"  name="select_violation_last" id="select_violation_last">
                      <option value="sp1" selected>PASAL 27</option>
                    </select>
                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Pasal example : 27"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ayat</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="BAB Pasal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Bab</label>
                    <textarea  class="form-control" id="" placeholder="Bunyi pasal"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <textarea  class="form-control" id="" placeholder="Bunyi pasal"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Ayat</label>
                    <select class="form-control select2bs4"  name="jenis_ayat" id="jenis_ayat">
                      <option value="sp1" selected>PASAL 27</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>






        </div>


        <!-- /.card-header -->
        <div class="card-body">
          <ul class="todo-list ui-sortable" data-widget="todo-list">
            <li>
              <span class="text">Design a nice theme</span>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <!-- <i class="fas fa-trash-o"></i> -->
              </div>
            </li>

          </ul>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
        <div class="card-tools">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a href="#" class="page-link">«</a></li>
              <li class="page-item"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link">»</a></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
    <div class="col-lg-4">
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            HURUF
          </h3>
          <div class="card-tools">
            <form action="/datamaster/employees" >     
                <div class="input-group input-group-sm" style="width: 200px;">
                    <button type="button" data-toggle="modal" data-target="#add_letter"  class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></button>
                  &nbsp;&nbsp;&nbsp;
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
          <!-- <button type="button" data-toggle="modal" data-target="#add_letter"  class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add</button> -->
          <div class="modal fade" id="add_letter">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Huruf</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- <p>One fine body&hellip;</p> -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ayat</label>

                    <select class="form-control select2bs4"  name="hu" id="hu">
                      <option value="sp1" selected>PASAL 27 / Ayat 1</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">huruf</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="BAB Pasal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <textarea  class="form-control" id="" placeholder="Bunyi pasal"></textarea>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>




        </div>


        <!-- /.card-header -->
        <div class="card-body">
          <ul class="todo-list ui-sortable" data-widget="todo-list">
            <li>
              <span class="text">Design a nice theme</span>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <!-- <i class="fas fa-trash-o"></i> -->
              </div>
            </li>

          </ul>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
        <div class="card-tools">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a href="#" class="page-link">«</a></li>
              <li class="page-item"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link">»</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  
  </div>



</section>
<!-- /.content -->


</div>

@endsection