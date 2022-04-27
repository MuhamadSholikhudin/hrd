<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Example</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class="container">

    <div class="d-flex justify-content-center" style="">
    <div class="spinner-border spinner-border-sm" style="width: 6rem; height: 6rem; display:none;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
  </div>

  <br>
  <br>
  <?php 
function sum($satu, $dua){
  if ($satu == 'Satu'){
    
    echo "ini ". $satu;
  }
  echo '<br>';
  if ($dua == 'Dua'){
    
    echo "ini". $satu;
  }
  // echo "ini ". $dua;
}

sum('Satu', "Dua");
echo '<br>';

function get_accumulation(string $last_type, float $last_accumulation, string $sel_paragraph_type_of_verse)
{
            // GET LOGIKA AKUMULASI PERTAMA PERINGATAN LISAN
            if($last_type == 'Peringatan Lisan' AND $last_accumulation = 0.5 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Surat Peringatan Pertama';
                $accumulation = 1;
            }elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation = 1 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Peringatan Lisan';
                $accumulation = 1.5;                            
            }elseif($last_type == 'Peringatan Lisan' AND $last_accumulation = 1.5 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Surat Peringatan Kedua';
                $accumulation = 2;                                                        
            }elseif($last_type == 'Surat Peringatan Kedua'  AND $last_accumulation = 2 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Peringatan Lisan';
                $accumulation = 2.5;                                                        
            }elseif($last_type == 'Peringatan Lisan'  AND $last_accumulation = 2.5 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Peringatan Ketiga';
                $accumulation = 3;                                                        
            }elseif($last_type == 'Surat Peringatan Ketiga'  AND $last_accumulation = 3 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Peringatan Lisan';
                $accumulation = 3.5;                                                        
            }elseif($last_type == 'Peringatan Lisan'  AND $last_accumulation = 3.5 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                        
            }elseif($last_type == 'Surat Peringatan Terakhir'  AND $last_accumulation = 3.5 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4.5;                                                        
            }
    
            //Surat Peringatan Pertama
            elseif($last_type == 'Surat Peringatan Pertama'  AND $last_accumulation = 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'Surat Peringatan Kedua';
                $accumulation = 2;                                                        
            }elseif($last_type == 'Surat Peringatan Kedua'  AND $last_accumulation = 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'Surat Peringatan Ketiga';
                $accumulation = 3;                                                        
            }elseif($last_type == 'Surat Peringatan Ketiga'  AND $last_accumulation = 3 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                        
            }elseif($last_type == 'Surat Peringatan Terakhir'  AND $last_accumulation = 4 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'PHK';
                $accumulation = 5;                                                        
            }
    
    
    
            //Surat Peringatan Kedua
            elseif($last_type == 'Peringatan Lisan' AND $last_accumulation >= 0.5 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
                $status_type_violation = 'Surat Peringatan Kedua';
                $accumulation = 4;                                                                                    
            }
            elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation >= 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
                $status_type_violation = 'Surat Peringatan Ketiga';
                $accumulation = 4;                                                                                    
            }
            elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation >= 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                                                    
            }elseif($last_type == 'Surat Peringatan Terakhir' AND $last_accumulation = 4 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
                $status_type_violation = 'PHK';
                $accumulation = 5;                                                                                                                
            }
    
            elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation >= 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'Surat Peringatan Ketiga';
                $accumulation = 3;                                                                                                                
            }
    
            elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation >= 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                                                                                
            }
    
            // Surat Peringatan Ketiga
            // elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation >= 3 AND $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
            //     $status_type_violation = 'Surat Peringatan Terakhir';
            // }
    
            elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation >= 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                                                                                                            
            }
            elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation = 3 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                                                                                                            
            }elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation = 3 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
                $status_type_violation = 'Surat Peringatan Terakhir';
                $accumulation = 4;                                                                                                                                                                        
            }
            elseif($last_type == 'Surat Peringatan Terakhir' AND $last_accumulation = 4 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
                $status_type_violation = 'PHK';
                $accumulation = 5;                                                                                                                
            }
    
    
            // Surat Peringatan Terakhir
            elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation >= 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Terakhir'){
                $status_type_violation = 'PHK';
                $accumulation = 5;                                                                                                                
            }
            else{
                $status_type_violation = $sel_paragraph_type_of_verse;
    
                if($sel_paragraph_type_of_verse == "Peringatan Lisan"){
                    $accumulation = 0.5;                                                                                                                
                }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Pertama"){
                    $accumulation = 1;                                                                                                                                                
                }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Kedua"){
                    $accumulation = 2;                                                                                                                                                
                }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Ketiga"){
                    $accumulation = 3;                                                                                                                                                
                }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Terakhir"){
                    $accumulation = 4;                                                                                                                                                
                }
            }

            echo $accumulation;
            echo '<br>';
            echo $status_type_violation;
            echo '<br>';
            
            echo $status_type_violation;
            
        };

        $last_type = "Surat Peringatan Terakhir";
        $last_accumulation = 4;
        $sel_paragraph_type_of_verse = "Surat Peringatan Pertama";
        get_accumulation($last_type, $last_accumulation, $sel_paragraph_type_of_verse);




?>



  <?php
    // if (isset($_GET['user']))
    // {
    //   $user = $_GET['user'];
    //   $skinURL = "http://s3.amazonaws.com/MinecraftSkins/".$user.".png";
    // } 
    //   $user = $_GET['user'];
      // $user = '1604000001';

      // $skinURL = "http://10.10.100.148/hwi/Photo/10000/".  $user  .".jpg";
    
    // $debugImage = imagecreatefrompng("http://10.10.100.148/hwi/Photo/10000/".  $user  .".jpg");
    // if (empty($debugImage)) // here it checks if $debugImage is empty (doesn't work)
    // {
    //     $skinURL = 'http://www.minecraft.net/images/char.png';
    // }
    // $skin = imagecreatefrompng($skinURL);

    // if (file_exists("http://10.10.100.148/hwi/Photo/10000/1604000001.png"))
    //   {
    //       $skinURL = 'http://www.minecraft.net/images/char.png';
    //   }else{
    //     echo 'gagal';
    //   }
?>
  <br>


    <?php

            // file:///Y:/1604000001.JPG
            define('IMAGE_FOLDER', 'file:///Y:/');
            if (file_exists('http://10.10.100.148/hwi/Photo/10000/1604000001.jpg')) {
                echo 'Yes';
            echo '<br>';
            echo     file_exists('file:///Y:/1604000001.JPG');

          
            } else {
                echo 'No';
            }
            echo '<br>';

            echo $tanggal_hari_ini = date('Y-m-d');// pendefinisian tanggal awal
            echo '<br>';
            echo $countdown_date1 = date('Y-m-d', strtotime('-93 days', strtotime($tanggal_hari_ini))); //operasi penjumlahan tanggal sebanyak 6 hari
            echo '<br>';
            echo $countdown_date2 = date('Y-m-d', strtotime('-120 days', strtotime($tanggal_hari_ini))); //operasi penjumlahan tanggal sebanyak 6 hari
            echo '<br>';


          // data actual
          echo $hari_apa = date('Y-m-d');

          $date_violation = new \DateTime($hari_apa .' 00:00:00');
          echo '<br>';
          echo $date_year = date_format($date_violation, "Y"); //for Display Year
          echo '<br>';
          echo $date_month =  date_format($date_violation, "m"); //for Display Month
          echo '<br>';
          echo $date_day = date_format($date_violation, "d"); //for Display Date
          echo '<br>';

          echo $d_l = date("d", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          echo '<br>';
          echo $n_l = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          echo '<br>';
          echo $y_l = date("Y", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          echo '<br>';

          echo $tw = $d_l + $n_l + $y_l;


          $data_hari = $d_l;
          $data_bulan = $n_l;
          $data_tahun = $y_l;

          //data manipulasi
          $jumlah_bulan = $data_bulan + 6;
          if($jumlah_bulan > 12){
            $cari_bulan = $jumlah_bulan - 12;
            $m_bulan = $cari_bulan;
            $m_tahun = $data_tahun + 1;
            $m_day = cal_days_in_month(CAL_GREGORIAN, $m_bulan, $m_tahun);
          }else{
            $m_bulan = $jumlah_bulan;
            $m_tahun = $data_tahun;
            $m_day = cal_days_in_month(CAL_GREGORIAN, $m_bulan, $m_tahun); 
          }

          // manipulasi hari
          if($data_hari == 1 AND $m_bulan == 1){
            $bulan_fix = 12;
            $tahun_fix =  $m_tahun - 1;
            $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
          }elseif($data_hari == 1){
            $bulan_fix = $m_bulan - 1;
            $tahun_fix = $m_tahun;
            $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
          }elseif($data_hari <= $m_day){
            $bulan_fix = $m_bulan;
            $tahun_fix = $m_tahun;
            $hari_fix = $data_hari - 1;
          }elseif($data_hari > $m_day){
            $bulan_fix = $m_bulan;
            $tahun_fix = $m_tahun;
            $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
          }
          // 
            // $number_day = cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31
            // echo "There were {$number_day} days in August 2003";
            echo '<br>';
            // $test = new DateTime('02/31/2011');

            if(strlen($hari_fix) == '1'){
              $hari_s = '0'. $hari_fix;
            }elseif(strlen($hari_fix) == '2'){
              $hari_s = $hari_fix;
            }

            if(strlen($bulan_fix) == '1'){
              $bulan_s = '0'. $bulan_fix;
            }elseif(strlen($bulan_fix) == '2'){
              $bulan_s = $bulan_fix;
            }


            echo '<br>';
            echo $te = $bulan_s. "/".$hari_s."/".$tahun_fix;
 
            echo '<br>';            
            $test = new DateTime($te);
            echo date_format($test, 'Y-m-d'); 
            echo '<br>';
            
          ?>
          {{ $hari_fix. " ". $bulan_fix ." ". $tahun_fix}}

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

