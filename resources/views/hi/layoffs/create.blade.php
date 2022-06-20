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
        <a href="/layoffs/" class="btn  btn-secondary">Kembali</a>
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
          <h3 class="card-title">Form Surat Keputusan PHK </h3>
        </div>
        <form action="/layoffs/" method="POST" enctype="multipart/form-data">
              @csrf
        <!-- /.card-header -->
        <div class="card-body">
          <p class="text-center">
            <u>
              SURAT KEPUTUSAN
              
            </u>
            <br>
              <?php 
              $bul = date('m');
              $yea = date('Y');
              $num_latest = DB::table('layoffs')
                ->whereMonth('layoff_date', $bul) 
                ->whereYear('layoff_date', $yea) 
                ->count(); 

                if($num_latest < 1){
                  $no_lf = 1;
              }elseif($num_latest > 0){
                  $latest = DB::table('layoffs')
                      ->whereMonth('layoff_date', $bul) 
                      ->whereYear('layoff_date', $yea) 
                      ->orderBy('no_layoff', 'desc')
                      ->first();
                  $no_lf = $latest->no_layoff + 1;
              }
              // echo $num_latest;
              ?>

              NO.    <input type="text" name="no_layoff" id="" value="{{$no_lf}} " style="width: 80px;">     /SK-PHK/HRD-HWI/
              <?php
                if($bul == "01"){
                    $ROM = 'I';
                }elseif($bul == "02"){
                    $ROM = 'II';
                }elseif($bul == "03"){
                    $ROM = 'III';
                }elseif($bul == "04"){
                    $ROM = 'IV';
                }elseif($bul == "05"){
                    $ROM = 'V';
                }elseif($bul == "06"){
                    $ROM = 'VI';
                }elseif($bul == "07"){
                    $ROM = 'VII';
                }elseif($bul == "08"){
                    $ROM = 'VIII';
                }elseif($bul == "09"){
                    $ROM = 'IX';
                }elseif($bul == "10"){
                    $ROM = 'X';
                }elseif($bul == "11"){
                    $ROM = 'XI';
                }elseif($bul == "12"){
                    $ROM = 'XII';
                }
                $layROMs = ["I", "II","III","IV","V","VI","VII","VIII", "IX", "X", "XI", 'XII'];
              ?>

              <select name="rom_layoff" id="">
              <?php
                foreach($layROMs as $layROM) :?>
                  <?php if($layROM == $ROM){ ?>
                    <option value="<?= $layROM?>" selected><?= $layROM?></option>
                  <?php }else{ ?>
                    <option value="<?= $layROM?>"><?= $layROM?></option>
                  <?php }     ?>  
                <?php endforeach;
              ?>
             
              </select>

              /{{ date('Y') }} <br>
              TENTANG<br>
              PEMUTUSAN HUBUNGAN KERJA
            
          </p>

          <table>
           
            <tr>
              <td valign="top">Membaca</td>
              <td valign="top">:</td>
              <td valign="top">
              <div>              
                <select class="form-control select2bs4 " name="alphabet_id" style="width-max: 100%;" id="pasal_phk">
                  <option value="" >Pilih PASAL </option>
                  @foreach($alphabets as $alphabet):
                    <?php  $print_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                    <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                    <option value="{{$alphabet->id}}" >PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} {{$alphabet->alphabet_sound}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->alphabet_sound}}</option>
                  @endforeach
                </select>
           
                <div id="isi_text" style="width:100%;">

                </div>
              </div>
              </td>
            </tr>
            <tr>
              <td valign="top">Menimbang</td>
              <td valign="top">:</td>
              <td valign="top">
              <textarea name="layoff_description" id="layoff_description" class="form-control" required></textarea>
              </td>
            </tr>
            <tr>
              <td valign="top">Mengingat</td>
              <td valign="top">:</td>
              <td valign="top">
                Undang-Undang No. 13 Tahun 2003 Tentang Ketenagakerjaan dan peraturan pelaksanaannya
              </td>
            </tr>

            <tr>
              <td class="text-center" colspan="3"> <u>MEMUTUSKAN</u></td>
            </tr>

            <tr>
              <td valign="top">Pertama</td>
              <td valign="top">:</td>
              <td valign="top">
                <table>
                  <tr>
                    <td colspan="5">
                      Melakukan Pemutusan Hubungan Kerja (PHK) terhadap :
                      <!-- <select class="form-control select2bs4 select2-hidden-accessible" name="employee_id" id="karyawan_phk" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                      </select> -->
                      <input class="form-control" type="text" name="phk_employee" id="cari_karyawan_phk" >
                    </td>
                    <td>
                      <br>
                      <!-- <span onClick="car_kar()" class="btn btn-primary">Cari</span> -->
                    </td>
                    <td>
                      <!-- &nbsp; &nbsp; <span id="output_cari_karyawan">Berhasil</span>  -->

                    </td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td id="nama_phk"> </td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    
                    <td>Bagian</td>
                    <td>:</td>
                    <td id="bagian_phk"></td>
                  </tr>

                  <tr>
                    <td>ID No.</td>
                    <td>:</td>
                    <td id="id_no_phk"> </td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    
                    <td>Departemen</td>
                    <td>:</td>
                    <td id="department_phk"></td>
                  </tr>
                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td id="job_phk"> </td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    
                    <td>Tanggal Masuk</td>
                    <td>:</td>
                    <td id="hire_date_phk"></td>
                  </tr>
                  <tr>
                    <td colspan="7">
                    Terhitung mulai, <input type="date" style="width: 100px;   border-radius: 1px; border: #555;" name="layoff_date_start" id="" required> 
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td valign="top">Kedua</td>
              <td valign="top">:</td>
              <td valign="top">
              Sejak dikeluarkan   Surat   Keputusan  ini  antara  Sdr. <small id="sml"> </small> dan PT. HWA SEUNG INDONESIA akan segera menyelesaikan hak dan kewajiban masing-masing.
              </td>
            </tr>
            <tr>
              <td valign="top">Ketiga</td>
              <td valign="top">:</td>
              <td valign="top">
                Keputusan ini berlaku sejak tanggal ditetapkan
              </td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
              <td valign="top"  colspan="3">Ditetapkan di : Jepara</td>
          
            </tr>
            <tr>
              <td valign="top" colspan="3">Pada Tanggal :  <input type="date" class="form" style="width: 100px;   border-radius: 1px; border:#555;" name="layoff_date" id="" required>  </td>
            </tr>
            <tr>
              <td valign="top" colspan="3">PT. HWA SEUNG INDONESIA</td>
            </tr>
            <tr>
              <td valign="top" colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top" colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top" colspan="3">
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
                        echo '<button class="btn btn-primary" id="button_php" type="submit" disabled>Simpan</button>';
                      }
                    }
                  }
              ?>

              <!-- <button class="btn btn-primary" type="submit">Simpan</button> -->
              
              </td>
            </tr>
   
            <tr>
              <td valign="top" colspan="3"> <u> Guntur Suhendro </u></td>
            </tr>
            <tr>
              <td valign="top" colspan="3">Department Head HRD</td>
            </tr>

          </form>
          </table>
        </div>
        <!-- /.card-body -->
   
      </div>
      <!-- /.card -->


    </div>


  </div>



</section>
<!-- /.content -->


</div>

@endsection