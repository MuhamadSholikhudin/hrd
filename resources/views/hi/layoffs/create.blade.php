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
              NO. 2/SK-PHK/HRD-HWI/IV/2022 <br>
              TENTANG<br>
              PEMUTUSAN HUBUNGAN KERJA
            
          </p>

          <table>
            <tr>
              <td valign="top">Membaca</td>
              <td valign="top">:</td>
              <td valign="top">
              <div>              
                <select class="form-control select2bs4 " style="width: 100%;" id="pasal_phk">
                  @foreach($alphabets as $alphabet):
                    <?php  $print_paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); ?>
                    <?php  $print_article  = DB::table('articles')->find($print_paragraph->article_id); ?>
                    <option value="{{$alphabet->id}}" >PASAL {{$print_article->article}} {{$print_paragraph->paragraph}} {{$alphabet->alphabet}} {{$alphabet->alphabet_sound}} / {{$print_paragraph->sub_chapters}} / {{$alphabet->description}}</option>
                  @endforeach
                </select>
              </div>
                Perjanjian Kerja Bersama Pasal 27. Jenis Pelanggaran dan Sanksi ayat (6) tentang Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon. I. Pengusaha dapat melakukan Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon, apabila melakukan kesalahan berat sebagai berikut : e. Terbukti menyerang, menganiaya, mengancam, atau mengintimidasi teman sekerja atau Pengusaha di lingkungan perusahaan.s
              </td>
            </tr>
            <tr>
              <td valign="top">Menimbang</td>
              <td valign="top">:</td>
              <td valign="top">
              <textarea name="" id="" class="form-control" required>Laporan Hasil Investigasi tanggal 4 April 2022</textarea>
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
                      <select class="form-control select2bs4 select2-hidden-accessible" id="karyawan_phk" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                        @foreach ($employees as $employee)
                          <?php $job =  DB::table('jobs')->find($employee->job_id) ?>
                          <?php $department =  DB::table('departments')->find($employee->department_id) ?>
                          <option value="{{ $employee->id }}" >{{ $employee->number_of_employees }} / {{ $employee->name }} / {{$job->job_level}} /  {{$department->department}} / {{$employee->hire_date}} </option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td id="nama_phk"> RINI ANITA</td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    
                    <td>Bagian</td>
                    <td>:</td>
                    <td id="bagian_phk">SABLON</td>
                  </tr>

                  <tr>
                    <td>ID No.</td>
                    <td>:</td>
                    <td id="id_no_phk"> 2203052344</td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    
                    <td>Departemen</td>
                    <td>:</td>
                    <td id="department_phk">Produksi</td>
                  </tr>
                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td id="job_phk"> OPERATOR</td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    
                    <td>Tanggal Masuk</td>
                    <td>:</td>
                    <td id="hire_date_phk">18 Maret 2022</td>
                  </tr>
                  <tr>
                    <td colspan="7">
                    Terhitung mulai, <input type="date" style="width: 100px;   border-radius: 1px; border: #555;" name="" id="" required> 
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
              <td valign="top" colspan="3">Pada Tanggal :  <input type="date" class="form" style="width: 100px;   border-radius: 1px; border:#555;" name="" id="" required>  </td>
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
              <td valign="top" colspan="3"> <u> Guntur Suhendro </u></td>
            </tr>
            <tr>
              <td valign="top" colspan="3">Department Head HRD</td>
            </tr>


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