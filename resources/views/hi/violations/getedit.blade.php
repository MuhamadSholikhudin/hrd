@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Pelanggran Page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Edit</a></li>
          <li class="breadcrumb-item active">Edit pelanggaran Page</li>
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
      <h3 class="card-title">Form Edit Pelanggran</h3>

      <div class="card-tools">
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button> -->
      </div>
    </div>

    <form action="{{route('teatupdate')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <div id="div1">
                    <h2>Let jQuery AJAX Change This Text</h2>
                </div>
                <button>Get External Content</button> -->
            </div>
            
            <div class="card  border-0">
                <div class="header p-4">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{asset('img/HWASEUNG.PNG')}}" alt="" width="150px" height="80px">
                        </div>
                        <div class="col-md-10">
                            <h3 class="text-center">PT. HWA SEUNG INDONESIA</h3>
                            <h5 class="text-center">Jalan Krasak Banyuputih RT.09 RW.03 Kecamatan Kalinyamatan Kabupaten Jepara,</h5>
                            <h5 class="text-center">Provinsi Jawa Tengah, Indonesia 59467 Tel: (0291) 7512198 Fax: (0291) 7512191</h5>
                            <!-- <h3 class="text-center">USAHA KECIL DAN MENENGAH</h3> -->
                            <!-- <h5 class="text-center">Provinsi Jawa Tengah, Indonesia 59467  Tel: (0291) 7512198 Fax: (0291) 7512191</h5> -->
                            <!-- <h3 class="text-center">KUDUS 59322</h3> -->
                        </div>
                        <br>
                        <hr class="new5" style="border: 3px solid black; border-radius: 5px; width: 100%;">
                    </div>

                </div>
                <div class="body">
     
                    <h3 class="text-center ">
                        <u> SURAT PERINGATAN </u>
                    </h3>
                        <?php 
                            $date_violation_sp = new \DateTime($violation->date_of_violation .' 00:00:00');
                            
                            if(strlen($violation->no_violation) == '1'){
                                $p_no_s = '00'. $violation->no_violation;
                            }elseif(strlen($violation->no_violation) == '2'){
                                $p_no_s = '0'.$violation->no_violation;
                            }else{
                                $p_no_s = $violation->no_violation;
                            }
                        ?>
                    <h5 class="text-center "> 
                        NO: <input type="text" name="no_violation" id="" value="{{ $p_no_s}}" style="width:80px;">
                         /SP-HRD/
                         <?php
                            $layROMs = ["I", "II","III","IV","V","VI","VII","VIII", "IX", "X", "XI", 'XII'];
                        ?>

                        <select name="violation_ROM" id="">
                        <?php
                            foreach($layROMs as $layROM) :?>
                            <?php if($layROM == $violation->violation_ROM){ ?>
                                <option value="<?= $layROM?>" selected><?= $layROM?></option>
                            <?php }else{ ?>
                                <option value="<?= $layROM?>"><?= $layROM?></option>
                            <?php }     ?>  
                            <?php endforeach;
                        ?>
                        
                        </select>
                         
                         /{{date_format($date_violation_sp, "Y")}}      
                    </h5>
                    <br>
                    <div class="col-sm-12 lead">Kepada karyawan tersebut di bawah ini :</div>
                    <br>
                    <!-- <div class="col-sm-3 lead">

                    </div> -->
                    <div class="col-sm-9 lead">
                        <table>
                            <?php
                                $employee = DB::table('employees')->find($violation->employee_id);
                            ?>
                            <tr>
                                <td>
                                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                </td>
                                <td>Nama</td>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;{{ $employee->name}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>NIK</td>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;{{ $employee->number_of_employees}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>Jabatan</td>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:&nbsp; <input type="text" name="job_level" id="" value="{{ $violation->job_level}}" style="width:400px;"> </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>Bagian/ Department</td>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;  <input type="text" name="department" id="" value="{{ $violation->department}}" style="width:400px;"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="col-sm-12 lead">Edit Tanggal Laporan : <b><u>
                        <input type="date" name="reporting_date" id="" value="{{ $violation->reporting_date}}">
                        </u></b> 
                    </div>
                    <br>
                    <div class="col-sm-12 lead">   
                        <?php
                        $violation_id = $violation->id;

                        //hitung sp terakhir ada apa tidak
                        $sel_num_vio = DB::table('violations')
                            ->where('employee_id', $employee->id)
                            ->where('violation_status', '!=', 'cancel')
                            ->where('id', '<', $violation_id)
                            ->count();
              
                            //jika ada sp masaih aktif
                        if($sel_num_vio > 0){
                        
                            //taampilkan sp terkhhiir
                            $sel_last_vio = DB::table('violations')
                                ->where('employee_id', $employee->id)
                                ->where('violation_status', '!=', 'cancel')
                                ->where('date_end_violation', '>=', $violation->reporting_date)
                                ->where('id', '<', $violation_id)
                                ->orderByDesc('id')
                                ->first();

                                // jika sp terakhir sama dengan Peringatan LIsan
                            if($sel_last_vio->type_of_violation == "Peringatan Lisan"){
                            
                              $sp_lisan_terakhir = $sel_last_vio->violation_status;
              
                                // cari sp sebelum sp lisan yang aktif
                                $cari_sp_sebelum_sp_lisan = DB::table('violations')
                                    ->where('employee_id', $employee->id)
                                    ->where('violation_status', '!=', 'cancel')
                                    ->where('date_end_violation', '>=', $violation->reporting_date)
                                    ->where('id', '<', $sel_last_vio->id)
                                    ->count();
              
                                    // jika ada sebelum sp lisan yang aktif
                                if($cari_sp_sebelum_sp_lisan > 0){
              
                                  // cari sp terakhir sebelum sp lisan active
                                    $count_sp_terakhir_sebelum_sp_lisan = DB::table('violations')
                                        ->where('employee_id', $employee->id)
                                        ->where('violation_status', '!=', 'cancel')
                                        ->where('date_end_violation', '>=', $violation->reporting_date)
                                        ->where('id', '<', $sel_last_vio->id)
                                        ->where("type_of_violation", "!=" , "Peringatan Lisan")
                                        ->count();
              
                                        // jika ada sp terakhir sebelum sp lisan active
                                    if($count_sp_terakhir_sebelum_sp_lisan > 0){
              
                                        //tampilkan sp terakhir sebelum sp lisan active
                                        $cari_sp_terakhir_sebelum_sp_lisan = DB::table('violations')
                                            ->where('employee_id', $employee->id)
                                            ->where('violation_status', '!=', 'cancel')
                                            ->where('date_end_violation', '>=', $violation->reporting_date)
                                            ->where('id', '<', $sel_last_vio->id)
                                            ->where("type_of_violation", "!=" , "Peringatan Lisan")
                                            ->orderByDesc('id')
                                            ->first();
              
                                            // $cari_sp_terakhir_sebelum_sp_lisan_type = cari_sp_terakhir_sebelum_sp_lisan_type($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation);
                                        
                                            if($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Peringatan Lisan"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 0.5;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Pertama"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 1;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Kedua"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 2;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Ketiga"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 3;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Terakhir"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 4;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Pemutusan Hubungan Kerja"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 5;    
                                            }

                                            //cari sp lisan sebelum sp lisan
                                        $cari_sp_lisan_sebelum_sp_lisan = DB::table("violations")
                                            ->where("employee_id", $employee->id)
                                            ->where("violation_status", "!=", "cancel")
                                            ->where('date_end_violation', '>=', $violation->reporting_date)
                                            ->where("type_of_violation", "Peringatan Lisan")
                                            ->where("id", "<", $sel_last_vio->id)
                                            ->count();
                                        
                                        // sp_gab($cari_sp_lisan_sebelum_sp_lisan);
                                        if($cari_sp_lisan_sebelum_sp_lisan == 1){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 2){
                                            $s_p_1 = 0.5;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 3){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 4){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }else{
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }
              
                                        // jika tidak ada sp terakhir sebelum sp lisan active selain sp lisan
                                    }else{
                                      $sp_gab = 0.5;
                                    }
              
                                // jika tidak ada sp terakhir setelah SP lisan
                                }else{
                                    $s_p_1 = 0.5;
                                    $sp_gab = $s_p_1;
                                }
              
                                // jika sp terakhir tidak sama dengan Peringatan Lisan
                            }else{
              
                                // $cari_sp_terakhir_sebelum_sp_lisan_type = cari_sp_terakhir_sebelum_sp_lisan_type($sel_last_vio->type_of_violation);
                                if($sel_last_vio->type_of_violation == "Peringatan Lisan"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 0.5;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Pertama"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 1;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Kedua"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 2;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Ketiga"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 3;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Terakhir"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 4;
                                }elseif($sel_last_vio->type_of_violation == "Pemutusan Hubungan Kerja"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 5;    
                                }

                                $cari_sp_lisan_sebelum_sp_lisan = DB::table('violations')
                                    ->where('employee_id', $employee->id)
                                    ->where('violation_status', '!=', 'cancel')
                                    ->where('date_end_violation', '>=', $violation->reporting_date)
                                    ->where('type_of_violation', 'Peringatan Lisan')
                                    ->where('id', '<', $sel_last_vio->id)
                                    ->count();
              
                                if($cari_sp_lisan_sebelum_sp_lisan == 1){
                                    $s_p_1 = 0.5;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 2){
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 3){
                                    $s_p_1 = 0.5;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 4){
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }else{
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }
                            }
                           
                                if($sp_gab == 0.5){
                                    $status_type_violation_akhir = 'Peringatan Lisan';
                                }elseif($sp_gab >= 1 AND $sp_gab <= 1.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Pertama';
                                }elseif($sp_gab >= 2 AND $sp_gab <= 2.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Kedua';
                                }elseif($sp_gab >= 3 AND $sp_gab <= 3.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Ketiga';
                                }elseif($sp_gab >= 4 AND $sp_gab <= 4.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Terakhir';
                                }elseif($sp_gab >= 5 AND $sp_gab <= 5.5){
                                    $status_type_violation_akhir = 'Pemutusan Hubungan Kerja';
                                } 
                                              
                                $sta_viol = $sel_last_vio->violation_status;
                                $type_viol = $status_type_violation_akhir;
                                $last_accumulation = $sp_gab;
                
                            }else{
                                $sp_gab = 0;
                
                                $sta_viol = 'notactive';
                                $type_viol = 'notviolation';
                                $last_accumulation = $sp_gab;
                            }




                
                            // $sel_num_vio = DB::table('violations')
                            //     ->where('employee_id', $violation->employee_id)
                            //     ->where('id', '<' ,$violation->id)
                            //     ->where('violation_status', '!=', 'cancel')
                            //     ->count();

                            // if($sel_num_vio == 0){
                            //     $sta_viol = 'notactive';
                            //     $type_viol = 'notviolation';
                            //     $last_accumulation = 0;
                            
                            // }else{
                            //     $sel_vio = DB::table('violations')
                            //         ->where('employee_id', $violation->employee_id)
                            //         ->where('id', '<' ,$violation->id)     
                            //         ->where('violation_status', '!=', 'cancel')                               
                            //         ->latest()
                            //         ->first();

                            //     // $date_now = date_create($violation->reporting_date);
                            //     // $date_sta = date_create($sel_vio->date_end_violation);
                            //     // $diffx  = date_diff($date_sta, $date_now);

                            //     $date_str_reporting_date = strtotime($violation->reporting_date);
                            //     $date_str_date_end_violation_lasst = strtotime($sel_vio->date_end_violation);
                            //     $differencs_date = $date_str_date_end_violation_lasst - $date_str_reporting_date;

                            //     if($differencs_date <= 0){
                            //         $sta_viol = 'notactive';
                            //         $type_viol = 'notviolation';
                            //         $last_accumulation = 0;
                            //     }else{
                            //         if($sel_vio->violation_status == 'cancel'){
                            //             $sta_viol = 'notactive';
                            //             $type_viol = 'notviolation';
                            //             $last_accumulation = 0;
                            //         }elseif($sel_vio->violation_status == 'active'){
                            //             $sta_viol = $sel_vio->violation_status;
                            //             $type_viol = $sel_vio->type_of_violation;
                            //             $last_accumulation = $sel_vio->accumulation;
                            //         }else{
                            //             $sta_viol = 'notactive';
                            //             $type_viol = 'notviolation';
                            //             $last_accumulation = 0;
                            //         }
                            //     }

                                
                            // } 


                        ?>
                        <div class="d-none" id="loader" style="display: flex; justify-content: center;">
                            <div class="spinner-border flex juftify-center" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        
                        <div style="display:none;">
                        <!-- <div> -->
                            <input type="text" name="violation_id" value="{{$violation->id}}" id="violation_id">
                            <input type="text" name="" value="" id="alphabet_id">
                            <input type="text" name="last_vio" value="{{$sta_viol}}" id="last_vio">
                            <input type="text" name="last_type" value="{{$type_viol}}" id="last_type">
                            <input type="text" name="employee_id" value="{{$violation->employee_id}}" id="id_emp">
                            <input type="text" name="last_accumulation" value="{{$last_accumulation}}" id="last_accumulation">
                         
                            
                        </div>


                    </div>                    
                    
                    <div class="col-sm-12 lead">   
                        
                        <div class="form-group row"> 
                            <label for="pkb" class="col-sm-2 col-form-label">Edit Pasal </label>                         
                            <div class="col-sm-8">
                                <select class="form-control select2bs4"  name="alphabet_id" id="select_violation_last">
                                @foreach($alphabets as $alphabet):
                                    <?php  $print_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                                    <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                                    
                                    <?php if($alphabet->id == $violation->alphabet_id){ ?>
                                        <option value="{{$alphabet->id}}" selected>PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} {{$alphabet->alphabet_sound}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->alphabet_sound}}</option>
                                    <?php }else{ ?>
                                    <option value="{{$alphabet->id}}" >PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} {{$alphabet->alphabet_sound}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->alphabet_sound}}</option>
                                    <?php }?>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <!-- <button class="btn btn-button btn-primary"  onclick="btn_proses_edit()" id="btn_proses_edit" >
                                
                                <i class="fa-solid fa-loader"></i>
                                Proses</button> -->

                                <button type="button" class="btn bg-gradient-primary"  onclick="btn_proses_edit()" id="btn_proses_edit">
                                <i class="fa-solid fa-spinner"></i> &nbsp;
                                Proses
                                </button>
                            </div>                            
                            
                        </div> 

                    </div>
                    
                    <br>

                    <div class="col-sm-12 lead">Dengan ini diberikan, <b><u>
                        <input type="text" name="type_of_violation" id="jpn1" value="{{ $violation->type_of_violation}}">
                        </u></b> 
                    </div>
                    <br>
                    <div class="col-sm-12 lead" style="text-align: justify;">Sehubungan yang bersangkutan telah melakukan pelanggaran peraturan/tata tertib/disiplin kerja yang
                        berlaku di perusahaan. :</div>
                        <br>
                    <div class="col-sm-12 lead"> <b>Pasal yang dilanggar : </b></div>
                    
                    <?php 
                        $sel_alphabet = DB::table('alphabets')->find($violation->alphabet_id);
                        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
                        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
                    ?>
                    @if($violation->alphabet_accumulation != NULL)
                        <!-- violation accumulation here -->
                            <?php
                                $sel_alphabet_accumulation = DB::table('alphabets')->find($violation->alphabet_accumulation);
                                $sel_paragraph_accumulation = DB::table('paragraphs')->find($sel_alphabet_accumulation->paragraph_id);
                                $sel_article_accumulation = DB::table('articles')->find($sel_paragraph_accumulation->article_id);
                            ?>
                        
                                <!-- PASAL AKUMULASI -->
                            <div class="col-sm-12 lead" style="text-align: justify;" id="pkb1">Perjanjian Kerja Bersama Pasal  
                            {{$sel_article_accumulation->article}} ayat ({{$sel_paragraph_accumulation->paragraph}})  huruf "{{$sel_alphabet_accumulation->alphabet}}"  {{$sel_alphabet_accumulation->alphabet_sound}}</div>
                        
                    @else
                    
                              <!-- Pasal Tanpa Akumulasi -->
                        <div class="col-sm-12 lead" style="text-align: justify;" id="pkb1">Perjanjian Kerja Bersama Pasal 
                        {{$sel_article->article}} ayat ({{$sel_paragraph->paragraph}}) huruf "{{$sel_alphabet->alphabet}}" {{$sel_alphabet->alphabet_sound}}.</div>
                    @endif
              
                    <br>
                    <div class="col-sm-12 lead"><b>Keterangan lain :</b></div>


                    @if($violation->alphabet_accumulation != null)
                        @if($violation->violation_accumulation != null)
                            <!-- PASAL SEKARANG, BUNYI PASAL -->
                            <!-- <div class="col-sm-12 lead" style="text-align: justify;">- Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  {{$sel_alphabet->alphabet_sound}}</div> -->
                            
                            <!-- PASAL LALU, DELIK PELANGGARAN LALU -->
                            <?php 
                                $pelanggran_lalu = DB::table('violations')->find($violation->violation_accumulation);

                                $sel_alphabet_lalu = DB::table('alphabets')->find($pelanggran_lalu->alphabet_id);
                                $sel_paragraph_lalu = DB::table('paragraphs')->find($sel_alphabet_lalu->paragraph_id);
                                $sel_article_lalu = DB::table('articles')->find($sel_paragraph_lalu->article_id);
                            ?>
                            <!-- <div class="col-sm-12 lead" style="text-align: justify;">- Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal  {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}", {{$pelanggran_lalu->other_information}}</div> -->
                            
                            <table>
                                <tbody>
                                    <tr>
                                        <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                        <td valign="top" class="lead" style="text-align: justify;">
                                        
                                        <textarea name="other_information" id="" style="width:100%;" >{{ $violation->other_information}}</textarea>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                        <td valign="top" class="lead" style="text-align: justify;" id="remainder1">Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  
                                            <!-- {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"   -->
                                            {{ pasal($violation->alphabet_id);}}
                                            {{$sel_alphabet->alphabet_sound}}</td>
                                    </tr>

                                    <tr>
                                        <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                        <td valign="top" class="lead" style="text-align: justify;" id="remainder2">
                                        
                                            <?php 
                                            
                                                    // Jika pelanggaran sebelumnya akumulasi => pasal_akumulasi, 
                                                    if($violation->violation_accumulation3 !== NULL){
                                                        $pelanggran_lalu2 = DB::table('violations')->find($violation->violation_accumulation2);
                                                        ?> 
                                                        Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 

                                                        <?php if($pelanggran_lalu->alphabet_accumulation != NULL){ ?>
                                                                {{ pasal($pelanggran_lalu->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                        <?php } ?>

                                                        {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}", 
                                                        {{$pelanggran_lalu->other_information}} 
                                                        {{$pelanggran_lalu2->other_information}} </td>                                                 
                                                    <?php 
                                                    }elseif($violation->violation_accumulation2 !== NULL){
                                                        $pelanggran_lalu2 = DB::table('violations')->find($violation->violation_accumulation2);
                                                        ?> 
                                                        Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                        <?php
                                                            if($pelanggran_lalu->alphabet_accumulation != NULL){ ?>
                                                                {{ pasal($pelanggran_lalu->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                        <?php } ?>                                                       
                                                        <!-- {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}", -->
                                                        {{ pasal($pelanggran_lalu->alphabet_id);}} ,
                                                        {{$pelanggran_lalu->other_information}} {{$pelanggran_lalu2->other_information}} </td>                                                    
                                                    <?php 
                                                    }elseif($violation->violation_accumulation !== NULL){  ?>
                                                        Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal
                                                        <?php
                                                            if($pelanggran_lalu->alphabet_accumulation != NULL){ ?>
                                                                {{ pasal($pelanggran_lalu->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                        <?php } ?>
                                                        <!-- {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}",  -->
                                                        {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                        {{$pelanggran_lalu->other_information}}</td>                                                       
                                                    <?php 
                                                    }else{
                                                        
                                                    }

                                            ?>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                        <!-- PASAL SEKARANG, BUNYI PASAL -->
                        <!-- <div class="col-sm-12 lead" style="text-align: justify;">- Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  {{$sel_alphabet->alphabet_sound}}</div> -->
                        
                        <!-- PASAL LALU, DELIK PELANGGARAN LALU -->
            
                        
                        <table >
                            <tbody>
                                <tr>
                                    <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                    <td valign="top" class="lead" style="text-align: justify;">{{ $violation->other_information}}</td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                    <td valign="top" class="lead" style="text-align: justify;" id="remainder1">Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  
                                        <!-- {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  -->
                                        {{ pasal($violation->alphabet_id);}} 
                                        
                                        {{$sel_alphabet->alphabet_sound}}</td>
                                </tr>

                                <tr>
                                    <td valign="top" >&nbsp;&nbsp;&nbsp;-</td>
                                    <td valign="top" class="lead" style="text-align: justify;" id="remainder2"></td>
                                    
                    
                                </tr>
                            </tbody>
                        </table>
                        @endif
                        <!-- DELIK SEKARANG -->
                        <!-- <div class="col-sm-12 lead" style="text-align: justify;">- {{ $violation->other_information}}</div> -->



                        
                    @else
                        <table >
                            <tbody>
                                <tr>
                                    <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                    <td valign="top" class="lead" style="text-align: justify;" id="remainder1">{{ $violation->other_information}}</td>
                                </tr>
                            </tbody>
                        </table>
                            <!-- Remainder Tanpa Akumulasi -->
                        <!-- <div class="col-sm-12 lead" style="text-align: justify;">- {{ $violation->other_information}}</div> -->
                    @endif
                    

                    <br>
                    <div class="col-sm-12 lead" style="text-align: justify;">
                        Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan
                        perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran )
                        maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                    </div>
                       


                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <h4 class="text-center"> &nbsp; </h4>
                                </div>
                                <div>
                                    <p class="text-center lead"> 
                                    &nbsp;<br>
                                        Penerima Sanksi
                                    </p>
                                    <!-- <h6 class="text-center">&nbsp;</h6>
                                    <h6 class="text-center">Penerima Sanksi,</h6> -->
                                </div>
                                <div>
                                    <br>
                                    <div class="justify-content-center">
                                   
                                    </div>
                                    <br>
                               
                                </div>
                                <div>
                                    <p class="text-center lead"> <br>
                                            {{ $employee->name}}
                                    </p>
                                    <!-- <h6 class="text-center">
                                        <b>
                                            {{-- GUNTUR SUHENDRO --}}
                                            {{ $employee->name}}
                                        </b>
                                    </h6> -->
                                
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                            </div>
                            <div class="col-sm-4 ">
                                <div>
                                    <h4 class="text-center"> &nbsp; </h4>
                                </div>
                                <div>
                                    <?php 
                                        $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date
                                        $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
                                        $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
                                        $day_sp = gmdate("l", mktime(0,0,0,$date_day_sp,$date_month_sp,$date_year_sp));

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
                                        <p class="text-center lead"> 
                                            Jepara, 
                                            <input type="date" name="date_of_violation" value="{{$violation->date_of_violation}}" id="">
                                            <br>
                                            Human Resources Development

                                        </p>

                                     <!-- <h6 class="text-center">Jepara, 5 April 2022 </h6> 
                                    <h6 class="text-center">Human Resources Development</h6>  -->
                                </div>
                                <div>
                                    <br>
                                    <div class="justify-content-center">
                                    
                                    </div>
                                    <br>
                               
                                    
                                </div>
                                <div>
                                    
                                    <p class="text-center lead"> <br>
                                        
                                        <b>
                                            <u>
                                            <?php 
                                                if($violation->signature_id <> NULL){
                                                    $hrd = DB::table('signatures')->find($violation->signature_id);
                                                    $an_hrd =  $hrd->name;
                                                }elseif($violation->signature_id == ""){
                                                    $hrd = DB::table('signatures')->where('status_signature', 'active')->first();
                                                    $an_hrd =  $hrd->name;
                                                }else{
                                                    $hrd = DB::table('signatures')->where('status_signature', 'active')->first();
                                                    $an_hrd =  $hrd->name;
                                                }
                                            ?>
                                            {{ $an_hrd  }}
                                            <input type="hidden" name="signature_id" value="{{$hrd->id}}" id="">
                                            </u>
                                        </b>
                                    </p>
                                    
                                
                                </div>


                            </div>
                        </div>
                        

                    </div>

                </div>
            </section>






    </div>
    <!-- /.card-body -->
    <div class="card-footer" style="display: flex; justify-content: right;">
        <button type="submit" class="btn bg-gradient-success" >
        <i class="fa-solid fa-pen-to-square"></i>
        Update</button>
    </div>
    </form>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->


</div>

@endsection