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
  <br>


    <?php

            // file:///Y:/1604000001.JPG
            define('IMAGE_FOLDER', 'file:///Y:/');
            if (file_exists('file:///Y:/1604000001.JPG')) {
                echo 'Yes, there is the image "load/img1.png"';
            echo '<br>';
            echo     file_exists('file:///Y:/1604000001.JPG');

            ?>
            <img src="file:///Y:/1604000001.JPG">
            <?php
            } else {
                echo 'No, there is no such an image file "load/img1.png"';
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
