@extends('layouts.main')

@section('container')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Employees Detail</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pelanggaran Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>




<!-- Main content -->
  <section class="content">

    <div  class="row">

      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">


            <img class="profile-user-img img-fluid img-circle" src="http://10.10.100.148/hwi/Photo/10000/{{  $employee->number_of_employees  }}.jpg" alt="User profile picture">
            
              <!-- <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture"> -->
            </div>
            <h3 class="profile-username text-center">{{  $employee->name  }}</h3>
            <p class="text-muted text-center">
              <?php
                  $job = DB::table('jobs')->find($employee->job_id);
                  $department = DB::table('departments')->find($employee->department_id);
              ?>
                {{  $employee->number_of_employees  }} <br>
                {{  $job->job_level  }} <br>
                {{  $department->department  }} 
            </p>
            {{-- <ul class="list-group list-group-unbordered mb-3">
            </ul> --}}

            <a href="#" class="btn btn-primary btn-block"><b>{{ $employee->status_employee }}</b></a>
          </div>
          <!-- /.card-body -->
        </div>
      
      </div>

      <div class="col-md-9">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Identitas</h3>
          </div>
          <div class="card-body">
            
            <div class="row">
              <div class="col-md-6">
                  <strong><i class="fas fa-address-card mr-1"></i> Kartu Tanda Penduduk</strong>
                  <table>
                    <tr>
                      <td valign="top">NIK</td>
                      <td valign="top">: {{  $employee->national_id  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">TTL</td>
                      <td valign="top">: {{  $employee->place_of_birth  }}, {{  $employee->date_of_birth  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Jenis Kelamin</td>
                      <td valign="top">: {{  $employee->gender  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Alamat</td>
                      <td valign="top">: {{  $employee->address_jalan  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Agama</td>
                      <td valign="top">: {{  $employee->religion  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Status nikah</td>
                      <td valign="top">: {{  $employee->marital_status  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Ibu Kandung</td>
                      <td valign="top">: {{  $employee->biological_mothers_name  }}</td>
                    </tr>
                  </table>
    
                  <p></p>
              </div>

              <div class="col-md-6">
                  <strong><i class="fas fa-book mr-1"></i> Pendidikan</strong>
                  <table>
                    <tr>
                      <td valign="top">Pend Terakhir</td>
                      <td valign="top">: {{  $employee->educate  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Jurusan</td>
                      <td valign="top">: {{  $employee->major  }}</td>
                    </tr>
                  </table>
                  <strong><i class="fas fa-book mr-1"></i> Email & Phone</strong>
                  <table>
                    <tr>
                      <td valign="top">Email</td>
                      <td valign="top">: {{  $employee->email  }}</td>
                    </tr>
                    <tr>
                      <td valign="top">Phone</td>
                      <td valign="top">: {{  $employee->phone  }}</td>
                    </tr>
                  </table>
                  <strong><i class="fas fa-book mr-1"></i> Hire Date</strong>
                  <table>

                    <?php 
                        function tanggal_masuk($tanggal){
                          $date_hire = new \DateTime($tanggal .' 00:00:00');
                          $date_year_hire = date_format($date_hire, "Y"); //for Display Year
                          $date_month_hire =  date_format($date_hire, "m"); //for Display Month
                          $date_day_hire = date_format($date_hire, "d"); //for Display Date

                          $day_hire = gmdate("l", mktime(0,0,0, $date_day_hire,$date_month_hire,$date_year_hire));

                          // Hari Indonesia
                          if($day_hire == 'Monday'){
                              $day_indo_hire = 'Senin';
                          }elseif($day_hire == 'Tuesday'){
                              $day_indo_hire = 'Selasa';            
                          }elseif($day_hire == 'Wednesday'){
                              $day_indo_hire = 'Rabu';            
                          }elseif($day_hire == 'Thursday'){
                              $day_indo_hire = 'Kamis';            
                          }elseif($day_hire == 'Friday'){
                              $day_indo_hire = 'Jumat';            
                          }elseif($day_hire == 'Saturday'){
                              $day_indo_hire = 'Sabtu';            
                          }elseif($day_hire == 'Sunday'){
                              $day_indo_hire = 'Minggu';            
                          }

                          //Bulan Indonesia
                          if($date_month_hire == '01'){
                              $month_indo_hire = 'Januari';
                          }elseif($date_month_hire == '02'){
                              $month_indo_hire = 'Februari';            
                          }elseif($date_month_hire == '03'){
                              $month_indo_hire = 'Maret';            
                          }elseif($date_month_hire == '04'){
                              $month_indo_hire = 'April';            
                          }elseif($date_month_hire == '05'){
                              $month_indo_hire = 'Mei';            
                          }elseif($date_month_hire == '06'){
                              $month_indo_hire = 'Juni';            
                          }elseif($date_month_hire == '07'){
                              $month_indo_hire = 'Juli';            
                          }elseif($date_month_hire == '08'){
                              $month_indo_hire = 'Agustus';            
                          }elseif($date_month_hire == '09'){
                              $month_indo_hire = 'September';            
                          }elseif($date_month_hire == '10'){
                              $month_indo_hire = 'Oktober';            
                          }elseif($date_month_hire == '11'){
                              $month_indo_hire = 'November';            
                          }elseif($date_month_hire == '12'){
                              $month_indo_hire = 'Desember';            
                          }

                          echo  $date_day_hire. " ". $month_indo_hire . " ". $date_year_hire;
                      }
                    ?>
                    <tr>
                      <td valign="top">Tanggal</td>
                      <td valign="top">: {{ tanggal_masuk($employee->hire_date)  }}</td>
                    </tr>
                  </table>
              </div>
            </div>
          </div>
        </div>            
      </div>

      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">DAFTAR PELANGGARAN</h3>
          </div>
          <div class="card-body table-responsive">                       
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>NO SP</th>
                  <th>Tanggal Laporan</th>
                  <th>Tanggal SP</th>
                  <th>Tanggal Berakhir</th>
                  <th>Selang </th>
                  <th>Pelangaran</th>
                  <th>Pasal</th>
                  <th>Pasal Akumulasi</th>
                  <th>Status </th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              @foreach($violations as $violation)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <?php
                    if($violation->violation_status == 'cancel'){
                      $colorcancel = 'style="background-color:#00FF00"';
                    }else{
                      $colorcancel = '';
                    }
                  ?>
                  <td <?= $colorcancel ?> >
                    <?php
                      $date_violation_sp = new \DateTime($violation->date_of_violation .' 00:00:00');
                      $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
                      $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
                      $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

                      if(strlen($violation->no_violation) == '1'){
                        $p_no_s = '00'. $violation->no_violation;
                      }elseif(strlen($violation->no_violation) == '2'){
                        $p_no_s = '0'.$violation->no_violation;
                      }else{
                        $p_no_s = $violation->no_violation;
                    }

                    ?>
                      {{$p_no_s}}/SP-HRD/{{$violation->violation_ROM}}/{{$date_year_sp}}
                    </td>
                    <td> {{ tanggal_pelanggaran($violation->reporting_date); }} </td>
                  <td>
                  <?php
                    $day_sp = gmdate("l", mktime(0,0,0,$date_month_sp,$date_day_sp,$date_year_sp));

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
                    <!-- {{ $day_indo_sp. ", ". $date_day_sp. " ". $month_indo_sp . " ". $date_year_sp }} -->
                    {{ tanggal_pelanggaran($violation->date_of_violation); }}
                  </td>


                  <td>
                    <?php
                      $date_violation_end = new \DateTime($violation->date_end_violation .' 00:00:00');
                      $date_year = date_format($date_violation_end, "Y"); //for Display Year
                      $date_month =  date_format($date_violation_end, "m"); //for Display Month
                      $date_day = date_format($date_violation_end, "d"); //for Display Date

                      $day = gmdate("l", mktime(0,0,0,$date_month_sp,$date_day_sp,$date_year_sp));

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
                    <!-- {{ $day_indo. ", ". $date_day. " ". $month_indo . " ". $date_year }} -->
                    {{ tanggal_pelanggaran($violation->date_end_violation); }}
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
                      }elseif($violation->type_of_violation == 'Surat Peringatan Lisan'){
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
                      }else{
                        $p = "Tidak Ditemukan";
                      }
                    ?>
                    {{ $p }}
                  </td>
                  <td>
                    <?php 
                      // Pasal 
                      // $alphabet  = DB::table('alphabets')->find($violation->alphabet_id); 
                      // $paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); 
                      // $article  = DB::table('articles')->find($paragraph->article_id); 
                      
                       echo pasal($violation->alphabet_id);
                    
                    ?>
                  </td>

                      <td>
                      <?php 
                              if($violation->alphabet_accumulation !== NULL){
                              echo pasal($violation->alphabet_accumulation);
                              }else{

                              }
                          ?>
                      </td>
                  <td>{{ $violation->violation_status  }}</td>
                  <td>
                      <a href="/violations/{{$violation->id }}" target="_blank" class="btn  btn-outline-primary">
                        Cetak                    
                      </a>
                          <!-- <a href="/hi/employees//edit" class="btn  btn-outline-warning">
                        Edit
                        </a> -->
                        <!-- <form action="/hi/employees/" method="POST" class="d-inline ">
                          @method('delete')
                          @csrf
                          <button class="btn  btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
                          Delete
                        </button>
                        </form> -->
                  </td>
                </tr>

              @endforeach


              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item">
                <!-- <input type="text" name="select_violation_last" id="select_violation_last"> -->
                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->

                <!-- <select name="select_violation_last" id="select_violation_last">
                  <option value="sp1">sp1</option>
                  <option value="sp2">sp2</option>
                  <option value="sp3">sp3</option>
                  <option value="sp4">sp4</option>
                </select> -->
              </li>
              <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
              <li class="page-item">
              </li>
            </ul>
          </div>
        </div>
                    <!-- /.card -->


                                        <!-- general form elements -->
        <div class="card card-warning">
          <div class="card-header mb-2">
            <h3 class="card-title">INPUT PASAL</h3>
          </div>
          <div class="card-body">                      
            <div class="form-group row"> 
              <label for="pkb" class="col-sm-1 col-form-label">PKB </label>                         
              <div class="col-sm-9">
                <select class="form-control select2bs4"  name="alphabet_id" id="select_violation_last">
                  @foreach($alphabets as $alphabet):
                    <?php  $print_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                    <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                    <option value="{{$alphabet->id}}" >PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} {{$alphabet->alphabet_sound}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->alphabet_sound}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-button btn-primary"  onclick="btn_proses()" id="btn_proses" data-id="btn_proses" data-target="btn_proses">Proses</button>
              </div>
            </div> 
          </div>
        </div>

      {{-- Displaynone --}}
        <div >
       <!-- <div style="display:none;" >  -->
          <?php
            $date_violation = new \DateTime(date('Y-m-d') .' 4:06:37' );

            echo $date_year = date_format($date_violation, "Y"); //for Display Year
            echo $date_month =  date_format($date_violation, "m"); //for Display Month
            echo $date_day = date_format($date_violation, "d"); //for Display Date

          // Prints: October 3, 1975 was on a Friday
            echo "Oct 3, 1975 was on a ".date("l", gmmktime(0,0,0, 04, 20, 2022));
            echo '<br>';

            // echo $date_month;
            echo '<br>';

            $date_now = date('Y-m-d');
            echo date("l, d F Y", strtotime($date_now));
            echo '<br>';
            echo $day = gmdate("l", time()+60*60*7);
            echo '<br>';
            echo $month_m = gmdate("m", time()+60*60*7);
            echo '<br>';
            echo $month_n = gmdate("n", time()+60*60*7);

            $m_month = "'". $month_m ."'";
            echo '<br>';

            $tgl1 = $date_now;// pendefinisian tanggal awal
            $tgl2 = date('Y-m-d', strtotime('+180 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
            echo $tgl2; //print tanggal
            echo '<br> $num_no_sp ';

            // Nomer SP
            $month_m_bul = date('m');
            $yaer_y_bul = date('Y');
            echo $num_no_sp = DB::table('violations')
                              ->whereMonth('date_of_violation',  $month_m_bul)
                              ->whereYear('date_of_violation',  $yaer_y_bul)  
                              ->count();
            echo '<br> ';
            // dd($num_no_sp);
            if($num_no_sp == 0){
              $no_sp = 1;
            }elseif($num_no_sp > 0){
              $sel_no_sp = DB::table('violations')
                ->whereMonth('date_of_violation',  $month_m_bul)  
                ->whereYear('date_of_violation',  $yaer_y_bul)  
                ->orderByDesc('no_violation')
                ->latest()
                ->first();
              $no_sp = $sel_no_sp->no_violation + 1;
            }
            echo $no_sp;
            echo '<br>';
            
            $var = 1234567;
            echo is_numeric($var) ? "Jumlah digit dari bilangan ".$var." adalah ".strlen($var) : 'Bukan Termasuk Angka';
            echo '<br>';

            if(strlen($no_sp) == '1'){
              $p_no_sp = '00'. $no_sp;
            }elseif(strlen($no_sp) == '2'){
              $p_no_sp = '0'.$no_sp;
            }else{
              $p_no_sp = $no_sp;
            }

            echo $p_no_sp;
            echo '<br>';

            // Hari ROMAWI
            if($day == 'Monday'){
              $day_num = '1';
              $day_indo = 'Senin';
            }elseif($day == 'Tuesday'){
              $day_num = '2';
              $day_indo = 'Selasa';            
            }elseif($day == 'Wednesday'){
              $day_num = '3';
              $day_indo = 'Rabu';            
            }elseif($day == 'Thursday'){
              $day_num = '4';
              $day_indo = 'Kamis';            
            }elseif($day == 'Friday'){
              $day_num = '5';
              $day_indo = 'Jumat';            
            }elseif($day == 'Saturday'){
              $day_num = '6';
              $day_indo = 'Sabtu';            
            }elseif($day == 'Sunday'){
              $day_num = '7';
              $day_indo = 'Minggu';            
            }
            echo $day_indo;
            echo '<br>';
            echo $day_num;

            echo '<br>';
            if($month_n == '1'){
              $ROM = 'I';
            }elseif($month_n == '2'){
              $ROM = 'II';
            }elseif($month_n == '3'){
              $ROM = 'III';
            }elseif($month_n == 4){
              $ROM = 'IV';
            }elseif($month_n == '5'){
              $ROM = 'V';
            }elseif($month_n == '6'){
              $ROM = 'VI';
            }elseif($month_n == '7'){
              $ROM = 'VII';
            }elseif($month_n == '8'){
              $ROM = 'VIII';
            }elseif($month_n == '9'){
              $ROM = 'IX';
            }elseif($month_n == '10'){
              $ROM = 'X';
            }elseif($month_n == '11'){
              $ROM = 'XI';
            }elseif($month_n == '12'){
              $ROM = 'XII';
            }
            echo $ROM;

            echo "<br/>";
            $awal  = date_create('2022-04-10');
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff( $awal, $akhir );

            echo 'Selisih waktu: ';
            echo $diff->y . ' tahun, ';
            echo $diff->m . ' bulan, ';
            echo $diff->d . ' hari, ';
            echo $diff->h . ' jam, ';
            echo $diff->i . ' menit, ';
            echo $diff->s . ' detik, ';

            // Cari data pelanggan terakhir 
            
            /*
            $sel_num_vio = DB::table('violations')->where('employee_id', $employee->id)->count();
            if($sel_num_vio > 0){
              $sel_vio = DB::table('violations')->where('employee_id', $employee->id)->latest()->first();
              $date_now = date_create();
              $date_sta = date_create($sel_vio->date_end_violation);
              $diffx  = date_diff($date_sta, $date_now);
              if($diffx->d <= 0){
                $sta_viol = 'notactive';
                $type_viol = 'notviolation';
                $last_accumulation = 0;
              }else{
                $sta_viol = $sel_vio->violation_status;
                $type_viol = $sel_vio->type_of_violation;
                $last_accumulation = $sel_vio->accumulation;
              }
            }elseif($sel_num_vio < 1){
              $sel_num_vio_migrat = DB::table('violationmigrations')->where('employee_id', $employee->id)->count();
              if($sel_num_vio_migrat > 0){
                $vio_migrat = DB::table('violationmigrations')
                  ->where('employee_id', $employee->id)
                  ->orderBy('id', 'desc')
                  ->first();
                  if($vio_migrat->violation_status == 'active'){
                    if($vio_migrat->type_of_violation == 'Peringatan Lisan'){
                      $l_accuml = 0.5;
                    }elseif($vio_migrat->type_of_violation == 'Surat Peringatan Pertama'){
                      $l_accuml = 1;
                    }elseif($vio_migrat->type_of_violation == 'Surat Peringatan Kedua'){
                      $l_accuml = 2;
                    }elseif($vio_migrat->type_of_violation == 'Surat Peringatan Ketiga'){
                      $l_accuml = 3;
                    }elseif($vio_migrat->type_of_violation == 'Surat Peringatan Terakhir'){
                      $l_accuml = 4;
                    }elseif($vio_migrat->type_of_violation == 'Pemutusan Hubungan Kerja'){
                      $l_accuml = 5;
                    }else{
                      $l_accuml = 0;
                    }
                    $sta_viol = $vio_migrat->violation_status;
                    $type_viol = $vio_migrat->type_of_violation;
                    $last_accumulation = $l_accuml;
                  }else{
                    $sta_viol = 'notactive';
                    $type_viol = 'notviolation';
                    $last_accumulation = 0;
                  }
              }elseif($sel_num_vio_migrat < 1){
                $sta_viol = 'notactive';
                $type_viol = 'notviolation';
                $last_accumulation = 0;
              }
            }

            */
            $sel_num_vio = DB::table('violations')
              ->where('employee_id', $employee->id)
              ->where('violation_status', '!=', 'cancel')
              ->count();

            if($sel_num_vio == 0){
              $sta_viol = 'notactive';
              $type_viol = 'notviolation';
              $last_accumulation = 0;
              
            }else{
              $sel_vio = DB::table('violations')
                ->where('employee_id', $employee->id)
                ->where('violation_status', '!=', 'cancel')
                ->latest()
                ->first();

              // $date_now = date_create();
              // $date_sta = date_create($sel_vio->date_end_violation);
              // $diffx  = date_diff($date_sta, $date_now);

              $date_str_reporting_date = strtotime(date('Y-m-d'));
              $date_str_date_end_violation_lasst = strtotime($sel_vio->date_end_violation);
              $differencs_date = $date_str_date_end_violation_lasst - $date_str_reporting_date;

              if($differencs_date <= 0){
                $sta_viol = 'notactive';
                $type_viol = 'notviolation';
                $last_accumulation = 0;
              }else{
                if($sel_vio->violation_status == 'cancel'){
                  $sta_viol = 'notactive';
                  $type_viol = 'notviolation';
                  $last_accumulation = 0;
                }elseif($sel_vio->violation_status == 'active'){
                  $sta_viol = $sel_vio->violation_status;
                  $type_viol = $sel_vio->type_of_violation;
                  $last_accumulation = $sel_vio->accumulation;
                }else{
                  $sta_viol = 'notactive';
                  $type_viol = 'notviolation';
                  $last_accumulation = 0;
                }
              }
            }            

            echo '<br>';
            //memotong jumlah karakter
            $kalimat="tutorial php bagaimana membatasi jumlah karakter yang ingin ditampilkan";
            $jumlahkarakter=10;
            $cetak = substr($kalimat, 0, $jumlahkarakter);
            echo $cetak;

            echo '<br>';

          ?>
          <!-- INISIASI AKUMULASI PELANGGARAN -->
          <input type="text" name="last_vio" value="{{$sta_viol}}" id="last_vio">
          <input type="text" name="last_type" value="{{$type_viol}}" id="last_type">
          <input type="text" name="id_emp" value="{{$employee->id}}" id="id_emp">
          <input type="text" name="last_accumulation" value="{{$last_accumulation}}" id="last_accumulation" >    

        </div>
        {{-- Displaynone --}}
        <button type="button" id="btn_modal_click1" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl1">
          Surat Peringatan asli
        </button>
        <div class="modal fade" id="modal-xl1">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Form pelanggaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form role="form" action="/violations" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- <p>One fine body&hellip;</p> -->
  
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tanggal Laporan</label>
                    <div class="col-sm-4">
                        <input type="date" name="reporting_date" class="form-control" required>
                    </div>
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Nomer SP </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" value="{{$p_no_sp}}/SP-HRD/{{$ROM}}/{{date('Y')}}" placeholder="Nomer SP" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Nama </label>
                  <div class="col-sm-4">
                      <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{  $employee->id  }}" placeholder="Nomer Induk Karyawan" >
                      <input type="text" class="form-control" value="{{  $employee->name  }}" placeholder="Nama Karyawan" disabled>
                  </div>
                  <label for="number_of_employees" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" value="{{  $employee->number_of_employees  }}" placeholder="Nomer Induk Karyawan" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="job_level" class="col-sm-2 col-form-label">Jabatan </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="job_level" value="{{  $job->job_level  }}" placeholder="Jabatan" disabled>
                      <input type="hidden" class="form-control" name="job_level" value="{{  $job->job_level  }}" >
                  </div>
                  <label for="department" class="col-sm-2 col-form-label">Bagian / Department</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="department" value="{{  $department->department  }}" placeholder="Bagian" disabled>
                      <input type="hidden" class="form-control"  name="department" value="{{  $department->department  }}" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Jenis Pelangaran</label>
                  <div class="col-sm-3">
                      <input type="hidden" name="last_vio" value="{{$sta_viol}}" >
                      <input type="hidden" name="last_type" value="{{$type_viol}}"  >     
                      <input type="hidden" name="last_accumulation" value="{{$last_accumulation}}"  >     

                      <input type="text" class="form-control" id="jpn1"  placeholder="Jenis Pelanggaran" >     
                  </div>
                </div> 
            
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Pasal Yang dilanggar : </label>
                  <input type="hidden" class="form-control" id="alphabet_id" name="alphabet_id"  value="" placeholder="Alphabet ID" >                  
                  <div class="col-sm-10" id="pkb1">

                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Keterangan lain :</label>
                  <div class="col-sm-10">
                    <!-- <input id="x" type="hidden" name="other_information">
                    <trix-editor input="x"></trix-editor> -->
                    <textarea name="other_information" class="form-control" id="" rows="4" required></textarea>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Remainder : </label>
                  <div class="col-sm-10" id="remainder1">
                    
                  </div>
                  <label for="inputName" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10" id="remainder2">
                    
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-12 col-form-label">
                    Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran ) maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                  </label>
                  
                </div> 
                <div class="form-group row">
                  <label for="date_of_violation" class="col-sm-2 col-form-label">Tanggal Surat :</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control" id="date_of_violation" name="date_of_violation" value="<?= date('Y-m-d') ?>">     
                  </div>
                  <label for="sgn_id" class="col-sm-3 col-form-label">Human Resource Development :</label>
                  <div class="col-sm-3">
                      <?php  $signature  = DB::table('signatures')->where('status_signature', 'active')->first(); ?>

                    <input type="hidden" class="form-control" id="sgn_id" name="signature_id" value="{{ $signature->id }}">     
                    <input type="text" class="form-control" id=""  value="{{ $signature->name }}">     
                  </div>
                </div> 

              </div> 
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                        echo '<button type="submit" class="btn btn-primary">Simpan</button>';
                      }
                    }
                  }
              ?>
                
                <!-- <button type="submit" class="btn btn-primary">Save</button> -->
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                <!-- /.modal -->

                
        <button type="button" id="btn_modal_click2" class="btn btn-default" style="display:none;" data-toggle="modal" data-target="#modal-xl2">
          Surat Peringatan Akumulasi
        </button>
        <div class="modal fade" id="modal-xl2">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambahkan pelanggaran 2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- <p>One fine body&hellip;</p> -->
                <div class="form-group row">
                  <label for="number_of_employees" class="col-sm-2 col-form-label">Nomer SP </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="number_of_employees" name="no_violation" value="{{ $p_no_sp }}/SP-HRD/{{$ROM}}/{{ date('Y') }}" placeholder="Nomer Induk Karyawan" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Nama </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}" placeholder="Nomer Induk Karyawan" >
                  </div>
                  <label for="number_of_employees" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" value="{{$employee->number_of_employees}}" placeholder="Finger ID" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="job_level" class="col-sm-2 col-form-label">Jabatan </label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="job_level" name="job_level" value="{{  $job->job_level  }}" placeholder="Nomer Induk Karyawan" >
                  </div>
                  <label for="department" class="col-sm-2 col-form-label">Bagian / Department</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="department" name="department" value="{{  $department->department  }}" placeholder="Finger ID" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Jenis Pelangaran</label>
                  <div class="col-sm-3">
                      <input type="text" class="form-control" id="jpn2" name="jpn"  placeholder="Jenis Pelanggaran" >     
                  </div>
                </div> 
            
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Pasal Yang dilanggar : </label>
                  <div class="col-sm-10">
                    <p>
                        Perjanjian Kerja Bersama Pasal 27 ayat (5) huruf "c". Pekerja sudah diberikan Sanksi SP III (tiga), yang masa berlakunya belum habis tetapi melakukan pelanggaran kembali yang bobot sanksinya SP III (tiga) atau SP II (dua) atau SP I (satu)..
                    </p>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Keterangan lain :</label>
                  <div class="col-sm-10">
                      <form …>
                          <input id="x" type="hidden" name="content">
                          <trix-editor input="x">
                              -	Mangkir Tanggal 11 dan 26 Oktober 2021
                              -	Bobot Pelanggaran sekarang yaitu Perjanjian Kerja Bersama Pasal 27 ayat (2) huruf "g" Tidak masuk kerja tanpa keterangan/ Alpa selama 2 (dua) hari tidak berturut-turut selama satu bulan.
                              -	Dalam masa Surat Peringatan Ketiga Perjanjian Kerja Bersama Pasal 27 ayat (4) huruf "b"; Perjanjian Kerja Bersama Pasal 27 ayat (2) huruf "m"., Melakukan checkroll kehadiran, tetapi tidak berada di produksi tanpa keterangan dispensasi dan non-job
                              

                          </trix-editor>
                        </form>
                    {{-- <input type="text" class="form-control" id="jpn" name="jpn" value="-	Mencekrollkan absensi sdr. Arum Kusumaningtyas dan sdr. Arum Wahyunigsih pada Selasa, 5 April 2022">      --}}
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-12 col-form-label">
                    Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran ) maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                  </label>
                  
                </div> 
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Tanggal Surat :</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control" id="jpn" name="jpn" value="<?= date('Y-m-d') ?>">     
                  </div>
                  <label for="inputName" class="col-sm-3 col-form-label">Human Resource Development :</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="jpn" name="jpn" value="Nama manager">     
                  </div>
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
                <!-- /.modal -->
    


      </div>
    </div>

  </section>
</div>

@endsection