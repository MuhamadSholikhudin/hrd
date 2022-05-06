<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Violation;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $users = User::get();
  
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ]; 
            
        $pdf = PDF::loadView('myPDF', $data);
     
        return $pdf->download('itsolutionstuff.pdf');
    }


    public function violationPDF(Request $request)
    {
        $violations = DB::table('violations')
                // ->where('id', $request->awal)
                ->whereBetween('id', [$request->awal, $request->akhir])
                ->get();
  
                // dd($request->awal);
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'violations' => $violations
        ]; 
            
        $pdf = PDF::loadView('hi.violations.violationPDF', $data);
     
        return $pdf->download('pelanggaran'.date('m/d/Y').'.pdf');
    }
}


