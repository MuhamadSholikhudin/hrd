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
                            }else{
                                $p_no_s = $violation->no_violation;
                            }
                        ?>
                    <h5 class="text-center "> NO:{{ $p_no_s}} /SP-HRD/{{ $violation->violation_ROM}}/{{date_format($date_violation_sp, "Y")}}      
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
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;{{ $violation->job_level}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                                <td>Bagian/ Department</td>
                                <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;{{ $violation->department}}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="col-sm-12 lead">Dengan ini diberikan, <b><u>{{ $violation->type_of_violation}}</u></b> </div>
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
                            <div class="col-sm-12 lead" style="text-align: justify;">Perjanjian Kerja Bersama Pasal  
                            {{$sel_article_accumulation->article}} ayat ({{$sel_paragraph_accumulation->paragraph}})  huruf "{{$sel_alphabet_accumulation->alphabet}}"  {{$sel_alphabet_accumulation->alphabet_sound}}</div>
                        
                    @else
                    
                              <!-- Pasal Tanpa Akumulasi -->
                        <div class="col-sm-12 lead" style="text-align: justify;">Perjanjian Kerja Bersama Pasal 
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
                                        <td valign="top" class="lead" style="text-align: justify;">{{ $violation->other_information}}</td>
                                    </tr>

                                    <tr>
                                        <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                        <td valign="top" class="lead" style="text-align: justify;">Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  
                                            <!-- {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"   -->
                                            {{ pasal($violation->alphabet_id);}}
                                            {{$sel_alphabet->alphabet_sound}}</td>
                                    </tr>

                                    <tr>
                                        <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                        <td valign="top" class="lead" style="text-align: justify;">
                                        
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
                                    <td valign="top" class="lead" style="text-align: justify;">Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  
                                        <!-- {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  -->
                                        {{ pasal($violation->alphabet_id);}} 
                                        
                                        {{$sel_alphabet->alphabet_sound}}</td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;&nbsp;&nbsp;-</td>
                                    <td valign="top" class="lead" style="text-align: justify;"></td>
                                    
                    
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
                                    <td valign="top" class="lead" style="text-align: justify;">{{ $violation->other_information}}</td>
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
                                            Jepara, {{ $date_day_sp. " ". $month_indo_sp . " ". $date_year_sp }} <br>
                                            Human Resources Development
                                        </p>

                                     <h6 class="text-center">Jepara, 5 April 2022 </h6> 
                                    <h6 class="text-center">Human Resources Development</h6> --}}
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
                                            </u>
                                        </b>
                                    </p>
                                    
                                
                                </div>


                            </div>
                        </div>
                        </form>

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