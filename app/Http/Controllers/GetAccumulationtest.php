<?php 

$sp_akhir = $last_accumulation;

if($sp_akhir == 0.5){
    $status_type_violation_akhir = 'Peringatan Lisan';
}elseif($sp_akhir >= 1 AND $sp_akhir <= 1.5){
    $status_type_violation_akhir = 'Surat Peringatan Pertama';
}elseif($sp_akhir >= 2 AND $sp_akhir <= 2.5){
    $status_type_violation_akhir = 'Surat Peringatan Kedua';
}elseif($sp_akhir >= 3 AND $sp_akhir <= 3.5){
    $status_type_violation_akhir = 'Surat Peringatan Ketiga';
}elseif($sp_akhir >= 4 AND $sp_akhir <= 4.5){
    $status_type_violation_akhir = 'Surat Peringatan Terakhir';
}elseif($sp_akhir >= 5 AND $sp_akhir <= 5.5){
     $status_type_violation_akhir = 'Pemutusan Hubungan Kerja';
}

$pelanggaran_sekarang =  $sel_paragraph->type_of_verse;

if($pelanggaran_sekarang == 'Peringatan Lisan'){
    $sp_se = 0.5;
}elseif($pelanggaran_sekarang == 'Surat Peringatan Pertama'){
    $sp_se = 1;
}elseif($pelanggaran_sekarang == 'Surat Peringatan Kedua'){
    $sp_se = 2;
}elseif($pelanggaran_sekarang == 'Surat Peringatan Ketiga'){
    $sp_se = 3;
}elseif($pelanggaran_sekarang == 'Surat Peringatan Terakhir'){
    $sp_se = 4;
}elseif($pelanggaran_sekarang == 'Pemutusan Hubungan Kerja'){
    $sp_se = 5;    
}

$sp_kombinasi = $sp_akhir + $sp_se;

// Sorting by pelanggaran sekarang
if($sp_kombinasi == 0.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}
elseif($sp_kombinasi == 1 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Surat Peringatan Pertama';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi == 1.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($last_accumulation == 2.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Surat Peringatan Ketiga';
    $accumulation = 3;
    $select_status_type_violation = 'Surat Peringatan Pertama';
}

elseif($sp_kombinasi == 2.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 3;
    $select_status_type_violation = 'Surat Peringatan Pertama';
}
elseif($sp_kombinasi == 2.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}
elseif($sp_kombinasi == 3 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Surat Peringatan Ketiga';
    $accumulation = 3;
    $select_status_type_violation = 'Surat Peringatan Pertama';
}
elseif($sp_kombinasi == 3.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 3;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi == 4 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Surat Peringatan Terakhir';
    $accumulation = 4;
    $select_status_type_violation =  'Surat Peringatan Pertama';
}
elseif($sp_kombinasi == 4.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi == 0.5){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}elseif($sp_kombinasi >= 1 AND $sp_kombinasi <= 1.5){
    $status_type_violation = 'Surat Peringatan Pertama';
    $accumulation = 1;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi >= 2 AND $sp_kombinasi <= 2.5){
    $status_type_violation = 'Surat Peringatan Kedua';
    $accumulation = 2;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi >= 3 AND $sp_kombinasi <= 3.5 AND $sel_paragraph->type_of_verse == "Surat Peringatan Kedua"){
    $status_type_violation = 'Surat Peringatan Ketiga';
    $accumulation = 3;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}
elseif($sp_kombinasi >= 3 AND $sp_kombinasi <= 3.5 AND $sel_paragraph->type_of_verse == "Surat Peringatan Pertama"){
    $status_type_violation = 'Surat Peringatan Ketiga';
    $accumulation = 3;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi >= 5 AND $sp_kombinasi <= 7 AND $status_type_violation_akhir == "Surat Peringatan Terakhir"){
    $status_type_violation = 'Pemutusan Hubungan Kerja';
    $accumulation = 5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;   
}
elseif($sp_kombinasi >= 4 AND $sp_kombinasi <= 6.5){
    $status_type_violation = 'Surat Peringatan Terakhir';
    $accumulation = 4;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

    // Cari pasal akumulasi
    $num_pasal_akumulasi = DB::table('alphabets')
        ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('paragraphs.type_of_verse', $status_type_violation)
        ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
        ->count();

    if($num_pasal_akumulasi > 0){
        if($status_type_violation == 'Surat Peringatan Terakhir'){
            
            if($last_type == 'Surat Peringatan Pertama'){
                // $cari_pasal_akumulasi = ['id' => 91];
                // $pasal_terakhir = $cari_pasal_akumulasi['id'];
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                    ->where('paragraphs.type_of_verse', $status_type_violation)
                    ->where('alphabets.id', 91)
                    ->first(); 

            }elseif($last_type == 'Surat Peringatan Kedua'){
                // $cari_pasal_akumulasi = ['id' => 92];
                // $pasal_terakhir = $cari_pasal_akumulasi['id']; 
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                    ->where('paragraphs.type_of_verse', $status_type_violation)
                    ->where('alphabets.id', 92)
                    ->first(); 
            }elseif($last_type == 'Surat Peringatan Ketiga'){
                // $cari_pasal_akumulasi = ['id' => 93]; 
                // $pasal_terakhir = $cari_pasal_akumulasi['id']; 
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                    ->where('paragraphs.type_of_verse', $status_type_violation)
                    ->where('alphabets.id', 93)
                    ->first(); 
            }else{
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                    ->where('paragraphs.type_of_verse', $status_type_violation)
                    ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
                    ->first();
            }
        }else{
            $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('paragraphs.type_of_verse', $status_type_violation)
                ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
                ->first();
        }
       
    }elseif($sel_paragraph->type_of_verse == "Peringatan Lisan"){

            if($last_accumulation == 1.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){

                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->where('paragraphs.type_of_verse', "Surat Peringatan Kedua")
                    ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                    ->first();
    
            }elseif($last_accumulation == 2.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->where('paragraphs.type_of_verse', "Surat Peringatan Ketiga")
                    ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                    ->first();
    
            }elseif($last_accumulation == 3.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->where('paragraphs.type_of_verse', "Surat Peringatan Terakhir")
                    ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                    ->first();
                    
            }elseif($last_accumulation == 4.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){
                $cari_pasal_akumulasi = DB::table('alphabets')
                    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                    ->where('paragraphs.type_of_verse', "Pemutusan Hubungan Kerja")
                    ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                    ->first();
            }else{
                $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('alphabets.id', $violation_now)
                ->first();
            }

    }else{
        $cari_pasal_akumulasi = DB::table('alphabets')
            ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
            ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
            ->where('alphabets.id', $violation_now)
            ->first();
    }
        $pelanggran_sebelumnya = DB::table('violations')
            ->where('employee_id',  $employee_id) 
            ->where('violation_status', 'active')
            ->latest()                       
            ->first();

        $cari_pasal_sebelumnya = DB::table('alphabets')
            ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
            ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
            ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
            ->first();
                    
        // $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" '. $cari_pasal_akumulasi->alphabet_sound;

        // $remainder1 = 'Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->alphabet_sound ;
        // $remainder2 = 'Dalam masa ' . $last_type . ' Perjanjian Kerja Bersama Pasal '. $cari_pasal_sebelumnya->article . ' ayat ('. $cari_pasal_sebelumnya->paragraph. ') huruf "'.$cari_pasal_sebelumnya->alphabet_sound.'", ' .$pelanggran_sebelumnya->other_information;

        // $data = [ $status_type_violation, $pasal_yang_dilanggar, $remainder1, $remainder2];
