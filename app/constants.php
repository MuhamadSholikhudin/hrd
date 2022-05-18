<?php 
/*
http://10.10.42.6:8080 => 23
http://10.10.40.190:8080 => 25
http://127.0.0.1:8000 => 22

*/
function oke()
{
    return  'oke';
}

define("URL_WEB", "http://10.10.42.6:8080");
define("SUM_URL_WEB", 23);

// define("URL_WEB", "10.10.40.190:8080");
// define("SUM_URL_WEB", 25);

// define("URL_WEB", "http://127.0.0.1:8080");
// define("SUM_URL_WEB", 22);

function tanggal_pelanggaran($tanggal_pelanggaran){

    $date_violation_sp = new \DateTime($tanggal_pelanggaran.' 00:00:00');
    $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
    $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
    $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

    $day_sp = gmdate("l", mktime(0,0,0,$date_day_sp,$date_month_sp,$date_year_sp));

    // Hari Indonesia
    if($day_sp == 'Monday'){
      $day_indo_sp = 'Senin';
    }elseif($day_sp == 'Tuesday'){
      $day_indo_sp = 'Selasa';            
    }elseif($day_sp == 'Wednesday'){
      $day_indo_sp = 'Rabu';            
    }elseif($day_sp == 'Thursday'){
      $day_indo_sp = 'Kamis';            
    }elseif($day_sp == 'Friday'){
      $day_indo_sp = 'Jumat';            
    }elseif($day_sp == 'Saturday'){
      $day_indo_sp = 'Sabtu';            
    }elseif($day_sp == 'Sunday'){
      $day_indo_sp = 'Minggu';            
    }

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

    return $day_indo_sp. ", ". $date_day_sp. " ". $month_indo_sp . " ". $date_year_sp;
}

function nomer_sp($no_violation, $violation_id){
  $violation = DB::table('violations')->find( $violation_id);

  $date_violation_sp = new \DateTime($violation->date_of_violation.' 00:00:00');
  $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
  $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
  $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

  if(strlen($no_violation) == '1'){
      $p_no_s = '00'. $no_violation;
  }elseif(strlen($no_violation) == '2'){
      $p_no_s = '0'.$no_violation;
  }    
  return $p_no_s."/SP-HRD/".$violation->violation_ROM."/".$date_year_sp;

}

function selang($date_end_violation){
      $awal_sp = time(); // Waktu sekarang
      $akhir_sp  = strtotime($date_end_violation);
      $diff_sp  = $akhir_sp - $awal_sp;
      if($diff_sp > 0){
        $selang =  floor($diff_sp / (60 * 60 * 24)) . ' hari';
      }else{
        $selang = '';
      }

  return $selang;
}


function pasal($alphabet_id){
  // Pasal 
  $alphabet  = DB::table('alphabets')->find($alphabet_id); 
  $paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); 
  $article  = DB::table('articles')->find($paragraph->article_id); 

  return $article->article . ' ayat '. $paragraph->paragraph .' huruf '. $alphabet->alphabet;
}