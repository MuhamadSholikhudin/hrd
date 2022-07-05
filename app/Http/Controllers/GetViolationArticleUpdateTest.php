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
elseif($last_accumulation == 4.5 AND $last_type == 'Peringatan Lisan'){
    $status_type_violation = 'Pemutusan Hubungan Kerja';
    $accumulation = 5;
    $select_status_type_violation = $pelanggaran_sekarang;   
}
elseif($sp_kombinasi == 5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Pemutusan Hubungan Kerja';
    $accumulation = 5;
    $select_status_type_violation = 'Surat Peringatan Pertama';   
}

elseif($sp_kombinasi >= 5 AND $sp_kombinasi <= 7.5 AND $status_type_violation_akhir == "Surat Peringatan Terakhir"){
    $status_type_violation = 'Pemutusan Hubungan Kerja';
    $accumulation = 5;
    $select_status_type_violation = 'Surat Peringatan Pertama';   
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

elseif($sp_kombinasi == 2 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Surat Peringatan Kedua';
    $accumulation = 2;
    $select_status_type_violation = 'Surat Peringatan Pertama';
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
    $select_status_type_violation = 'Surat Peringatan Pertama';
}
elseif($sp_kombinasi == 4.5 AND $pelanggaran_sekarang == 'Peringatan Lisan'){
    $status_type_violation = 'Peringatan Lisan';
    $accumulation = 0.5;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}
elseif($sp_kombinasi == 3.5 AND $sel_paragraph->type_of_verse == "Surat Peringatan Ketiga"){
    $status_type_violation = 'Surat Peringatan Ketiga';
    $accumulation = 3;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi >= 3 AND $sp_kombinasi <= 3.5 AND $sel_paragraph->type_of_verse == "Surat Peringatan Pertama"){
    $status_type_violation = 'Surat Peringatan Ketiga';
    $accumulation = 3;
    $select_status_type_violation = $sel_paragraph->type_of_verse;
}

elseif($sp_kombinasi >= 4 AND $sp_kombinasi <= 6.5 AND $status_type_violation_akhir !== "Surat Peringatan Terakhir"){
    $status_type_violation = 'Surat Peringatan Terakhir';
    $accumulation = 4;
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

    // Cari pasal akumulasi
    $num_pasal_akumulasi = DB::table('alphabets')
        ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('paragraphs.type_of_verse', $status_type_violation)
        ->where('alphabets.alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
        // ->where('paragraphs.type_of_verse', $sel_paragraph->type_of_verse)
        // ->where('alphabets.alphabet_accumulation', $status_type_violation)
        ->select('alphabets.id as id')
        ->count();

    if($num_pasal_akumulasi > 0){

        if($status_type_violation == 'Surat Peringatan Terakhir'){
            
            if($last_type == 'Surat Peringatan Pertama'){
                $cari_pasal_akumulasi = ['id' => 91];
                $pasal_terakhir = $cari_pasal_akumulasi['id'];   
            }elseif($last_type == 'Surat Peringatan Kedua'){
                $cari_pasal_akumulasi = ['id' => 92];
                $pasal_terakhir = $cari_pasal_akumulasi['id']; 
            }elseif($last_type == 'Surat Peringatan Ketiga'){
                $cari_pasal_akumulasi = ['id' => 93]; 
                $pasal_terakhir = $cari_pasal_akumulasi['id'];  
            }else{
                $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('paragraphs.type_of_verse', $status_type_violation)
                ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
                // ->where('alphabets.alphabet_accumulation', $status_type_violation)
                ->select('alphabets.id as id')
                ->first();
                $pasal_terakhir = $cari_pasal_akumulasi->id;
            }
            
        }else{
            $cari_pasal_akumulasi = DB::table('alphabets')
            ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
            ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
            ->where('paragraphs.type_of_verse', $status_type_violation)
            ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
            // ->where('alphabets.alphabet_accumulation', $status_type_violation)
            ->select('alphabets.id as id')
            ->first();
            $pasal_terakhir = $cari_pasal_akumulasi->id;
        }
        $pasal_alphabet_accumulation = $pasal_terakhir;                 
    }else{

        if($last_accumulation == 1.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){

            $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('paragraphs.type_of_verse', "Surat Peringatan Kedua")
                ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                ->select('alphabets.id as id')
                ->first();

                $pasal_alphabet_accumulation = $cari_pasal_akumulasi->id;

        }elseif($last_accumulation == 2.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){
            $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('paragraphs.type_of_verse', "Surat Peringatan Ketiga")
                ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                ->select('alphabets.id as id')
                ->first();
                $pasal_alphabet_accumulation = $cari_pasal_akumulasi->id;

        }elseif($last_accumulation == 3.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){
            $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('paragraphs.type_of_verse', "Surat Peringatan Terakhir")
                ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                ->select('alphabets.id as id')
                ->first();

            $pasal_alphabet_accumulation = $cari_pasal_akumulasi->id;
                
        }elseif($last_accumulation == 4.5 AND $sel_paragraph->type_of_verse == "Peringatan Lisan"){
            $cari_pasal_akumulasi = DB::table('alphabets')
                ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                ->where('paragraphs.type_of_verse', "Pemutusan Hubungan Kerja")
                ->where('alphabet_accumulation', 'like', '%Surat Peringatan Pertama%')
                ->select('alphabets.id as id')
                ->first();
            $pasal_alphabet_accumulation = $cari_pasal_akumulasi->id;
                
        }else{

            // $cari_pasal_akumulasi = DB::table('alphabets')
            //     ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
            //     ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
            //     ->where('alphabets.id', $alphabet_id)
            //     ->select('alphabets.id as id')        
            //     ->first();
    
            $pasal_alphabet_accumulation = NULL;
        }

        // $cari_pasal_akumulasi = DB::table('alphabets')
        //     ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        //     ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        //     ->where('paragraphs.type_of_verse', $status_type_violation)
        //     ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
        //     // ->where('alphabets.alphabet_accumulation', $status_type_violation)
        //     ->select('alphabets.id as id')
        //     ->first();
        
    }

    $pelanggran_sebelumnya = DB::table('violations')
        ->where('employee_id',  $employee_id) 
        ->where('id', '<',   $violation_id) 
        ->latest()                       
        ->first();

    $cari_pasal_sebelumnya = DB::table('alphabets')
        ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
        ->first();

