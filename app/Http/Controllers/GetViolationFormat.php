<?php 
  $date_violation = new \DateTime($reporting_date .' 00:00:00');

  $date_year = date_format($date_violation, "Y"); //for Display Year
  $date_month =  date_format($date_violation, "m"); //for Display Month
  $date_day = date_format($date_violation, "d"); //for Display Date
  // $tahun = YEAR($date_of_violation);

  // Prints October 3, 1975 was on a Thursday
  //   echo "Oct 3, 1975 was on a ".gmdate("l", mktime(0,0,0,$date_day,$date_month,$date_year)) . "<br>";

  $day = gmdate($date_of_violation, time()+60*60*7);
  $day = date("l", gmmktime(0,0,0, $date_month, $date_day, $date_year));

  if($day == 'Monday'){
    $day_num = '1';
    $day_indo = 'Senin';
  }elseif($day == 'Tuesday'){
    $day_num = '2';
    $day_indo = 'Selasa';            
  }elseif($day == 'Wednesday'){
    $day_num = '3';
    $day_indo = 'Rabu';            
  }elseif($day == 'Thursday'){
    $day_num = '4';
    $day_indo = 'Kamis';            
  }elseif($day == 'Friday'){
    $day_num = '5';
    $day_indo = 'Jumat';            
  }elseif($day == 'Saturday'){
    $day_num = '6';
    $day_indo = 'Sabtu';            
  }elseif($day == 'Sunday'){
    $day_num = '7';
    $day_indo = 'Minggu';            
  }
        
  $month_n = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          
          if($month_n == 1){
            $ROM = 'I';
          }elseif($month_n == 2){
            $ROM = 'II';
          }elseif($month_n == 3){
            $ROM = 'III';
          }elseif($month_n == 4){
            $ROM = 'IV';
          }elseif($month_n == 5){
            $ROM = 'V';
          }elseif($month_n == 6){
            $ROM = 'VI';
          }elseif($month_n == 7){
            $ROM = 'VII';
          }elseif($month_n == 8){
            $ROM = 'VIII';
          }elseif($month_n == 9){
            $ROM = 'IX';
          }elseif($month_n == 10){
            $ROM = 'X';
          }elseif($month_n == 11){
            $ROM = 'XI';
          }elseif($month_n == 12){
            $ROM = 'XII';
          }

        //   $tgl1 = $date_of_violation;// pendefinisian tanggal awal

          //Pembuatan 6 bulan berakhir
        //   $date_end_violation = date('Y-m-d', strtotime('+180 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
          
        //   echo $hari_apa = date('Y-m-d');

        
        $d_l = date("d", gmmktime(0,0,0, $date_month, $date_day, $date_year));
        $n_l = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
        $y_l = date("Y", gmmktime(0,0,0, $date_month, $date_day, $date_year));
 
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

            $te = $bulan_s. "/".$hari_s."/".$tahun_fix;
            $test = new \DateTime($te);
            $date_end_violation = date_format($test, 'Y-m-d'); 