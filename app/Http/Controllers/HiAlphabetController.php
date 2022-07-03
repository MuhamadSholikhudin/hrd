<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\AlphabetsExport;

use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Alphabet;


class HiAlphabetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alphabets = Alphabet::oldest();
        if(request('search_alphabets')){
            $alphabets->where('alphabet', 'like', '%' . request('search_alphabets') . '%')
                      ->orWhere('alphabet_sound', 'like', '%' . request('search_alphabets') . '%')
                      ->orWhere('last_periode', 'like', '%' . request('search_alphabets') . '%')
                      ->orWhere('firts_periode', 'like', '%' . request('search_alphabets') . '%');
                    //   ->orWhere('article_sound', 'like', '%' . request('search') . '%');
        }

        $alphabets_accumulation = [
            "Peringatan Lisan",
            "Surat Peringatan Pertama",
            "Surat Peringatan Kedua",
            "Surat Peringatan Ketiga",
            "Surat Peringatan Terakhir",
            "Pemutusan Hubungan Kerja"
            // ,
            // "PHK Tanpa Pesangon",
            // "PHK Pesangon"
        ];
        
        return view('hi.pkb.alphabets.index', [
            
            
            'alphabets' => $alphabets->paginate(10)->withQuerystring(),
            'paragraphs' => Paragraph::all(),
            'alphabets_accumulation' => $alphabets_accumulation,
            'count' => DB::table('alphabets')->count()
             
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->alphabet_accumulation);
        
        if($request->alphabet_accumulation == null){
            $implode = '';
        }else{
            $implode = implode(",", $request->alphabet_accumulation);
        }


        DB::table('alphabets')->insert([
            'alphabet'=> $request->alphabet,
            'alphabet_sound'=> $request->alphabet_sound,
            'paragraph_id'=> $request->paragraph_id,
            'alphabet_type'=> $request->alphabet_type,
            'alphabet_accumulation' => $implode, 
            'alphabet_status' => 1, 
            'firts_periode'=> $request->firts_periode,
            'last_periode'=> $request->last_periode
            ]);
        
            
            $remark = "menambahkan huruf ".$request->alphabet;
            $action = "add";
    
            DB::table('histories')->insert([
                'user_id' => auth()->user()->id,
                'role_id' => auth()->user()->role_id,
                'remark' => $remark,
                'action' => $action,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect('/alphabets/')->with('success', 'Data Huruf berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alphabet $alphabet)
    {
        //

        $alphabet_status = ["active" => 1, "Not active" => 0];

        
        $alphabets_accumulation = [
            "Peringatan Lisan",
            "Surat Peringatan Pertama",
            "Surat Peringatan Kedua",
            "Surat Peringatan Ketiga",
            "Surat Peringatan Terakhir",
            "Pemutusan Hubungan Kerja"
        ];

        return view('hi.pkb.alphabets.edit', [
            'alphabet' => $alphabet,
            'alphabet_status' => $alphabet_status,
            'alphabets_accumulation' => $alphabets_accumulation,
            'paragraphs' => Paragraph::all()
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->alphabet_type == null){
            $alphabet_accumulation = '';
            $alphabet_type = '';
            
        }elseif($request->alphabet_type == 'accumulation'){
            if($request->alphabet_accumulation == null){
                $alphabet_accumulation = '';
                $alphabet_type = '';                
            }else{
                $alphabet_accumulation = implode(",", $request->alphabet_accumulation);
                $alphabet_type = 'yes';
            }
        }elseif($request->alphabet_type == 'no'){
            $alphabet_accumulation = '';
            $alphabet_type = '';
        }

        //
        DB::table('alphabets')
            ->where('id', $request->id)
            ->update([
                'alphabet'=> $request->alphabet,
                'alphabet_sound'=> $request->alphabet_sound,
                'paragraph_id'=> $request->paragraph_id, 
                'firts_periode'=> $request->firts_periode,
                'last_periode'=> $request->last_periode,
                'alphabet_type'=> $alphabet_type,
                'alphabet_accumulation'=> $alphabet_accumulation,
                'alphabet_status'=> $request->alphabet_status
            ]);

            $remark = "mengubah huruf ".$request->alphabet;
            $action = "update";
    
            DB::table('histories')->insert([
                'user_id' => auth()->user()->id,
                'role_id' => auth()->user()->role_id,
                'remark' => $remark,
                'action' => $action,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return redirect('/alphabets/')->with('success', 'Data Huruf berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function export() 
    {
        return Excel::download(new AlphabetsExport, 'Alphabets.xlsx');
    }
}



