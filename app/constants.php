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

// define("URL_WEB", "http://10.10.42.6:8080");
// define("SUM_URL_WEB", 23);

// define("URL_WEB", "10.10.40.190:8080");
// define("SUM_URL_WEB", 25);

define("URL_WEB", "http://127.0.0.1:8000");
define("SUM_URL_WEB", 22);

function jabatan($employee_id){
  $sel_employee = DB::table('employees')->find($employee_id);
  $job = DB::table('jobs')->find($sel_employee->job_id);
  return $job->job_level;
}

function department($employee_id){
  $sel_employee = DB::table('employees')->find($employee_id);
  $department = DB::table('departments')->find($sel_employee->job_id);
  return $department->department;
}

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

function hari_angka($hari_angka){

  $date_violation_sp = new \DateTime($hari_angka.' 00:00:00');
  $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
  $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
  $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

  $day_sp = gmdate("l", mktime(0,0,0,$date_day_sp,$date_month_sp,$date_year_sp));

  // Hari Indonesia
  if($day_sp == 'Monday'){
    $day_indo_sp = 'Senin';
    $day_indo_number = 1;
  }elseif($day_sp == 'Tuesday'){
    $day_indo_sp = 'Selasa';  
    $day_indo_number = 2;              
  }elseif($day_sp == 'Wednesday'){
    $day_indo_sp = 'Rabu';    
    $day_indo_number = 3;
  }elseif($day_sp == 'Thursday'){
    $day_indo_sp = 'Kamis';        
    $day_indo_number = 4;        
  }elseif($day_sp == 'Friday'){
    $day_indo_sp = 'Jumat';     
    $day_indo_number = 5;           
  }elseif($day_sp == 'Saturday'){
    $day_indo_sp = 'Sabtu';   
    $day_indo_number = 6;             
  }elseif($day_sp == 'Sunday'){
    $day_indo_sp = 'Minggu';     
    $day_indo_number = 7;           
  }
  return $day_indo_number;
}

function hari_string($hari_string){

  $date_violation_sp = new \DateTime($hari_string.' 00:00:00');
  $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
  $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
  $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

  $day_sp = gmdate("l", mktime(0,0,0,$date_day_sp,$date_month_sp,$date_year_sp));

  // Hari Indonesia
  if($day_sp == 'Monday'){
    $day_indo_sp = 'Senin';
    $day_indo_number = 1;
  }elseif($day_sp == 'Tuesday'){
    $day_indo_sp = 'Selasa';  
    $day_indo_number = 2;              
  }elseif($day_sp == 'Wednesday'){
    $day_indo_sp = 'Rabu';    
    $day_indo_number = 3;
  }elseif($day_sp == 'Thursday'){
    $day_indo_sp = 'Kamis';        
    $day_indo_number = 4;        
  }elseif($day_sp == 'Friday'){
    $day_indo_sp = 'Jumat';     
    $day_indo_number = 5;           
  }elseif($day_sp == 'Saturday'){
    $day_indo_sp = 'Sabtu';   
    $day_indo_number = 6;             
  }elseif($day_sp == 'Sunday'){
    $day_indo_sp = 'Minggu';     
    $day_indo_number = 7;           
  }
  return $day_indo_sp;
}

function tahun($tahun){

  $date_violation_sp = new \DateTime($tahun.' 00:00:00');
  $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
  
  return $date_year_sp;
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
  }   else{
    $p_no_s = $no_violation;
  } 
  return $p_no_s."/SP-HRD/".$violation->violation_ROM."/".$date_year_sp;
}

function nomer_sp_migrasi($no_violation, $violation_id){
  $violation = DB::table('violationmigrations')->find( $violation_id);

  $date_violation_sp = new \DateTime($violation->date_of_violation.' 00:00:00');
  $date_year_sp = date_format($date_violation_sp, "Y"); //for Display Year
  $date_month_sp =  date_format($date_violation_sp, "m"); //for Display Month
  $date_day_sp = date_format($date_violation_sp, "d"); //for Display Date

  if(strlen($no_violation) == '1'){
      $p_no_s = '00'. $no_violation;
  }elseif(strlen($no_violation) == '2'){
      $p_no_s = '0'.$no_violation;
  }   else{
    $p_no_s = $no_violation;
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

function format_date($format_date){
  $date = date_create($format_date);
  echo date_format($date,"m/d/Y");
}

function pasal_violation($alphabet_id){
  // Pasal 
  $alphabet  = DB::table('alphabets')->find($alphabet_id); 
  $paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); 
  $article  = DB::table('articles')->find($paragraph->article_id); 

  echo $article->article . ' ayat '. $paragraph->paragraph .' huruf '. $alphabet->alphabet;
}

function familyName($fname) {
  echo "Refsnes.<br>";
}

function pasal($alphabet_id){
  // Pasal 
  $alphabet  = DB::table('alphabets')->find($alphabet_id); 
  $paragraph  = DB::table('paragraphs')->find($alphabet->paragraph_id); 
  $article  = DB::table('articles')->find($paragraph->article_id); 

  return $article->article . ' ayat '. $paragraph->paragraph .' huruf '. $alphabet->alphabet;
}

function pasal_yang_dilanggar($violation_id){
  // Pasal 
  $violation  = DB::table('violations')->find($violation_id); 

  if($violation->alphabet_accumulation !== NULL){
    // $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. 25. ' ayat (' .4.' ) huruf "'. a.' ";

    // $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $violation_id. ' ayat (' .$violation_id.' ) huruf "'. $violation_id.' "';
    
    $cari_pasal_akumulasi = DB::table('alphabets')
          ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id', $violation->alphabet_accumulation)
          ->first();

    $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" ';
  
  }else{
    /*
      Perjanjian Kerja Bersama Pasal 27 ayat (3) huruf "p".
      Perjanjian Kerja Bersama Pasal 27 ayat (5) huruf "c".
    */
    $cari_pasal_akumulasi = DB::table('alphabets')
      ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
      ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
      ->where('alphabets.id', $violation->alphabet_id)
      ->first();

    $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" ';

  }

  return $pasal_yang_dilanggar;

}

function BUNYI_PASAL_PELANGGARAN_SEKARANG_JIKA_SUDAH_PERNAH_DAPAT_SP($violation_id){
   // Pasal 
   $violation  = DB::table('violations')->find($violation_id); 

   if($violation->alphabet_accumulation !== NULL){
     $cari_pasal_akumulasi = DB::table('alphabets')
           ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
           ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
           ->where('alphabets.id', $violation->alphabet_accumulation)
           ->first();
 
           $BUNYI_PASAL_PELANGGARAN_SEKARANG_JIKA_SUDAH_PERNAH_DAPAT_SP = $cari_pasal_akumulasi->alphabet_sound;   
   }else{
 
      $BUNYI_PASAL_PELANGGARAN_SEKARANG_JIKA_SUDAH_PERNAH_DAPAT_SP = "-";
 
   }
 
   return $BUNYI_PASAL_PELANGGARAN_SEKARANG_JIKA_SUDAH_PERNAH_DAPAT_SP;
}

function BUNYI_PASAL($violation_id){
   // Pasal 
   $violation  = DB::table('violations')->find($violation_id); 

   if($violation->alphabet_accumulation !== NULL){
     $BUNYI_PASAL = "-";
     
   }else{
      $cari_pasal_akumulasi = DB::table('alphabets')
        ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('alphabets.id', $violation->alphabet_id)
        ->first(); 
      $BUNYI_PASAL = $cari_pasal_akumulasi->alphabet_sound;   
      
   }
   return $BUNYI_PASAL;
}

function PASAL_25_AYAT_2A_3A_4A_B_5A_B_DAN_C_JIKA_PERNAH_DAPAT_SP_PELANGGARAN_SEKARANG($violation_id){

  $violation  = DB::table('violations')->find($violation_id); 

  $sel_alphabet = DB::table('alphabets')->find($violation->alphabet_id);
  $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
  $sel_article = DB::table('articles')->find($sel_paragraph->article_id);

  if($violation->alphabet_accumulation !== NULL){
    $cari_pasal_akumulasi = DB::table('alphabets')
          ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id', $violation->alphabet_accumulation)
          ->first();

          $PASAL_25_AYAT_2A_3A_4A_B_5A_B_DAN_C_JIKA_PERNAH_DAPAT_SP_PELANGGARAN_SEKARANG = 'Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ';   
  }else{

     $PASAL_25_AYAT_2A_3A_4A_B_5A_B_DAN_C_JIKA_PERNAH_DAPAT_SP_PELANGGARAN_SEKARANG = "-";

  }

  return $PASAL_25_AYAT_2A_3A_4A_B_5A_B_DAN_C_JIKA_PERNAH_DAPAT_SP_PELANGGARAN_SEKARANG;

}

function BUNYI_PASAL1($violation_id){

  $violation  = DB::table('violations')->find($violation_id); 

  $sel_alphabet = DB::table('alphabets')->find($violation->alphabet_id);
  $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
  $sel_article = DB::table('articles')->find($sel_paragraph->article_id);

  if($violation->alphabet_accumulation !== NULL){
    $cari_pasal_akumulasi = DB::table('alphabets')
          ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id', $violation->alphabet_accumulation)
          ->first();
          $BUNYI_PASAL1 = $sel_alphabet->alphabet_sound;   
  }else{
     $BUNYI_PASAL1 = "-";
  }
  return $BUNYI_PASAL1;
}

function KETENGAN_LAIN_2($violation_id){
  $violation  = DB::table('violations')->find($violation_id); 

  if($violation->alphabet_accumulation !== NULL){

    if($violation->violation_accumulation !== NULL){
      $cari_pasal_akumulasi = DB::table('alphabets')
        ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('alphabets.id', $violation->alphabet_accumulation)
        ->first();

      $pelanggran_sebelumnya = DB::table('violations')
        ->where('employee_id',  $violation->employee_id) 
        ->where('id',  $violation->violation_accumulation) 
        ->latest()                       
        ->first();

      $cari_pasal_sebelumnya = DB::table('alphabets')
        ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
        ->first();

      $last_type = $cari_pasal_sebelumnya->type_of_verse;

      $BUNYI_PASAL1 = 'Dalam masa ' . $last_type . ' Perjanjian Kerja Bersama Pasal '. $cari_pasal_sebelumnya->article . ' ayat ('. $cari_pasal_sebelumnya->paragraph. ') huruf "'.$cari_pasal_sebelumnya->alphabet.'", ';   


    }else{ 

      $BUNYI_PASAL1 = "-";
    }

  }else{
     $BUNYI_PASAL1 = "-";
  }

  return $BUNYI_PASAL1;
}

function KETERANGAN_LAIN_1($violation_id){
  $violation  = DB::table('violations')->find($violation_id); 

  if($violation->alphabet_accumulation !== NULL){

    if($violation->violation_accumulation !== NULL){
      $cari_pasal_akumulasi = DB::table('alphabets')
          ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id', $violation->alphabet_accumulation)
          ->first();

          $pelanggran_sebelumnya = DB::table('violations')
          ->where('employee_id',  $violation->employee_id) 
          ->where('id',  $violation->violation_accumulation) 
          ->latest()                       
          ->first();

      $cari_pasal_sebelumnya = DB::table('alphabets')
          ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
          ->first();

          $KETERANGAN_LAIN_1 = $cari_pasal_sebelumnya->alphabet_sound;   
    }else{
          $KETERANGAN_LAIN_1 = "-";
    }
  }else{
     $KETERANGAN_LAIN_1 = "-";
  }
  return $KETERANGAN_LAIN_1;
}

function PELANGGARAN_SEBELUMNYA($violation_id){
  $violation  = DB::table('violations')->find($violation_id); 

  if($violation->alphabet_accumulation !== NULL){
    if($violation->violation_accumulation !== NULL){
      $cari_pasal_akumulasi = DB::table('alphabets')
          ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id', $violation->alphabet_accumulation)
          ->first();

          $pelanggran_sebelumnya = DB::table('violations')
          ->where('employee_id',  $violation->employee_id) 
          ->where('id',  $violation->violation_accumulation) 
          ->latest()                       
          ->first();

      $cari_pasal_sebelumnya = DB::table('alphabets')
          ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
          ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
          ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
          ->first();

          $PELANGGARAN_SEBELUMNYA = $pelanggran_sebelumnya->other_information;   
    }else{
     $PELANGGARAN_SEBELUMNYA = "-";
      
    }
  }else{
     $PELANGGARAN_SEBELUMNYA = "-";
  }
  return $PELANGGARAN_SEBELUMNYA;
}

function an_hrd($signature_id){
  $signature =  DB::table('signatures')->find($signature_id);
  return $signature->name;
}


//ROLE ACCESS
function role(){
  
}


// ALPHABETS EDIT AKUMLASI
function alphabet_edit_accumulation($alphabet_id, $type){

  $sel_type_accumulation  = DB::table('alphabets')
    ->where('id', $alphabet_id)
    ->where('alphabet_accumulation', 'like', '%' . $type . '%')
    ->count();

  if($sel_type_accumulation > 0){
    $check = 'checked="checked"';
  }else{
    $check = '';
  }

  return $check;
}