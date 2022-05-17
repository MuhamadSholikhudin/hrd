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
        
      <div class="card mb-3">
          <div class="card-body table-responsive p-0">
            @if (session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    {{ session('success') }}
                </strong>
              </div>
            @else

            @endif

          
      </div>
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
              <form action="{{ route('violations.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="custom-file">

                        <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Uploads</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="/exportemployees" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Download Excel Data Karyawan">
          <i class="fas fa-download"></i>
        </a> --}}
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
                    <input type="number" name="awal" class="form-control" >
                  </div>
                  <div class="col-2">
                    <p class="text-center">

                      -
                    </p>
                  </div>
                  <div class="col-5">
                    <input type="number" name="akhir" class="form-control">
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
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>NO SP</th>
              <th>Tanggal SP</th>
              <th>Tanggal Berakhir</th>
              <th>Selang </th>
              <th>Pelangaran</th>
              <th>Pasal</th>
              <th>Keterangan</th>
              <th>Status </th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($violations as $violation)
              <tr>
                <td>{{ $violation->id }}</td>
                <td>{{ $violation->name }}</td>
                <td>{{ $violation->number_of_employees }}</td>
                <td>
                  <?php
                    $date_violation_sp = new \DateTime($violation->date_of_violation .' 00:00:00');
                    $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
                    $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
                    $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

                    if(strlen($violation->no_violation) == '1'){
                      $p_no_s = '00'. $violation->no_violation;
                    }elseif(strlen($violation->no_violation) == '2'){
                      $p_no_s = '0'.$violation->no_violation;
                    }

                  ?>
                    {{$p_no_s}}/SP-HRD/{{$violation->violation_ROM}}/{{$date_year_sp}}
                  </td>
                <td>
                <?php
                  

                  $day_sp = gmdate("l", mktime(0,0,0,$date_day_sp,$date_month_sp,$date_year_sp));

                  // Hari Indonesia
                  if($day_sp == 'Monday'){
                    $day_indo_sp = 'Senin';
                  }elseif($day_sp == 'Tuesday'){
                    $day_indo_sp = 'Selasa';            
                  }elseif($day_sp == 'Wednesday'){
                    $day_indo_sp = 'Rabu';            
                  }elseif($day_sp == 'Thursday'){
                    $day_indo_sp = 'Kamis';            
                  }elseif($day_sp == 'Friday'){
                    $day_indo_sp = 'Jumat';            
                  }elseif($day_sp == 'Saturday'){
                    $day_indo_sp = 'Sabtu';            
                  }elseif($day_sp == 'Sunday'){
                    $day_indo_sp = 'Minggu';            
                  }

                  //Bulan Indonesia
                  if($date_month_sp == '01'){
                    $month_indo_sp = 'Januari';
                  }elseif($date_month_sp == '02'){
                    $month_indo_sp = 'Februari';            
                  }elseif($date_month_sp == '03'){
                    $month_indo_sp = 'Maret';            
                  }elseif($date_month_sp == '04'){
                    $month_indo_sp = 'April';            
                  }elseif($date_month_sp == '05'){
                    $month_indo_sp = 'Mei';            
                  }elseif($date_month_sp == '06'){
                    $month_indo_sp = 'Juni';            
                  }elseif($date_month_sp == '07'){
                    $month_indo_sp = 'Juli';            
                  }elseif($date_month_sp == '08'){
                    $month_indo_sp = 'Agustus';            
                  }elseif($date_month_sp == '09'){
                    $month_indo_sp = 'September';            
                  }elseif($date_month_sp == '10'){
                    $month_indo_sp = 'Oktober';            
                  }elseif($date_month_sp == '11'){
                    $month_indo_sp = 'November';            
                  }elseif($date_month_sp == '12'){
                    $month_indo_sp = 'Desember';            
                  }
                ?>
                  {{ $day_indo_sp. ", ". $date_day_sp. " ". $month_indo_sp . " ". $date_year_sp }}
                </td>


                <td>
                  <?php
                    $date_violation_end = new \DateTime($violation->date_end_violation .' 00:00:00');
                    $date_year = date_format($date_violation_end, "Y"); //for Display Year
                    $date_month =  date_format($date_violation_end, "m"); //for Display Month
                    $date_day = date_format($date_violation_end, "d"); //for Display Date

                    $day = gmdate("l", mktime(0,0,0,$date_day,$date_month,$date_year));

                    // Hari Indonesia
                    if($day == 'Monday'){
                      $day_indo = 'Senin';
                    }elseif($day == 'Tuesday'){
                      $day_indo = 'Selasa';            
                    }elseif($day == 'Wednesday'){
                      $day_indo = 'Rabu';            
                    }elseif($day == 'Thursday'){
                      $day_indo = 'Kamis';            
                    }elseif($day == 'Friday'){
                      $day_indo = 'Jumat';            
                    }elseif($day == 'Saturday'){
                      $day_indo = 'Sabtu';            
                    }elseif($day == 'Sunday'){
                      $day_indo = 'Minggu';            
                    }

                    //Bulan Indonesia
                    if($date_month == '01'){
                      $month_indo = 'Januari';
                    }elseif($date_month == '02'){
                      $month_indo = 'Februari';            
                    }elseif($date_month == '03'){
                      $month_indo = 'Maret';            
                    }elseif($date_month == '04'){
                      $month_indo = 'April';            
                    }elseif($date_month == '05'){
                      $month_indo = 'Mei';            
                    }elseif($date_month == '06'){
                      $month_indo = 'Juni';            
                    }elseif($date_month == '07'){
                      $month_indo = 'Juli';            
                    }elseif($date_month == '08'){
                      $month_indo = 'Agustus';            
                    }elseif($date_month == '09'){
                      $month_indo = 'September';            
                    }elseif($date_month == '10'){
                      $month_indo = 'Oktober';            
                    }elseif($date_month == '11'){
                      $month_indo = 'November';            
                    }elseif($date_month == '12'){
                      $month_indo = 'Desember';            
                    }
                  ?>
                  {{ $day_indo. ", ". $date_day. " ". $month_indo . " ". $date_year }}
                </td>
                <td>
                  <?php                     
                    $awal_sp = time(); // Waktu sekarang
                    $akhir_sp  = strtotime($violation->date_end_violation);
                    $diff_sp  = $akhir_sp - $awal_sp;
                      if($diff_sp > 0){
                        $selang =  floor($diff_sp / (60 * 60 * 24)) . ' hari';
                      }else{
                        $selang = '';
                      }
                  ?>
                    {{ $selang }}
                  </td>
                <td>
                  <?php
                    if($violation->type_of_violation == 'Peringatan Lisan'){
                      $p = "SP Lisan";
                    }elseif($violation->type_of_violation == 'Surat Peringatan Pertama'){
                      $p = "SP I";
                    }elseif($violation->type_of_violation == 'Surat Peringatan Kedua'){
                      $p = "SP II";
                    
                    }elseif($violation->type_of_violation == 'Surat Peringatan Ketiga'){
                      $p = "SP III";
                    }elseif($violation->type_of_violation == 'Surat Peringatan Terakhir'){
                      $p = "SP Terakhir";
                    }elseif($violation->type_of_violation == 'Pemutusan Hubungan Kerja'){
                      $p = "PHK";
                    }
                  ?>
                  {{ $p }}
                </td>
                <td>
                  <?php 
                    // Pasal 
                    $alphabet  = DB::table('alphabets')->find($violation->alphabet_id); 
                    $paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); 
                    $article  = DB::table('articles')->find($paragraph->article_id); 

                  ?>
                  {{ $article->article . ' ayat '. $paragraph->paragraph .' huruf '. $alphabet->alphabet}}
                </td>
                <td><div>{{ $violation->other_information  }} </div></td>                
                <td>{{ $violation->violation_status  }}</td>
                <td>
                    <a href="/violations/{{$violation->id }}" target="_blank" class="btn  btn-outline-primary">
                      Cetak                    
                    </a>
                        <!-- <a href="/hi/employees//edit" class="btn  btn-outline-warning">
                      Edit
                      </a> -->
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
</div>

@endsection