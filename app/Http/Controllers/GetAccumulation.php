<?php 

    // GET LOGIKA AKUMULASI PERTAMA PERINGATAN LISAN
    if($last_type == 'Peringatan Lisan' && $last_accumulation == 0.5 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Pertama';
        $accumulation = 1;
        $select_status_type_violation = $sel_paragraph->type_of_verse;
    }elseif($last_type == 'Surat Peringatan Pertama' && $last_accumulation == 1 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Lisan';
        $accumulation = 1.5;                    
        $select_status_type_violation = $sel_paragraph->type_of_verse;        
    }elseif($last_type == 'Peringatan Lisan' && $last_accumulation == 1.5 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Kedua';
        $accumulation = 2;                                       
        $select_status_type_violation = 'Surat Peringatan Pertama';
    }elseif($last_type == 'Surat Peringatan Kedua'  && $last_accumulation == 2 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Lisan';
        $accumulation = 2.5;       
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                 
    }elseif($last_type == 'Peringatan Lisan'  && $last_accumulation = 2.5 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Ketiga';
        $accumulation = 3;                                  
        $select_status_type_violation = 'Surat Peringatan Pertama';                      
    }elseif($last_type == 'Surat Peringatan Ketiga'  && $last_accumulation == 3 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Peringatan Lisan';
        $accumulation = 3.5;
        $select_status_type_violation = 'Surat Peringatan Pertama';                                                        
    }elseif($last_type == 'Peringatan Lisan'  && $last_accumulation == 3.5 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                 
        $select_status_type_violation = 'Surat Peringatan Pertama';                                       
    }elseif($last_type == 'Surat Peringatan Terakhir'  && $last_accumulation == 3.5 && $sel_paragraph_type_of_verse == 'Peringatan Lisan'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4.5;                               
        $select_status_type_violation = 'Surat Peringatan Pertama';                           
    }

    //Surat Peringatan Pertama
    elseif($last_type == 'Surat Peringatan Pertama'  AND $last_accumulation == 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Kedua';
        $accumulation = 2;                                   
        $select_status_type_violation = $sel_paragraph->type_of_verse;                      
    }elseif($last_type == 'Surat Peringatan Kedua'  AND $last_accumulation == 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Ketiga';
        $accumulation = 3;                                      
        $select_status_type_violation = $sel_paragraph->type_of_verse;                   
    }elseif($last_type == 'Surat Peringatan Ketiga'  AND $last_accumulation == 3 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;        
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                 
    }elseif($last_type == 'Surat Peringatan Terakhir'  AND $last_accumulation == 4 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;         
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                
    }


    //Surat Peringatan Kedua
    elseif($last_type == 'Peringatan Lisan' AND $last_accumulation == 0.5 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Kedua';
        $accumulation = 4;         
        $select_status_type_violation = 'Peringatan Lisan';                                                                            
    }
    elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation == 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Ketiga';
        $accumulation = 4;        
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                            
    }
    elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation == 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                   
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                 
    }elseif($last_type == 'Surat Peringatan Terakhir' AND $last_accumulation == 4 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;   
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                             
    }
    elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation == 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Pertama'){
        $status_type_violation = 'Surat Peringatan Ketiga';
        $accumulation = 3;                                 
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                               
    }
    elseif($last_type == 'Surat Peringatan Kedua' AND $last_accumulation == 2 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;       
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                         
    }

    // Surat Peringatan Ketiga
    elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation == 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;       
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                                                     
    }
    elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation == 3 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Kedua'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                        
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                                    
    }elseif($last_type == 'Surat Peringatan Ketiga' AND $last_accumulation == 3 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Surat Peringatan Terakhir';
        $accumulation = 4;                
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                                                                        
    }
    elseif($last_type == 'Surat Peringatan Terakhir' AND $last_accumulation == 4 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Ketiga'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;                       
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                         
    }


    // Surat Peringatan Terakhir
    elseif($last_type == 'Surat Peringatan Pertama' AND $last_accumulation == 1 AND $sel_paragraph_type_of_verse == 'Surat Peringatan Terakhir'){
        $status_type_violation = 'Pemutusan Hubungan Kerja';
        $accumulation = 5;       
        $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                         
    }
    else{
        $status_type_violation = $sel_paragraph_type_of_verse;

        if($sel_paragraph_type_of_verse == "Peringatan Lisan"){
            $accumulation = 0.5;     
            $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                           
        }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Pertama"){
            $accumulation = 1;                                      
            $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                          
        }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Kedua"){
            $accumulation = 2;                          
            $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                                      
        }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Ketiga"){
            $accumulation = 3;                          
            $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                                      
        }elseif($sel_paragraph_type_of_verse == "Surat Peringatan Terakhir"){
            $accumulation = 4;                        
            $select_status_type_violation = $sel_paragraph->type_of_verse;                                                                                                                        
        }
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
       
        // ASLINYA
        // $cari_pasal_akumulasi = DB::table('alphabets')
        //     ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
        //     ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
        //     ->where('paragraphs.type_of_verse', $status_type_violation)
        //     ->where('alphabet_accumulation', 'like', '%' . $select_status_type_violation . '%')
        //     ->first();
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
