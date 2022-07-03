<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ViolationsImport;
use App\Imports\ViolationmigrationImport;

use App\Exports\ViolationsExport;
use App\Exports\ViolationsEditExport;

use Illuminate\Support\Collection;

use Illuminate\Support\Arr;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;


class TeatViolationController extends Controller
{
    //

    public function get_type_violation(Request $request)
    {

        //ambil data employee_id, status_violant_last, violation_now, violation_id
        $employee_id = $request->id_emp;
        $status_violant_last = $request->status_violant_last;
        $violation_now = $request->violation_now;
        $last_type = $request->last_type;
        $last_accumulation = $request->last_accumulation;

        //Mencari pelanggaran saat ini
        // $sel_alphabet = DB::table('alphabets')->find($request->violation_now);
        // $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        // $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
       
        // $sel_paragraph_type_of_verse = $sel_paragraph->type_of_verse;

        //LOGIKA MENAMPILKAN DATA PASAL DAN PASAL DELIK
        
        //GET JIKA TIDAK ADA PELANGGARAN AKTIF
        // if($status_violant_last == 'notactive' OR $last_type == 'notviolation'){

        //     $status_type_violation = $sel_paragraph->type_of_verse;
        //     $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->alphabet_sound;
            
        //     $remainder1 = '-';
        //     $remainder2 = '';
                       
        //     $data = [ $status_type_violation, $pasal_yang_dilanggar, $remainder1, $remainder2];
            
        // }else{

        //     $num_vio_accumulation3 = DB::table('violations')
        //         ->where('employee_id',  $employee_id) 
        //         ->where('violation_accumulation', '!=',  null) 
        //         ->where('violation_accumulation2', '!=',  null) 
        //         ->where('violation_accumulation3', '!=',  null) 
        //         ->where('alphabet_accumulation', '!=',  null) 
        //         ->where('violation_status', 'active') 
        //         ->latest()                       
        //         ->count();

        //     if($num_vio_accumulation3 > 0){
                                
        //         // GET LOGIKA AKUMULASI KEEMPAT
        //         $get_first_vio_accumulation3 = DB::table('violations')
        //             ->where('employee_id',  $employee_id) 
        //             ->where('violation_accumulation', '!=',  null) 
        //             ->where('violation_accumulation2', '!=',  null) 
        //             ->where('violation_accumulation3', '!=',  null) 
        //             ->where('alphabet_accumulation', '!=',  null) 
        //             ->where('violation_status', 'active') 
        //             ->latest()                       
        //             ->first();

        //         $get_num_vio_accumulation3 = DB::table('violations')
        //             ->where('employee_id',  $employee_id) 
        //             ->where('violation_accumulation', $get_first_vio_accumulation3->id) 
        //             ->where('violation_status', 'active')       
        //             ->count();

        //         if($get_num_vio_accumulation3 > 0){
                
        //             // GET LOGIKA AKUMULASI PERINGATAN LISAN
        //             require_once 'GetAccumulationtest.php';

        //             $pelanggran_sebelumnya2 = DB::table('violations')
        //                 ->where('employee_id',  $employee_id) 
        //                 ->where('id',  $pelanggran_sebelumnya->violation_accumulation)  
        //                 ->latest()                       
        //                 ->first();

        //             $pelanggran_sebelumnya3 = DB::table('violations')
        //                 ->where('employee_id',  $employee_id) 
        //                 ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
        //                 ->latest()                       
        //                 ->first();

        //             require_once 'Violationjsondatas.php';
        //         }else{
        //             // BATAS AKUMULASI
        //             // CARI PELANGGARAN AKUMULASI 3               
        //             $num_vio_accumulation2 = DB::table('violations')
        //                 ->where('employee_id',  $employee_id) 
        //                 ->where('violation_accumulation', '!=',  null) 
        //                 ->where('violation_accumulation2', '!=',  null) 
        //                 ->where('alphabet_accumulation', '!=',  null) 
        //                 ->where('violation_status', 'active') 
        //                 ->latest()                       
        //                 ->count();
        //             if($num_vio_accumulation2 > 0){

        //                 // LOGIKA AKUMULSI KETIGA
        //                 $get_first_vio_accumulation2 = DB::table('violations')
        //                     ->where('violation_accumulation', '!=',  null) 
        //                     ->where('violation_accumulation2', '!=',  null) 
        //                     ->where('alphabet_accumulation', '!=',  null) 
        //                     ->where('violation_status', 'active') 
        //                     ->latest()                       
        //                     ->first();

        //                 $get_num_vio_accumulation2 = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
        //                     ->where('violation_status', 'active')       
        //                     ->count(); 
                        
        //                 if($get_num_vio_accumulation2  > 0){

        //                     require_once 'GetAccumulationtest.php';

        //                     $pelanggran_sebelumnya2 = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('id',  $pelanggran_sebelumnya->violation_accumulation) 
        //                         ->latest()                       
        //                         ->first();

        //                     $pelanggran_sebelumnya3 = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
        //                         ->latest()                       
        //                         ->first();   
        //                         require_once 'Violationjsondatas.php';
        //                 }else{

        //                     $num_vio_accumulation = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('violation_accumulation', '!=',  NULL) 
        //                         ->where('alphabet_accumulation', '!=',  NULL) 
        //                         ->where('violation_status', 'active') 
        //                         ->latest()                       
        //                         ->count();

        //                     if($num_vio_accumulation > 0){
        //                         //LOGIKA AKUMULASI KEDUA

        //                         $get_first_vio_accumulation = DB::table('violations')
        //                             ->where('employee_id',  $employee_id) 
        //                             ->where('violation_accumulation', '!=',  null) 
        //                             ->where('alphabet_accumulation', '!=',  null) 
        //                             ->where('violation_status', 'active') 
        //                             ->latest()                       
        //                             ->first();

        //                         $get_num_vio_accumulation = DB::table('violations')
        //                             ->where('employee_id',  $employee_id) 
        //                             ->where('id', $get_first_vio_accumulation->id) 
        //                             ->where('violation_status', 'active')       
        //                             ->count();

        //                         if($get_num_vio_accumulation > 0){

        //                             require_once 'GetAccumulationtest.php';

        //                             $pelanggran_sebelumnya2 = DB::table('violations')
        //                                 ->where('employee_id',  $employee_id) 
        //                                 ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
        //                                 ->latest()                       
        //                                 ->first();

        //                                 require_once 'Violationjsondatas.php';
                                    
        //                         }else{
        //                             //LOGIKA AKUMULSAI PERTAMA
        //                             require_once 'GetAccumulationtest.php';                                          

        //                             require_once 'Violationjsondata.php';   
        //                         }
        //                     }else{
        //                         //LOGIKA AKUMULSAI PERTAMA
        //                         require_once 'GetAccumulationtest.php';                                          

        //                         require_once 'Violationjsondata.php';    
        //                     }
        //                 }

        //             }else{
        //                 $num_vio_accumulation = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('violation_accumulation', '!=',  NULL) 
        //                     ->where('alphabet_accumulation', '!=',  NULL) 
        //                     ->where('violation_status', 'active') 
        //                     ->latest()                       
        //                     ->count();

        //                 if($num_vio_accumulation > 0){
        //                     //LOGIKA AKUMULASI KEDUA

        //                     $get_first_vio_accumulation = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('violation_accumulation', '!=',  null) 
        //                         ->where('alphabet_accumulation', '!=',  null) 
        //                         ->where('violation_status', 'active') 
        //                         ->latest()                       
        //                         ->first();

        //                     $get_num_vio_accumulation = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('id', $get_first_vio_accumulation->id) 
        //                         ->where('violation_status', 'active')       
        //                         ->count();

        //                         if($get_num_vio_accumulation > 0){

        //                             require_once 'GetAccumulationtest.php';

        //                             $pelanggran_sebelumnya2 = DB::table('violations')
        //                                 ->where('employee_id',  $employee_id) 
        //                                 ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
        //                                 ->latest()                       
        //                                 ->first();
                                                
        //                                 require_once 'Violationjsondatas.php';   
        //                         }else{
        //                             //LOGIKA AKUMULSAI PERTAMA
        //                             require_once 'GetAccumulationtest.php';                                          

        //                             require_once 'Violationjsondata.php';   
        //                         }
        //                 }else{
        //                     //LOGIKA AKUMULSAI PERTAMA
        //                     require_once 'GetAccumulationtest.php'; 

        //                     require_once 'Violationjsondata.php';                                         
        //                 }
        //             }
        //         }
        //     }else{
        //         // BATAS AKUMULASI
        //         // CARI PELANGGARAN AKUMULASI 3               
        //         $num_vio_accumulation2 = DB::table('violations')
        //             ->where('employee_id',  $employee_id) 
        //             ->where('violation_accumulation', '!=',  null) 
        //             ->where('violation_accumulation2', '!=',  null) 
        //             ->where('alphabet_accumulation', '!=',  null) 
        //             ->where('violation_status', 'active') 
        //             ->latest()                       
        //             ->count();
        //         if($num_vio_accumulation2 > 0){

        //             // LOGIKA AKUMULSI KETIGA
        //             $get_first_vio_accumulation2 = DB::table('violations')
        //                 ->where('violation_accumulation', '!=',  null) 
        //                 ->where('violation_accumulation2', '!=',  null) 
        //                 ->where('alphabet_accumulation', '!=',  null) 
        //                 ->where('violation_status', 'active') 
        //                 ->latest()                       
        //                 ->first();

        //             $get_num_vio_accumulation2 = DB::table('violations')
        //                 ->where('employee_id',  $employee_id) 
        //                 ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
        //                 ->where('violation_status', 'active')       
        //                 ->count(); 
                    
        //             if($get_num_vio_accumulation2  > 0){

        //                 require_once 'GetAccumulationtest.php';

        //                 $pelanggran_sebelumnya2 = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('id',  $pelanggran_sebelumnya->violation_accumulation) 
        //                     ->latest()                       
        //                     ->first();

        //                 $pelanggran_sebelumnya3 = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
        //                     ->latest()                       
        //                     ->first();   
        //                     require_once 'Violationjsondatas.php';
        //             }else{

        //                 $num_vio_accumulation = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('violation_accumulation', '!=',  NULL) 
        //                     ->where('alphabet_accumulation', '!=',  NULL) 
        //                     ->where('violation_status', 'active') 
        //                     ->latest()                       
        //                     ->count();

        //                 if($num_vio_accumulation > 0){
        //                     //LOGIKA AKUMULASI KEDUA

        //                     $get_first_vio_accumulation = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('violation_accumulation', '!=',  null) 
        //                         ->where('alphabet_accumulation', '!=',  null) 
        //                         ->where('violation_status', 'active') 
        //                         ->latest()                       
        //                         ->first();

        //                     $get_num_vio_accumulation = DB::table('violations')
        //                         ->where('employee_id',  $employee_id) 
        //                         ->where('id', $get_first_vio_accumulation->id) 
        //                         ->where('violation_status', 'active')       
        //                         ->count();

        //                     if($get_num_vio_accumulation > 0){

        //                         require_once 'GetAccumulationtest.php';

        //                         $pelanggran_sebelumnya2 = DB::table('violations')
        //                             ->where('employee_id',  $employee_id) 
        //                             ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
        //                             ->latest()                       
        //                             ->first();

        //                             require_once 'Violationjsondatas.php';
                                
        //                     }else{
        //                         //LOGIKA AKUMULSAI PERTAMA
        //                         require_once 'GetAccumulationtest.php';                                          

        //                         require_once 'Violationjsondata.php';   
        //                     }
        //                 }else{
        //                     //LOGIKA AKUMULSAI PERTAMA
        //                     require_once 'GetAccumulationtest.php';                                          

        //                     require_once 'Violationjsondata.php';    
        //                 }
        //             }

        //         }else{
        //             $num_vio_accumulation = DB::table('violations')
        //                 ->where('employee_id',  $employee_id) 
        //                 ->where('violation_accumulation', '!=',  NULL) 
        //                 ->where('alphabet_accumulation', '!=',  NULL) 
        //                 ->where('violation_status', 'active') 
        //                 ->latest()                       
        //                 ->count();

        //             if($num_vio_accumulation > 0){
        //                 //LOGIKA AKUMULASI KEDUA

        //                 $get_first_vio_accumulation = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('violation_accumulation', '!=',  null) 
        //                     ->where('alphabet_accumulation', '!=',  null) 
        //                     ->where('violation_status', 'active') 
        //                     ->latest()                       
        //                     ->first();

        //                 $get_num_vio_accumulation = DB::table('violations')
        //                     ->where('employee_id',  $employee_id) 
        //                     ->where('id', $get_first_vio_accumulation->id) 
        //                     ->where('violation_status', 'active')       
        //                     ->count();

        //                     if($get_num_vio_accumulation > 0){

        //                         require_once 'GetAccumulationtest.php';

        //                         $pelanggran_sebelumnya2 = DB::table('violations')
        //                             ->where('employee_id',  $employee_id) 
        //                             ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
        //                             ->latest()                       
        //                             ->first();
                                            
        //                             require_once 'Violationjsondatas.php';   
                                
        //                     }else{
        //                         //LOGIKA AKUMULSAI PERTAMA
        //                         require_once 'GetAccumulationtest.php';                                          

        //                         require_once 'Violationjsondata.php';   
        //                     }
        //             }else{
        //                 //LOGIKA AKUMULSAI PERTAMA
        //                 require_once 'GetAccumulationtest.php'; 

        //                 require_once 'Violationjsondata.php';                                         

        //             }

        //         }
                
        //     }
        // }

        $data = [1, 1, 1, 1];
        return response()->json($data);
    }
}
