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
        <a href="/hi/layoffs/" class="btn  btn-secondary">Kembali</a>
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
        <!-- /.card-header -->
        <div class="card-body">
          <p class="text-center">
            <u>
              SURAT KEPUTUSAN
              
            </u>
            <br>
              <?php 
              $num_latest = DB::table('layoffs')
                // ->whereMonth('created_at', Carbon::now()->month) 
                ->whereMonth('layoff_date', '04') 
                ->count(); 

                if($num_latest < 1){
                  $no_lf = 1;
              }elseif($num_latest > 0){
                  $latest = DB::table('layoffs')
                      ->latest()
                      ->first();
                  $nono_lf_sp = $latest->no_layoff + 1;
              }
              echo $num_latest;
              ?>

              NO. {{$no_lf}}/SK-PHK/HRD-HWI/IV/{{ date('Y') }} <br>
              TENTANG<br>
              PEMUTUSAN HUBUNGAN KERJA
            
          </p>

          <table>
            <form action="/hi/layoffs/" method="POST" enctype="multipart/form-data">
              @csrf
            <tr>
              <td valign="top">Membaca</td>
              <td valign="top">:</td>
              <td valign="top">
              <div>              
                <select class="form-control select2bs4 " name="alphabet_id" style="width: 100%;" id="pasal_phk">
                  <option value="" >Pilih PASAL </option>
                  
                  @foreach($alphabets as $alphabet):
                    <?php  $print_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                    <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                    <option value="{{$alphabet->id}}" >PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} {{$alphabet->alphabet_sound}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->description}}</option>
                  @endforeach
                </select>
                {{--                 Perjanjian Kerja Bersama Pasal 27. Jenis Pelanggaran dan Sanksi ayat (6) tentang Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon. I. Pengusaha dapat melakukan Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon, apabila melakukan kesalahan berat sebagai berikut : e. Terbukti menyerang, menganiaya, mengancam, atau mengintimidasi teman sekerja atau Pengusaha di lingkungan perusahaan.s
                --}} 
                <p id="isi_text">

                </p>
              </div>
              </td>
            </tr>
            <tr>
              <td valign="top">Menimbang</td>
              <td valign="top">:</td>
              <td valign="top">
              <textarea name="layoff_description" id="" class="form-control" required>Laporan Hasil Investigasi tanggal 4 April 2022</textarea>
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
                    <td colspan="7">
                      Melakukan Pemutusan Hubungan Kerja (PHK) terhadap :
                      <select class="form-control select2bs4 select2-hidden-accessible" name="employee_id" id="karyawan_phk" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                          
                      </select>
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
              <td valign="top" colspan="3"><button class="btn btn-primary" type="submit">Save</button></td>
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