<!DOCTYPE html>
<html>
    <head>
    <style>
        .pageA4{
            height: 1010px;
        }

        h4 {
            margin: 0 0 10px 0;
        }
        h1 {
            text-align: center;
        }
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
                        <td width="88" align="center" >
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
                
                <h3 class="text-center" style="text-align: center; center; margin-bottom: 0%;">
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
                <h5 class="text-center " style="text-align: center; margin-top: 0%;"> 
                    NO:{{ $p_no_s}} /SP-HRD/{{ $violation->violation_ROM}}/{{date_format($date_violation_sp, "Y")}}      
                </h5>

                <div class="col-sm-12 lead">Kepada karyawan tersebut di bawah ini :</div>
                <br>
                <table>
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
                <div class="col-sm-12 lead">Dengan ini diberikan, <u>{{ $violation->type_of_violation}}</u></div>
                <br>
                <div class="col-sm-12 lead" style="text-align: justify;">
                    Sehubungan yang bersangkutan telah melakukan pelanggaran peraturan/tata tertib/disiplin kerja yang
                    berlaku di perusahaan. :
                </div>
                <br>
                
                <div class="col-sm-12 lead"><b>Pasal yang dilanggar :</b></div>

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
                    <table style="width:100%;">
                        <tr>
                            <td></td>
                            <td style="text-align:center;">
                            
                            {{ tanggal_pelanggaran($violation->date_of_violation)  }}
                            
                            </td>
                        </tr>
                        <tr>
                            <td  style="text-align:center;">Penerima Sanksi</td>
                            <td  style="text-align:center;">Human Resources Development</td>
                        </tr>
                        <tr>
                            <td style="height:70px;">
                            
                            </td>
                            <td></td>
                        </tr>                                              
                        <tr>
                            <td  style="text-align:center;">{{ $employee->name}}</td>
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
