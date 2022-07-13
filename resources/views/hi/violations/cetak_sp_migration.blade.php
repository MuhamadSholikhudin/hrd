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
        .fontcalibri{
            font-family: "Calibri";
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
     
                    <h3 class="text-center fontcalibri" style="margin-bottom: 0%;">
                        <u> SURAT PERINGATAN </u>
                    </h3>
                        <?php 
                            
                            if(strlen($violation->no_violation) == '1'){
                                $p_no_s = '00'. $violation->no_violation;
                            }elseif(strlen($violation->no_violation) == '2'){
                                $p_no_s = '0'.$violation->no_violation;
                            }else{
                                $p_no_s = $violation->no_violation;
                            }
                        ?>
                    <h5 class="text-center fontcalibri"> NO:{{ $p_no_s}} /SP-HRD/{{ $violation->violation_rom}}/{{ date('Y', strtotime($violation->date_of_violation))}}      
                        </h5>
                    <br>
                    <div class="col-sm-12 fontcalibri lead">Kepada karyawan tersebut di bawah ini :</div>
                    <br>
                    <!-- <div class="col-sm-3 lead">

                    </div> -->
                    <div class="col-sm-9 fontcalibri lead">
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
                    <div class="col-sm-12 fontcalibri lead">Dengan ini diberikan, 
                        <b>
                            <u>
                                @if($violation->type_of_violation == "Peringatan Lisan")
                                    Surat Peringatan Lisan
                                @else
                                    {{ $violation->type_of_violation}}
                                @endif
                            </u>
                        </b> 
                    </div>
                    <br>
                    <div class="col-sm-12 fontcalibri lead" style="text-align: justify;">Sehubungan yang bersangkutan telah melakukan pelanggaran peraturan/tata tertib/disiplin kerja yang
                        berlaku di perusahaan. :</div>
                        <br>
                    <div class="col-sm-12 fontcalibri lead"> <b>Pasal yang dilanggar : </b></div>
                    <div class="col-sm-12 fontcalibri lead"> 
                       
                        {{$violation->pasal_yang_dilanggar}}

                        @if($violation->bunyi_pasal_pelanggaran == "")
                            {{$violation->bunyi_pasal_pelanggaran_jika_pernah_sp}}

                        @else
                            {{$violation->bunyi_pasal_pelanggaran}}
                        @endif
                    
                    </div>                   
                    
              
                    <br>
                    <div class="col-sm-12 fontcalibri lead"><b>Keterangan lain :</b></div>
                    <div class="col-sm-12 fontcalibri lead">
                    
                        <table >
                            <tbody>
                                <tr>
                                    <td valign="top">-</td>
                                    <td valign="top" class="lead" style="text-align: justify;">{{ $violation->keterangan_lain}}</td>
                                </tr>

                                <tr>
                                    <td valign="top">-</td>
                                    <td valign="top" class="lead" style="text-align: justify;">

                                        <!-- if($violation->bunyi_pasal_pelanggaran == "") -->
                                            

                                        @if($violation->pelanggaran_sekarang_jiks_pernah_dapat_sp == "")
                                            
                                        @else
                                            {{$violation->bunyi_pasal_pelanggaran_jika_pernah_sp}} {{$violation->bunyi_pasal_pelanggarang_sekarang}}
                                        @endif
                                   
                                        </td>
                                </tr>

                                <tr>
                                    <td valign="top">-</td>
                                    <td valign="top" class="lead" style="text-align: justify;">
                                        @if($violation->ketengan_lain_2 == "")
                                            
                                        @else
                                            {{$violation->ketengan_lain_2}} {{$violation->bunyi_pasal_pelanggarang_sekarang}}, {{$violation->keterangan_lain_1}}, {{$violation->keterangan_lain_1}}
                                        @endif

                                    </td>                    
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    

                    <br>
                    <div class="col-sm-12 fontcalibri lead" style="text-align: justify;">
                        Apabila dikemudian hari terjadi pengulangan perbuatan pelanggaran tersebut diatas dan/atau melakukan
                        perbuatan pelanggaran selama masa berlaku Surat Peringatan (6 bulan sejak waktu pelanggaran )
                        maka akan diambil tindakan lanjutan sesuai peraturan perusahaan yang berlaku.
                    </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-4 fontcalibri">
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
                                    
                                        <p class="text-center lead"> 
                                            Jepara,  <br>
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
                                            
                                            {{ $violation->an_hrd  }}
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