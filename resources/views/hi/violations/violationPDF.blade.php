<!DOCTYPE html>
<html>
    <head>
    <style>
        .pageA4{
            height: 1010px;
            margin:0%;
        }

        h4 {
            margin: 0 0 10px 0;
        }
        h1 {
            text-align: center;
        }
        body {
            font-family: sans-serif;
            font-family: 'Calibri';
        }        
        .fontcalibri{
            font-family: "DejaVuSans";
        } */

    </style>
    </head>
    <body>
        @foreach($violations as $violation)
            <div class="pageA4">
                <table width="100%">
                    <tr>
                        <td width="12" align="center">
                            <img src="{{ public_path('storage/') . '/img/HWASEUNG.png' }}" width="80%" height="60px" style="z-index: -1;">
                        </td>
                        <td width="88" align="center">
                            <h4 class="text-center">
                                PT. HWA SEUNG INDONESIA
                            </h4>
                            <b>
                                Jalan Krasak Banyuputih RT.09 RW.03 Kecamatan Kalinyamatan Kabupaten Jepara, <br>
                                Provinsi Jawa Tengah, Indonesia 59467 Tel: (0291) 7512198 Fax: (0291) 7512191
                            </b>
                        </td>
                    </tr>
                </table>
                <hr class="new5">
                
                <h3 class="text-center fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: center; center; margin-bottom: 0%;">
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
                <h5 class="text-center fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: center; margin-top: 0%; "> 
                    NO:{{ $p_no_s}} /SP-HRD/{{ $violation->violation_ROM}}/{{date_format($date_violation_sp, "Y")}}      
                </h5>

                <div class="col-sm-12 fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px;" >Kepada karyawan tersebut di bawah ini :</div>
                <br>
                <table style="font-family: 'Calibri', sans-serif; font-size: 14px;">
                    <?php
                        $employee = DB::table('employees')->find($violation->employee_id);
                    ?>
                    <tr>
                        <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </td>
                        <td>Nama &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </td>
                        <td>:&nbsp;{{ $employee->name}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                        <td>NIK</td>
                        <td>:&nbsp;{{ $employee->number_of_employees}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                        <td>Jabatan</td>
                        <td>:&nbsp;{{ $violation->job_level}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
                        <td>Bagian</td>
                        <td>:&nbsp;{{ $violation->department}}</td>
                    </tr>
                </table>
                <br>
                <div class="col-sm-12 fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px;">Dengan ini diberikan, <b> <u>{{ $violation->type_of_violation}}</u></b></div>
                <br>
                <div class="col-sm-12 lead fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify; ">
                    Sehubungan yang bersangkutan telah melakukan pelanggaran peraturan/tata tertib/disiplin kerja yang
                    berlaku di perusahaan. :
                </div>
                <br>
                
                <div class="col-sm-12 lead fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px;"><b>Pasal yang dilanggar :</b></div>

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
                        <div class="col-sm-12 lead fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">Perjanjian Kerja Bersama Pasal  
                        {{$sel_article_accumulation->article}} ayat ({{$sel_paragraph_accumulation->paragraph}})  huruf "{{$sel_alphabet_accumulation->alphabet}}"  {{$sel_alphabet_accumulation->alphabet_sound}}</div>
                    
                @else
                
                            <!-- Pasal Tanpa Akumulasi -->
                    <div class="col-sm-12 lead fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">Perjanjian Kerja Bersama Pasal 
                    {{$sel_article->article}} ayat ({{$sel_paragraph->paragraph}}) huruf "{{$sel_alphabet->alphabet}}" {{$sel_alphabet->alphabet_sound}}.</div>
                @endif
                <br>

                <div class="col-sm-12 lead fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px;"><b>Keterangan lain :</b></div>
                    <!-- // Jika memiliki alphabet_accumulation pada sp sekaranng -->
                    @if($violation->alphabet_accumulation != null)

                        <!-- // Jika memiliki alphabet accumulation tetapi tidak memiliki violation_accumulation -->
                        @if($violation->violation_accumulation != null)
                            <!-- PASAL SEKARANG, BUNYI PASAL -->
                            <!-- <div class="col-sm-12 lead" style="text-align: justify;">- Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  {{$sel_alphabet->alphabet_sound}}</div> -->
                            
                            <!-- PASAL LALU, DELIK PELANGGARAN LALU -->
                            <?php 
                                // Mencari pelanggaran yang lalu
                                $pelanggran_lalu = DB::table('violations')->find($violation->violation_accumulation);

                                $sel_alphabet_lalu = DB::table('alphabets')->find($pelanggran_lalu->alphabet_id);
                                $sel_paragraph_lalu = DB::table('paragraphs')->find($sel_alphabet_lalu->paragraph_id);
                                $sel_article_lalu = DB::table('articles')->find($sel_paragraph_lalu->article_id);
                            ?>
                            <!-- <div class="col-sm-12 lead" style="text-align: justify;">- Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal  {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}", {{$pelanggran_lalu->other_information}}</div> -->
                            
                            <table class="fontcalibri" >
                                <tbody>
                                    <tr>
                                        <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                        <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">{{ $violation->other_information}}</td>
                                    </tr>

                                    <tr>
                                        <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                        <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  
                                            <!-- {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"   -->
                                            {{ pasal($violation->alphabet_id);}}
                                            {{$sel_alphabet->alphabet_sound}}</td>
                                    </tr>

                                    <tr>
                                        <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                        <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">
                                        
                                            <?php 
                                                // Jika pelanggaran sebelumnya akumulasi => pasal_akumulasi, 
                                                if($violation->violation_accumulation3 !== NULL){
                                                    $pelanggran_lalu2 = DB::table('violations')->find($violation->violation_accumulation2);

                                                    // jika pelanggaran sebelumnya sama dengan peringatan lisan
                                                    if($pelanggran_lalu->type_of_violation == "Peringatan Lisan"){

                                                        //Mencari pelanggaran sebelumnya jika tidak sp lisan
                                                        $num_pasal_sebelum_sp_lisan = DB::table('violations')
                                                            ->where('employee_id', $violation->employee_id)
                                                            ->where('type_of_violation','!=', 'Peringatan Lisan')
                                                            ->where('id','<', $pelanggran_lalu->id)
                                                            ->where('date_end_violation','>=', $violation->reporting_date)
                                                            ->count();
                                                        
                                                        // Jika ada pelanggaran sebelumnya jika tidak sp lisan
                                                        if($num_pasal_sebelum_sp_lisan > 0){

                                                            $cari_pasal_sebelum_sp_lisan = DB::table('violations')
                                                                ->where('employee_id', $violation->employee_id)
                                                                ->where('type_of_violation','!=', 'Peringatan Lisan')
                                                                ->where('id','<', $pelanggran_lalu->id)
                                                                ->where('date_end_violation','>=', $violation->reporting_date)
                                                                ->orderBy('date_end_violation', 'desc')
                                                                ->first();
                                                            
                                                            $num_pasal_sebelum_sp_lisan2 = DB::table('violations')
                                                                ->where('employee_id', $violation->employee_id)
                                                                ->where('id','<', $cari_pasal_sebelum_sp_lisan->id)
                                                                ->where('date_end_violation','>=', $violation->reporting_date)                                                        
                                                                ->count();

                                                        ?>
                                                                Dalam masa {{$cari_pasal_sebelum_sp_lisan->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                            <?php
                                                            if($cari_pasal_sebelum_sp_lisan->alphabet_accumulation !== NULL){ ?>

                                                                {{ pasal($cari_pasal_sebelum_sp_lisan->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                            <?php
                                                            } ?>
                                                            {{ pasal($cari_pasal_sebelum_sp_lisan->alphabet_id);}} 
                                                            {{$cari_pasal_sebelum_sp_lisan->other_information}}

                                                                <?php
                                                                if($num_pasal_sebelum_sp_lisan2 > 0){
                                                                    $cari_pasal_sebelum_sp_lisan2 = DB::table('violations')
                                                                    ->where('employee_id', $violation->employee_id)
                                                                    ->where('id','<', $cari_pasal_sebelum_sp_lisan->id)
                                                                    ->where('date_end_violation','>=', $violation->reporting_date)
                                                                    ->orderBy('date_end_violation', 'desc')
                                                                    ->first();
                                                                ?>
                                                                    {{$cari_pasal_sebelum_sp_lisan2->other_information}}
                                                                <?php
                                                                }else{
                                                                ?>
                                                                    {{$pelanggran_lalu2->other_information}}
                                                                <?php
                                                                }
                                                                ?>                                                           
                                                            
                                                        <?php
                                                        }else{ ?>
                                                            Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                            {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                            {{$pelanggran_lalu->other_information}}
                                                            {{$pelanggran_lalu2->other_information}}                                                            
                                                        <?php
                                                        }
                                                    }else{ ?>
                                                        Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 

                                                        <?php 
                                                            // jika pelanggaran pelanggaran yang lalu ada pasal yang akumulasi
                                                            if($pelanggran_lalu->alphabet_accumulation != NULL){ ?>
                                                                {{ pasal($pelanggran_lalu->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                        <?php } ?>
                                                        {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}", 
                                                        {{$pelanggran_lalu->other_information}} 
                                                        {{$pelanggran_lalu2->other_information}}
                                                       
                                                    <?php
                                                    }

                                                    ?>                                                  

                                                     </td>                                                 
                                                <?php 

                                                }elseif($violation->violation_accumulation2 !== NULL){
                                                    $pelanggran_lalu2 = DB::table('violations')->find($violation->violation_accumulation2);
                                                    ?>                                                   
                                                    <?php
                                                        // Jika pelanggaran sebelumnya tidak memiliki pasal akumulasi 
                                                        if($pelanggran_lalu->alphabet_accumulation != NULL){ ?>
                                                            Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                            {{ pasal($pelanggran_lalu->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                            {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                            {{$pelanggran_lalu->other_information}}
                                                    <?php 
                                                        }else{
                                                            // jika pelanggaran sebelumnya sama dengan peringatan lisan
                                                            if($pelanggran_lalu->type_of_violation == "Peringatan Lisan"){

                                                                //Mencari pelanggaran sebelumnya jika tidak sp lisan
                                                                $num_pasal_sebelum_sp_lisan = DB::table('violations')
                                                                    ->where('employee_id', $violation->employee_id)
                                                                    ->where('type_of_violation','!=', 'Peringatan Lisan')
                                                                    ->where('id','<', $pelanggran_lalu->id)
                                                                    ->where('date_end_violation','>=', $violation->reporting_date)
                                                                    ->count();
                                                                
                                                                // Jika ada pelanggaran sebelumnya jika tidak sp lisan
                                                                if($num_pasal_sebelum_sp_lisan > 0){

                                                                    $cari_pasal_sebelum_sp_lisan = DB::table('violations')
                                                                        ->where('employee_id', $violation->employee_id)
                                                                        ->where('type_of_violation','!=', 'Peringatan Lisan')
                                                                        ->where('id','<', $pelanggran_lalu->id)
                                                                        ->where('date_end_violation','>=', $violation->reporting_date)
                                                                        ->orderBy('date_end_violation', 'desc')
                                                                        ->first();
                                                                ?>
                                                                        Dalam masa {{$cari_pasal_sebelum_sp_lisan->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                                    <?php
                                                                    if($cari_pasal_sebelum_sp_lisan->alphabet_accumulation !== NULL){ ?>

                                                                        {{ pasal($cari_pasal_sebelum_sp_lisan->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                                    <?php
                                                                    } ?>
                                                                    {{ pasal($cari_pasal_sebelum_sp_lisan->alphabet_id);}} 
                                                                    {{$cari_pasal_sebelum_sp_lisan->other_information}}
                                                                <?php
                                                                }else{ ?>
                                                                    Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                                    {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                                    {{$pelanggran_lalu->other_information}}
                                                                <?php
                                                                }
                                                            }else{ ?>
                                                                Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal 
                                                                {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                                {{$pelanggran_lalu->other_information}}
                                                            <?php
                                                            }
                                                            

                                                        } 
                                                        ?>

                                                        </td>                                                    
                                                
                                            <?php 
                                                // Jika pelanggaran sekarang berakumulasi dengan pelanggaran sebelumnya, 
                                                }elseif($violation->violation_accumulation !== NULL){  ?>
                                                    <?php
                                                        // Jika pelanggaran sebelumnya tidak memiliki pasal akumulasi 
                                                        if($pelanggran_lalu->alphabet_accumulation != NULL){ ?>
                                                            Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal
                                                            {{ pasal($pelanggran_lalu->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                            {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                            {{$pelanggran_lalu->other_information}}
                                                    <?php 
                                                        }else{
                                                            // jika pelanggaran sebelumnya sama dengan peringatan lisan
                                                            if($pelanggran_lalu->type_of_violation == "Peringatan Lisan"){

                                                                //Mencari pelanggaran sebelumnya jika tidak sp lisan
                                                                $num_pasal_sebelum_sp_lisan = DB::table('violations')
                                                                    ->where('employee_id', $violation->employee_id)
                                                                    ->where('type_of_violation','!=', 'Peringatan Lisan')
                                                                    ->where('id','<', $pelanggran_lalu->id)
                                                                    ->where('date_end_violation','>=', $violation->reporting_date)
                                                                    ->count();
                                                                
                                                                // Jika ada pelanggaran sebelumnya jika tidak sp lisan
                                                                if($num_pasal_sebelum_sp_lisan > 0){

                                                                    $cari_pasal_sebelum_sp_lisan = DB::table('violations')
                                                                        ->where('employee_id', $violation->employee_id)
                                                                        ->where('type_of_violation','!=', 'Peringatan Lisan')
                                                                        ->where('id','<', $pelanggran_lalu->id)
                                                                        ->where('date_end_violation','>=', $violation->reporting_date)
                                                                        ->orderBy('date_end_violation', 'desc')
                                                                        ->first();
                                                                ?>
                                                                    Dalam masa {{$cari_pasal_sebelum_sp_lisan->type_of_violation}}  Perjanjian Kerja Bersama Pasal
                                                                <?php                                                                    
                                                                    if($cari_pasal_sebelum_sp_lisan->alphabet_accumulation !== NULL){ ?>
                                                                        {{ pasal($cari_pasal_sebelum_sp_lisan->alphabet_accumulation); }}  Perjanjian Kerja Bersama Pasal
                                                                    <?php
                                                                    } ?>
                                                                    {{ pasal($cari_pasal_sebelum_sp_lisan->alphabet_id);}} 
                                                                    {{$cari_pasal_sebelum_sp_lisan->other_information}}
                                                                <?php
                                                                }else{ ?>
                                                                    Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal
                                                                    {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                                    {{$pelanggran_lalu->other_information}}
                                                                <?php
                                                                }

                                                            }else{ ?>
                                                                Dalam masa {{$pelanggran_lalu->type_of_violation}}  Perjanjian Kerja Bersama Pasal
                                                                {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                                {{$pelanggran_lalu->other_information}}
                                                            <?php
                                                            }
                                                            
                                                        
                                                    } ?>
                                                    <!-- {{$sel_article_lalu->article}}  ayat {{$sel_paragraph_lalu->paragraph}} huruf "{{$sel_alphabet_lalu->alphabet}}",  -->
                                                    <!-- {{ pasal($pelanggran_lalu->alphabet_id);}} 
                                                    {{$pelanggran_lalu->other_information}} -->

                                                        </td>                                                       
                                                <?php 

                                                }else{
                                                    
                                                }
                                            ?>
                                    </tr>
                                </tbody>
                            </table>

                        <!-- // Jika memiliki alphabet accumulation tetapi dan memiliki violation_accumulation -->
                        @else

                        <!-- PASAL SEKARANG, BUNYI PASAL -->
                        <!-- <div class="col-sm-12 lead" style="text-align: justify;">- Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  {{$sel_alphabet->alphabet_sound}}</div> -->
                        
                        <!-- PASAL LALU, DELIK PELANGGARAN LALU -->                        
                        <table class="fontcalibri">
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                    <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">{{ $violation->other_information}}</td>
                                </tr>

                                <tr>
                                    <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                    <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal  
                                        <!-- {{$sel_article->article}} ayat {{$sel_paragraph->paragraph}} huruf "{{$sel_alphabet->alphabet}}"  -->
                                        {{ pasal($violation->alphabet_id);}} 
                                        
                                        {{$sel_alphabet->alphabet_sound}}</td>
                                </tr>

                                <tr>
                                    <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                    <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;"></td>                    
                                </tr>
                            </tbody>
                        </table>
                        @endif
                        <!-- DELIK SEKARANG -->
                        <!-- <div class="col-sm-12 lead" style="text-align: justify;">- {{ $violation->other_information}}</div> -->

                    <!-- // Jika tidak memiliki alphabet_accumulation pada sp sekaranng  -->
                    @else
                        <table class="fontcalibri">
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-family: 'Calibri', sans-serif; font-size: 14px;">-</td>
                                    <td valign="top" class="lead" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify;">{{ $violation->other_information}}</td>
                                </tr>
                            </tbody>
                        </table>
                            <!-- Remainder Tanpa Akumulasi -->
                        <!-- <div class="col-sm-12 lead" style="text-align: justify;">- {{ $violation->other_information}}</div> -->
                    @endif
                    
                    <br>

                    <div class="col-sm-12 lead fontcalibri" style="font-family: 'Calibri', sans-serif; font-size: 14px; text-align: justify; ">
                        Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan
                        perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran )
                        maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <table class="fontcalibri"  style="width:100%; font-family: 'Calibri', sans-serif; font-size: 14px; text-align:center;">
                        <tr>
                            <td style="width:270px;"></td>
                            <td style="width:170px;"></td>
                            <td >
                            

                                {{ tanggal_pelanggaran($violation->date_of_violation)  }}
                            
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                
                                Penerima Sanksi
                            </td>
                            <td></td>
                            <td  style="text-align:center;">Human Resources Development</td>
                        </tr>
                        <tr>
                            <td style="height:70px;"></td>
                            <td></td>
                            <td></td>
                        </tr>                                              
                        <tr>
                            <td  style="text-align:center;">{{ $employee->name}}</td>
                            <td></td>
                            <td  style="text-align:center;">
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
                            </td>
                        </tr>
                    </table>

            </div>
        @endforeach
    </body>
</html>
