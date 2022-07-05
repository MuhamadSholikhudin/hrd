@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Master Pelanggaran </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Pelanggaran Page</li>
      </ol>
    </div>
  </div>
</div>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-md-12">
        
      @if (session()->has('success'))
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Success</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        {{ session('success') }}
        </div>
        <!-- /.card-body -->
      </div>

      @elseif(session()->has('danger'))
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Peringatan !</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        {{ session('danger') }}
        </div>
        <!-- /.card-body -->
      </div>
      @else

      @endif
    </div>


  <!-- Default box -->
  <div class="card">
    <div class="card-header">
        <!-- Kelola karyawan =>   -->
        <!-- &nbsp; -->
        <!-- Button trigger modal -->
        <!-- <a href="/datamaster/employees/create" class="btn btn-outline-primary " >
          <i class="fa fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tambah 1 Karyawan"></i>
        </a> -->
        <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
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
                  echo '<a class="btn btn-outline-primary" data-toggle="modal"  data-target="#excel_pelanggaran_baru" >
                          <i class="fa fa-arrow-up"  data-toggle="tooltip" data-placement="bottom" title="Upload Excel Tambah Data Pelanggaran"></i>
                        </a>';
                }
              }
            }
        ?>
        <!-- <a class="btn btn-outline-primary" data-toggle="modal"  data-target="#excel_pelanggaran_baru" >
          <i class="fa fa-arrow-up"  data-toggle="tooltip" data-placement="bottom" title="Upload Excel Tambah Data Pelanggaran"></i>
        </a> -->

        <!-- Modal -->
        <div class="modal fade" id="excel_pelanggaran_baru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload excel Data Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-justify-right">
                    <a href="{{asset('excel/FORMAT_UPLOAD_PELANGGARAN.xlsx')}}">Format Upload Pelangaran</a>
                    <br>
                  </p>
              <form action="{{ route('teatimport') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" name="file" id="exampleInputFile">
                
                <!-- <div class="input-group">
                    <div class="custom-file">

                        <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Uploads</button>
              </div>
            </form>
            </div>
          </div>
        </div>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('violations.export') }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Download Excel Data Master Pelanggaran">
          <i class="fas fa-download"></i>
        </a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('alphabets.export') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Download Excel Alphabet ID">
          <i class="fas fa-download"></i>
        </a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('alphabets.export') }}" class="btn btn-warning" data-toggle="modal"  data-target="#pdf_violation" data-toggle="tooltip" data-placement="bottom" title="Export Data SP ke PDF">
          <i class="fas fa-print"></i>
        </a>
        <div class="modal fade" id="pdf_violation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Export Pelanggran ke PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="/violation-pdf" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-5">
                    <input type="number" name="awal" class="form-control" required>
                  </div>
                  <div class="col-2">
                    <p class="text-center">

                      -
                    </p>
                  </div>
                  <div class="col-5">
                    <input type="number" name="akhir" class="form-control" required>
                  </div>
                </div>
              
                
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Convert</button>
              </div>
            </form>
            </div>
          </div>
        </div>


        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('alphabets.export') }}" class="btn btn-success" data-toggle="modal"  data-target="#edit_violation" data-toggle="tooltip" data-placement="bottom" title="Download Data SP ke yang mau di edit">
          <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <div class="modal fade" id="edit_violation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Downlad SP Yang mau di edit Berdasarkan NO ID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="/violationeditexcel" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-5">
                    <input type="number" name="awal" class="form-control" required>
                  </div>
                  <div class="col-2">
                    <p class="text-center">
                      -
                    </p>
                  </div>
                  <div class="col-5">
                    <input type="number" name="akhir" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-download"></i>
                Download</button>
              </div>
            </form>
            </div>
          </div>


          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload SP Yang mau di edit Berdasarkan NO ID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('teatupdateimport')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="row">
                
                  <div class="col-12">
                    <input type="file" name="file" id="exampleInputFile">
                  </div>
                </div>              
                
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i>
                Upload</button>
              </div>
            </form>
            </div>
          </div>
        </div>

        <div class="card-tools">
            <form action="/hiviolations" >     
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
      <div class="modal fade" id="add_delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Penyampain <span id="deladd">oke</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="/deliveryletters" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-6">
                    <input type="date" name="date_delivery" value="<?= date('Y-m-d') ?>" class="form-control" required>
                    <input type="hidden" name="violation_id" id="violation_id" value="" class="form-control" required>
                  </div>
                  
                  <div class="col-6">
                    <select class="form-control" name="user_id" id="" required>
                      @foreach($users as $user)
                        @if($user->id == auth()->user()->id)
                        <option value="{{$user->id}}" selected>{{$user->name}} </option>  
                        @else
                          <option value="{{$user->id}}">{{$user->name}} </option>  
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
            </div>
          </div>
        </div>

      <div class="modal fade" id="edit_delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Penyampain <span id="delsk">oke</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="editformdel" action="/deliveryletters/" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
              <div class="modal-body">
                <div class="row">
                  <div class="col-6">
                    <input type="date" name="datedeliveryedit" id="datedeliveryedit"  class="form-control" required>
                    <input type="hidden" name="id" id="id_edit" value="" class="form-control" required>
                  </div>
                  
                  <div class="col-6">
                    <select class="form-control" name="user_id" id="user_id_edit" required>
                      @foreach($users as $user)
                        @if($user->id == auth()->user()->id)
                        <option value="{{$user->id}}" id="selec" selected>{{$user->name}} </option>  
                        @else
                          <option value="{{$user->id}}">{{$user->name}} </option>  
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
            </div>
          </div>
        </div>

        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>NO ID</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>NO SP</th>
              <th>Tanggal Laporan</th>
              <th>Tanggal SP</th>
              <th>Tanggal Berakhir</th>
              <th>Selang </th>
              <th>Pelangaran</th>
              <th>Pasal</th>
              <th>Pasal Akumulasi</th>
              <th>Status </th>
              <th>Penyampain</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($violations as $violation)
              <tr>
                <td>{{ $violation->id }}</td>
                <td><a href="/violations/{{ $violation->employee_id }}/edit" class="text-dark" >{{ $violation->number_of_employees }}</a></td>
                <td><a href="/violations/{{ $violation->employee_id }}/edit" class="text-dark">{{ $violation->name }}</a></td>
                <td>{{nomer_sp($violation->no_violation, $violation->id);}}           </td>
                <td> {{ tanggal_pelanggaran($violation->reporting_date); }} </td>
                <td>{{ tanggal_pelanggaran($violation->date_of_violation); }}  </td>
                <td>{{ tanggal_pelanggaran($violation->date_end_violation); }}  </td>
                <td>{{selang($violation->date_end_violation);}}</td>
                <td>{{ $violation->type_of_violation }}</td>
                <td> {{pasal($violation->alphabet_id);}} </td>
                <td>
                 <!-- {{ pasal($violation->alphabet_id); }} -->
                 <?php 
                    if($violation->alphabet_accumulation !== NULL){
                    echo pasal($violation->alphabet_accumulation);
                    }else{
                    }
                 ?>
                  </td>
                <td>{{ $violation->violation_status  }}</td>
                <td style="align:center;">
                <?php                
                  $c_delivery = DB::table('deliveryletters')->where('id', $violation->id)->count();
                if($c_delivery > 0){ ?>
                  <?php
                  $delivery = DB::table('deliveryletters')->find($violation->id);
                  $use = DB::table('users')->find($delivery->user_id);

                  ?>
                  <a href="#" class="text-dark deliveryedit" data-id="{{$delivery->id}}" data-sk="{{nomer_sp($violation->no_violation, $violation->id);}}" data-datedeliveryedit="<?= $delivery->date_delivery ?>" data-user="<?= $delivery->user_id ?>" data-toggle="modal" data-target="#edit_delivery">
                      <i class="fa-solid fa-pen"></i> &nbsp;
                  </a>
                      <?= tanggal_pelanggaran($delivery->date_delivery) ?>, <?= $use->name ?>               
                <?php }else{ ?>
                    <a href="" class="btn btn-info deliveryadd" data-id="{{$violation->id}}" data-toggle="modal" data-sk="{{nomer_sp($violation->no_violation, $violation->id);}}" data-target="#add_delivery" data-toggle="tooltip" data-placement="bottom" title="Tambah Penyampaian">
                      <i class="fa-solid fa-clipboard-user"></i>
                    </a>
                <?php } ?>             
  
              </td>                
                <td>
                    <a href="/violations/{{$violation->id }}" target="_blank" class="btn  btn-outline-primary">
                      Cetak                    
                    </a>
                    <form action="{{route('cancelviolations')}}" method="POST" class="d-inline ">
                      @csrf
                      <input type="hidden" name="id" value="{{$violation->id }}">
                      <button type="submit" class="btn btn-outline-success" onclick="return confirm(' Are you sure process violation data ?')"> 
                        <?php if($violation->violation_status == 'active'){  ?>
                          Cancel
                        <?php }else{ ?>
                          Activate
                        <?php } ?>
                      </button>
                    </form> 
                    
                    
                    <a href="/hiviolations/{{$violation->id }}/getedit" class="btn  btn-outline-warning">
                      Edit
                    </a>
                    <form action="{{route('deleteviolations')}}" method="POST" class="d-inline ">
                      @csrf
                      <input type="hidden" name="id" value="{{$violation->id }}">
                      <button type="submit" class="btn btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
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
            {{ $violations->links() }}
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </div>



</section>
<!-- /.content -->

@endsection