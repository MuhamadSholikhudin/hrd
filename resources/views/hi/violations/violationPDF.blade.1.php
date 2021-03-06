
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title>Cetak Laporan Surat</title> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        hr.new5 {
            border: 2px solid black;
            border-radius: 0px;
            width: 100%;
        }
    </style>
</head>

<body>
@foreach($violations as $violation)
    <section class="content">
        <div class="container-fluid">

            <div class="card border-0 p-0">
                <div class="header p-4">
                    <div class="row">
                        <div class="col-md-2">
                            <!-- echo asset('storage/file.txt'); -->
                            <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTh3za7Bz3_6dogu-wy4ogEh2GX3JNR1QuIVw&usqp=CAU" alt="" width="100%" height="80px"> -->
                            <img src="{{ public_path('storage/') . '/img/HWASEUNG.png' }}" alt="" width="100px" height="80px">
                        </div>
                        <div class="col-md-10">
                            <h3 class="text-center">PT. HWA SEUNG INDONESIA</h3>
                            <h5 class="text-center">Jalan Krasak Banyuputih RT.09 RW.03 Kecamatan Kalinyamatan Kabupaten Jepara,</h5>
                            <h5 class="text-center">Provinsi Jawa Tengah, Indonesia 59467 Tel: (0291) 7512198 Fax: (0291) 7512191</h5>
                        </div>
                        <br>
                        <hr class="new5">
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
                            }
                        ?>
                    <h5 class="text-center "> NO:{{ $p_no_s}} /SP-HRD/{{ $violation->violation_ROM}}/{{date_format($date_violation_sp, "Y")}}      
                        </h5>
                    <br>
                    <div class="col-sm-12 lead">Kepada karyawan tersebut di bawah ini :</div>
                    <br>
                    <div class="col-sm-12 lead">
                        <table>
                                <?php
                                $employee = DB::table('employees')->find($violation->employee_id);
                            ?>

                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </td>
                                <td>Nama</td>
                                <td>: {{ $employee->name}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>NIK</td>
                                <td>:{{ $employee->number_of_employees}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>Jabatan</td>
                                <td>: {{ $violation->job_level}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>Bagian</td>
                                <td>: {{ $violation->department}}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="col-sm-12 lead">Dengan ini diberikan, {{ $violation->type_of_violation}}</div>
                    <br>
                    <div class="col-sm-12 lead" style="text-align: justify;">Sehubungan yang bersangkutan telah melakukan pelanggaran peraturan/tata tertib/disiplin kerja yang
                        berlaku di perusahaan. :</div>
                        <br>
                    <div class="col-sm-12 lead">Pasal yang dilanggar :</div>
                    
                    <?php 
                        $sel_alphabet = DB::table('alphabets')->find($violation->alphabet_id);
                        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
                        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
                    ?>
                    @if($violation->alphabet_accumulation != null)
                        <!-- violation accumulation here -->
                        <?php
                            $sel_alphabet_accumulation = DB::table('alphabets')->find($violation->alphabet_accumulation);
                            $sel_paragraph_accumulation = DB::table('paragraphs')->find($sel_alphabet_accumulation->paragraph_id);
                            $sel_article_accumulation = DB::table('articles')->find($sel_paragraph_accumulation->article_id);
                        ?>

                            <!-- PASAL AKUMULASI -->
                        <div class="col-sm-12 lead" style="text-align: justify;">Perjanjian Kerja Bersama Pasal  {{$sel_article_accumulation->article}} ayat   {{$sel_paragraph_accumulation->paragraph}}  huruf {{$sel_alphabet_accumulation->alphabet}}  {{$sel_alphabet_accumulation->alphabet_sound}}</div>
                    
                    @else
                              <!-- Pasal Tanpa Akumulasi -->
                        <div class="col-sm-12 lead" style="text-align: justify;">Perjanjian Kerja Bersama Pasal {{$sel_article->article}} ayat ({{$sel_paragraph->paragraph}}) huruf "{{$sel_alphabet->alphabet}}" {{$sel_alphabet->alphabet_sound}}.</div>
                    
                    @endif
              
                    <br>
                    <div class="col-sm-12 lead">Keterangan lain :</div>
                    @if($violation->alphabet_accumulation != null)
                            
                        <!-- DELIK SEKARANG -->
                        <div class="col-sm-12 lead" style="text-align: justify;">- {{ $violation->other_information}}</div>



                        <!-- PASAL SEKARANG, BUNYI PASAL -->
                        <div class="col-sm-12 lead" style="text-align: justify;">- Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  {{$sel_alphabet->alphabet_sound}}</div>
                        
                        <!-- PASAL LALU, DELIK PELANGGARAN LALU -->
                        <?php 
                            $pelanggran_lalu = DB::table('violations')->find($violation->violation_accumulation);

                            $sel_alphabet_lalu = DB::table('alphabets')->find($pelanggran_lalu->alphabet_id);
                            $sel_paragraph_lalu = DB::table('paragraphs')->find($sel_alphabet_lalu->paragraph_id);
                            $sel_article_lalu = DB::table('articles')->find($sel_paragraph_lalu->article_id);
                        ?>
                        <div class="col-sm-12 lead" style="text-align: justify;">- Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal  {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}", {{$pelanggran_lalu->other_information}}</div>

                    @else
                            <!-- Remainder Tanpa Akumulasi -->
                        <div class="col-sm-12 lead" style="text-align: justify;">- {{ $violation->other_information}}</div>
                    @endif
                    
                    <br>
                    <br>
                    <div class="col-sm-12 lead" style="text-align: justify;">Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan
                        perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran )
                        maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.</div>
                       


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
                                    <h6 class="text-center">&nbsp;</h6>
                                    <h6 class="text-center">Penerima Sanksi,</h6>
                                </div>
                                <div>
                                    <br>
                                    <div class="justify-content-center">
                                   
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div>
                                    <h6 class="text-center">
                                        <b>
                                            {{-- GUNTUR SUHENDRO --}}
                                            {{ $employee->name}}
                                        </b>
                                    </h6>
                                
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
                                 
                                    <h6 class="text-center">Jepara, {{ $date_day_sp. " ". $month_indo_sp . " ". $date_year_sp }} </h6>
                                    {{-- <h6 class="text-center">Jepara, 5 April 2022 </h6> --}}
                                    <h6 class="text-center">Human Resources Development</h6>
                                </div>
                                <div>
                                    <br>
                                    <div class="justify-content-center">
                                    
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div>
                                    <h6 class="text-center">
                                        <b>
                                            GUNTUR SUHENDRO
                                        </b>
                                    </h6>
                                
                                </div>


                            </div>
                        </div>
                        </form>

                    </div>

                </div>
    </section>
    @endforeach

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

<!-- <script>
    window.print()
</script> -->


  
</html>
