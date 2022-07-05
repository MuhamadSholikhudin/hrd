<?php

    // //Mencari pelanggaran saat ini
    if($pelanggran_sebelumnya->alphabet_accumulation == null){

        $pelanggran_sebelumnya_tidak_lisan = DB::table('violations')
            ->where('employee_id',  $employee_id) 
            ->where('violation_status', 'active')
            ->where('type_of_violation', '!=', 'Peringatan Lisan')
            ->latest()                       
            ->first();
        if($pelanggran_sebelumnya_tidak_lisan->alphabet_accumulation != null){
            $sel2_alphabet = DB::table('alphabets')->find($pelanggran_sebelumnya_tidak_lisan->alphabet_accumulation);
            $sel2_paragraph = DB::table('paragraphs')->find($sel2_alphabet->paragraph_id);
            $sel2_article = DB::table('articles')->find($sel2_paragraph->article_id);

            // $status_type_violation = $sel_paragraph->type_of_verse;
            $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" '. $cari_pasal_akumulasi->alphabet_sound;

            $remainder1 = 'Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal '

            . $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet .
            '" ' .  $sel_alphabet->alphabet_sound ;                 
            
            $remainder2 = 'Dalam masa ' . $last_type . ' Perjanjian Kerja Bersama Pasal '
                
            // Pasal akumulasi
            . $sel2_article->article.' ayat ('.$sel2_paragraph->paragraph .') huruf "'. $sel2_alphabet->alphabet
            
            .'". Perjanjian Kerja Bersama Pasal '

            // pasal pelanggaran sebelumnya
            . $cari_pasal_sebelumnya->article . ' ayat ('. $cari_pasal_sebelumnya->paragraph. ') huruf "'.$cari_pasal_sebelumnya->alphabet.'". '

            // .$cari_pasal_sebelumnya->alphabet_sound
            
            // keterangan pelanggaran sebelumnya
            .' ' .$pelanggran_sebelumnya->other_information . ' '
            .$pelanggran_sebelumnya2->other_information
            ;

        }else{
            $sel2_alphabet = DB::table('alphabets')->find($pelanggran_sebelumnya_tidak_lisan->alphabet_id);
            $sel2_paragraph = DB::table('paragraphs')->find($sel2_alphabet->paragraph_id);
            $sel2_article = DB::table('articles')->find($sel2_paragraph->article_id);

            // $status_type_violation = $sel_paragraph->type_of_verse;
            $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" '. $cari_pasal_akumulasi->alphabet_sound;

            $remainder1 = 'Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal '

            . $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet .
            '" ' .  $sel_alphabet->alphabet_sound ;                 
            
            $remainder2 = 'Dalam masa ' . $last_type . ' Perjanjian Kerja Bersama Pasal '
                
            // Pasal akumulasi
            . $sel2_article->article.' ayat ('.$sel2_paragraph->paragraph .') huruf "'. $sel2_alphabet->alphabet
            
            .'". Perjanjian Kerja Bersama Pasal '

            // pasal pelanggaran sebelumnya
            . $cari_pasal_sebelumnya->article . ' ayat ('. $cari_pasal_sebelumnya->paragraph. ') huruf "'.$cari_pasal_sebelumnya->alphabet.'". '

            // .$cari_pasal_sebelumnya->alphabet_sound
            
            // keterangan pelanggaran sebelumnya
            .' ' .$pelanggran_sebelumnya->other_information . ' '
            .$pelanggran_sebelumnya2->other_information
            ;

        }



    }else{
        $sel2_alphabet = DB::table('alphabets')->find($pelanggran_sebelumnya->alphabet_accumulation);
        $sel2_paragraph = DB::table('paragraphs')->find($sel2_alphabet->paragraph_id);
        $sel2_article = DB::table('articles')->find($sel2_paragraph->article_id);

        // $status_type_violation = $sel_paragraph->type_of_verse;
        $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" '. $cari_pasal_akumulasi->alphabet_sound;

        $remainder1 = 'Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal '

        . $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet .
        '" ' .  $sel_alphabet->alphabet_sound ;                 
        
        $remainder2 = 'Dalam masa ' . $last_type . ' Perjanjian Kerja Bersama Pasal '
            
        // Pasal akumulasi
        . $sel2_article->article.' ayat ('.$sel2_paragraph->paragraph .') huruf "'. $sel2_alphabet->alphabet
        
        .'". Perjanjian Kerja Bersama Pasal '

        // pasal pelanggaran sebelumnya
        . $cari_pasal_sebelumnya->article . ' ayat ('. $cari_pasal_sebelumnya->paragraph. ') huruf "'.$cari_pasal_sebelumnya->alphabet.'". '

        // .$cari_pasal_sebelumnya->alphabet_sound
        
        // keterangan pelanggaran sebelumnya
        .' ' .$pelanggran_sebelumnya->other_information . ' '
        .$pelanggran_sebelumnya2->other_information
        ;
    }

    if($status_type_violation == "Peringatan Lisan"){
        $data = [ $status_type_violation, $pasal_yang_dilanggar, "-", "-"]; 
    }elseif($status_type_violation_akhir == "Peringatan Lisan" AND $pelanggaran_sekarang !== "Peringatan Lisan"){
        $data = [ $status_type_violation, $pasal_yang_dilanggar, "-", "-"];         
    }else{
        $data = [ $status_type_violation, $pasal_yang_dilanggar, $remainder1, $remainder2]; 
    }