<?php

    // GET LOGIKA AKUMULASI PERTAMA PERINGATAN LISAN
    if($last_type == 'Peringatan Lisan' AND $last_accumulation = 0.5 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Pertama';
        $accumulation = 1;
    }elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation = 1 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Lisan';
        $accumulation = 1.5;                            
    }elseif($last_type == 'Peringatan Lisan' AND $last_accumulation = 1.5 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Kedua';
        $accumulation = 2;                                                        
    }elseif($last_type == 'Surat Peringatan Kedua'  AND $last_accumulation = 2 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Lisan';
        $accumulation = 2.5;                                                        
    }elseif($last_type == 'Peringatan Lisan'  AND $last_accumulation = 2.5 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Ketiga';
        $accumulation = 3;                                                        
    }elseif($last_type == 'Surat Peringatan Ketiga'  AND $last_accumulation = 3 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Lisan';
        $accumulation = 3.5;                                                        
    }elseif($last_type == 'Peringatan Lisan'  AND $last_accumulation = 3.5 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                        
    }elseif($last_type == 'Surat Peringatan Terakhir'  AND $last_accumulation = 3.5 AND $sel_paragraph->type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4.5;                                                        
    }

    //Surat Peringatan Pertama
    elseif($last_type == 'Surat Peringatan Pertama'  AND $last_accumulation = 1 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Kedua';
        $accumulation = 2;                                                        
    }elseif($last_type == 'Surat Peringatan Kedua'  AND $last_accumulation = 2 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Ketiga';
        $accumulation = 3;                                                        
    }elseif($last_type == 'Surat Peringatan Ketiga'  AND $last_accumulation = 3 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                        
    }elseif($last_type == 'Surat Peringatan Terakhir'  AND $last_accumulation = 4 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;                                                        
    }


    //Surat Peringatan Kedua
    elseif($last_type == 'Peringatan Lisan' AND $last_accumulation >= 0.5 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Kedua';
        $accumulation = 4;                                                                                    
    }
    elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation >= 1 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Ketiga';
        $accumulation = 4;                                                                                    
    }
    elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation >= 2 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                                                    
    }elseif($last_type == 'Surat Peringatan Terakhir' AND $last_accumulation = 4 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;                                                                                                                
    }
    elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation >= 2 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Ketiga';
        $accumulation = 3;                                                                                                                
    }
    elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation >= 2 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                                                                                
    }

    // Surat Peringatan Ketiga
    elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation >= 1 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                                                                                                            
    }
    elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation = 3 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                                                                                                            
    }elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation = 3 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                                                                                                                                                                        
    }
    elseif($last_type == 'Surat Peringatan Terakhir' AND $last_accumulation = 4 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;                                                                                                                
    }

    // Surat Peringatan Terakhir
    elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation >= 1 AND $sel_paragraph->type_of_verse == 'Surat Peringatan Terakhir'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;                                                                                                                
    }
    else{
        $status_type_violation = $sel_paragraph->type_of_verse;

        if($sel_paragraph->type_of_verse == "Peringatan Lisan"){
            $accumulation = 0.5;                                                                                                                
        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Pertama"){
            $accumulation = 1;                                                                                                                                                
        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Kedua"){
            $accumulation = 2;                                                                                                                                                
        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Ketiga"){
            $accumulation = 3;                                                                                                                                                
        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Terakhir"){
            $accumulation = 4;                                                                                                                                                
        }
    }

    // Cari pasal akumulasi
    $num_pasal_akumulasi = DB::table('alphabets')
        ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('paragraphs.type_of_verse', $status_type_violation)
        ->where('alphabets.alphabet_accumulation', 'like', '%' . $sel_paragraph->type_of_verse . '%')
        // ->where('paragraphs.type_of_verse', $sel_paragraph->type_of_verse)
        // ->where('alphabets.alphabet_accumulation', $status_type_violation)
        ->select('alphabets.id as id')
        ->count();

    if($num_pasal_akumulasi > 0){
        $cari_pasal_akumulasi = DB::table('alphabets')
            ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
            ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
            ->where('paragraphs.type_of_verse', $status_type_violation)
            ->where('alphabet_accumulation', 'like', '%' . $sel_paragraph->type_of_verse . '%')
            // ->where('alphabets.alphabet_accumulation', $status_type_violation)
            ->select('alphabets.id as id')
            ->first();
            
    }else{
        $cari_pasal_akumulasi = DB::table('alphabets')
        ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('alphabets.id', $alphabet_id)
        ->first();
    }

    $pelanggran_sebelumnya = DB::table('violations')
        ->where('employee_id',  $employee_id) 
        ->latest()                       
        ->first();

    $cari_pasal_sebelumnya = DB::table('alphabets')
        ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
        ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
        ->first();
        