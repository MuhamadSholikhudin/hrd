<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous">

    <style>
        hr.new5 {
            border: 3px solid black;
            border-radius: 5px;
            width: 100%;
        }

        .txt {
            font-size: 22px;
            font-family: "Times New Roman";
        }
        .txts {
            font-size: 23px;
            font-family: "Times New Roman";
        }
        .txt2 {
            font-size: 25px;
            font-family: "Times New Roman";
        }
        .txt3 {
            font-size: 27px;
            font-family: "Times New Roman";
        }
        .txt4 {
            font-size: 17px;
            font-family: "Times New Roman";
        }

        .tdh {
            height: 2px;
        }
    </style>
</head>

<body>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <div id="div1">
                    <h2>Let jQuery AJAX Change This Text</h2>
                </div>
                <button>Get External Content</button> -->
            </div>
            <div class="card  border-0">
                <div class="header p-3">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{asset('img/HWASEUNG.PNG')}}" alt="" width="100%" height="80px">
                        </div>
                        <div class="col-md-10">
                            <h3 class="text-center" style=" font-size: 24px; font-family: 'Times New Roman';  font-weight: bold;">PT. HWA SEUNG INDONESIA</h3>
                            <h5 class="text-center" style=" font-size: 22px; font-family: 'Times New Roman'; font-weight: bold;">Jalan Krasak Banyuputih RT.09 RW.03 Kecamatan Kalinyamatan Kabupaten Jepara,</h5>
                            <h5 class="text-center" style=" font-size: 22px; font-family: 'Times New Roman'; font-weight: bold;">Provinsi Jawa Tengah, Indonesia 59467 Tel: (0291) 7512198 Fax: (0291) 7512191</h5>
                            <!-- <h3 class="text-center">USAHA KECIL DAN MENENGAH</h3> -->
                            <!-- <h5 class="text-center">Provinsi Jawa Tengah, Indonesia 59467  Tel: (0291) 7512198 Fax: (0291) 7512191</h5> -->
                            <!-- <h3 class="text-center">KUDUS 59322</h3> -->
                        </div>
                        <br>
                        <hr class="new5">
                    </div>

                </div>
                <div class="body">
     
                    <h3 class="text-center txts" style="margin-bottom: 12px;">
                        <b>
                            <u>SURAT KEPUTUSAN</u>
                        </b>
                    </h3>
                    <?php 
                      $d_l = new \DateTime($layoff->layoff_date .' 00:00:00');
                      $year = date_format($d_l, "Y"); //for Display Year
                    ?>
 
                    <h5 class="text-center txts" > NO:{{ $layoff->no_layoff .'/SK-PHK/HRD-HWI/'.$layoff->rom_layoff.'/'. $year   }}
                    </h5>
                    <h5 class="text-center txts" >
                        TENTANG
                    </h5>
                    <h5 class="text-center txts" >
                        PEMUTUSAN HUBUNGAN KERJA
                    </h5>
                    <br>
                    <table>
                         <tr>
                            <td class="txt" valign="top">Membaca</td>
                            <td class="txt" valign="top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td class="txt" valign="top">
                                <div>              
                                    <div id="isi_text" style="width:100%; text-align:justify;">
                                        <?php 

                                        if($layoff->read <> NULL){
                                            $pasal = $layoff->read;
                                        }elseif($layoff->read == ""){
                                            if($layoff->alphabet){

                                            }
                                            $sel_alphabet = DB::table('alphabets')->find($layoff->alphabet_id);
                                            $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
                                            $sel_article = DB::table('articles')->find($sel_paragraph->article_id);

                                            $kecil = strtolower($sel_article->chapters);
                                            $chapters = ucwords($kecil);
                                            $pasal = 'Perjanjian Kerja Bersama Pasal '.$sel_article->article.' '.
                                            $chapters .'. ayat ('.$sel_paragraph->paragraph.') tentang '
                                            .$sel_paragraph->description .' ' 
                                            . $sel_alphabet->alphabet.' .'
                                            .$sel_alphabet->alphabet_sound.'';
                                        }else{
                                            $sel_alphabet = DB::table('alphabets')->find($layoff->alphabet_id);
                                            $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
                                            $sel_article = DB::table('articles')->find($sel_paragraph->article_id);

                                            $kecil = strtolower($sel_article->chapters);
                                            $chapters = ucwords($kecil);
                                            $pasal = 'Perjanjian Kerja Bersama Pasal '.$sel_article->article.' '.
                                            $chapters .'. ayat ('.$sel_paragraph->paragraph.') tentang '
                                            .$sel_paragraph->description .' ' 
                                            . $sel_alphabet->alphabet.' .'
                                            .$sel_alphabet->alphabet_sound.'';
                                        }
                                        ?>                                        
                                        {{$pasal}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="txt" colspan="3">&nbsp;</td>
                        </tr> -->
                        <tr>
                            <td class="txt" class="txt" valign="top">Menimbang</td>
                            <td class="txt" valign="top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td class="txt" valign="top" style="text-align:justify;">
                                {{ $layoff->layoff_description }}
                            </td>
                        </tr>
                    
                        <!-- <tr>
                            <td class="txt" colspan="3">&nbsp;</td>
                        </tr> -->
                        <tr>
                            <td class="txt" valign="top">Mengingat</td>
                            <td class="txt" valign="top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td class="txt" valign="top">
                                Undang-Undang No. 13 Tahun 2003 Tentang Ketenagakerjaan dan peraturan pelaksanaannya
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="txt" colspan="3">&nbsp;</td>
                        </tr> -->

                        <tr>
                            <td  class="text-center txt" colspan="3">
                            <br>
                            <b> <u><h4>MEMUTUSKAN</h4></u></b>
                            <br>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="tdh" colspan="3">&nbsp;</td>
                        </tr> -->

                        <tr>
                            <td class="txt" valign="top">Pertama</td>
                            <td class="txt" valign="top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td class="txt" valign="top">
                                <?php 
                                    $employee = DB::table('employees')
                                        ->find($layoff->employee_id);

                                ?>
                                <table>
                                    <tr>
                                        <td class="txt" colspan="7">
                                            Melakukan Pemutusan Hubungan Kerja (PHK) terhadap : 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="txt">Nama</td>
                                        <td class="txt">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                        <td class="txt" id="nama_phk"> {{$employee->name}} </td>

                                        <td class="txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        
                                        <td class="txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Bagian</td>
                                        <td class="txt">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                        <td class="txt" id="bagian_phk"> {{$employee->bagian}}</td>
                                    </tr>

                                    <tr>
                                        <td class="txt">ID No.</td>
                                        <td class="txt">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                        <td class="txt" id="id_no_phk"> {{$employee->number_of_employees}} </td>

                                        <td class="txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        
                                        <td class="txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Departemen</td>
                                        <td class="txt">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                        <td class="txt" id="department_phk">
                                            <?php 
                                                $department = DB::table('departments')->find($employee->department_id);
                                            ?>
                                             {{$department->department}}
                                            
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="txt">Jabatan</td>
                                        <td class="txt">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                        <td class="txt" id="job_phk">
                                            <?php 
                                                $job = DB::table('jobs')->find($employee->job_id);
                                            ?>
                                             {{$job->job_level}} 
                                            </td>

                                        <td class="txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        
                                        <td class="txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Tanggal Masuk</td>
                                        <td class="txt">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                        <td class="txt" id="hire_date_phk">  
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
                                            function tanggal($tanggal){
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

                                                echo $day_indo_hire. ", ". $date_day_hire. " ". $month_indo_hire . " ". $date_year_hire;
                                            }
                                            ?>  
                                            

                                        {{tanggal_masuk($employee->hire_date)}}
                                                                                 
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="txt" colspan="7">
                                        Terhitung mulai, 
                                            {{ tanggal($layoff->layoff_date_start) }}  
                                        </td>
                                    </tr>
                                </table>
 
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="tdh" colspan="3">&nbsp;</td>
                        </tr> -->
                       
                        <tr>
                            <td class="txt"  valign="top">Kedua</td>
                            <td class="txt" valign="top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td class="txt" valign="top">
                            Sejak dikeluarkan   Surat   Keputusan  ini  antara  Sdr. <small class="txt" id="sml">{{$employee->name}} </small> dan PT. HWA SEUNG INDONESIA akan segera menyelesaikan hak dan kewajiban masing-masing.
                            </td>
                        </tr>
                       
                        <!-- <tr>
                            <td class="tdh" colspan="3">&nbsp;</td>
                        </tr> -->
                        
                        <tr>
                            <td class="txt" valign="top">Ketiga</td>
                            <td class="txt" valign="top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td class="txt" valign="top">
                                Keputusan ini berlaku sejak tanggal ditetapkan
                            </td>
                        </tr>
                    
                        
                        <!-- <tr>
                            <td class="tdh" colspan="3">&nbsp;</td>
                        </tr> -->
                        <tr>
                            <td class="tdh" colspan="3">&nbsp;</td>
                        </tr>
                        

                        <tr>
                            <td class="txt" valign="top"  colspan="3">Ditetapkan di : Jepara</td>

                        </tr>
                        <tr>
                            <td class="txt" valign="top" colspan="3">Pada Tanggal :  
                                 {{tanggal($layoff->layoff_date)}}   
                            </td>
                        </tr>
                        <tr>
                            <td class="txt" valign="top" colspan="3">PT. HWA SEUNG INDONESIA</td>
                        </tr>
                        <tr>
                            <td class="txt" valign="top" colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="txt" valign="top" colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="txt" valign="top" colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="txt" valign="top" colspan="3"></td>
                        </tr>

                        <tr>
                            <td class="txt" valign="top" colspan="3"> <u> Guntur Suhendro </u></td>
                            </tr>
                            <tr>
                            <td class="txt" valign="top" colspan="3">Department Head HRD</td>
                        </tr>


                    </table>




                    </div>

                </div>
    </section>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

<script>
    window.print()
</script>

</html>