<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Article;
use App\Models\Paragraph;

class HiParagraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paragraphs = Paragraph::oldest();
        if(request('search_paragraph')){
            $paragraphs->where('paragraph', 'like', '%' . request('search_paragraph') . '%')
                    //   ->orWhere('article', 'like', '%' . request('search_paragraph') . '%')
                      ->orWhere('sub_chapters', 'like', '%' . request('search_paragraph') . '%')
                      ->orWhere('description', 'like', '%' . request('search_paragraph') . '%')
                      ->orWhere('type_of_verse', 'like', '%' . request('search_paragraph') . '%');
        }
        
        return view('hi.pkb.paragraphs.index', [
            'paragraphs' => $paragraphs->paginate(10),
            'articles' => Article::all(),
            // 'articles' => DB::table('articles')->get(),
            'count' => DB::table('paragraphs')->count()
             
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

        DB::table('paragraphs')->insert([
            'article_id'=> $request->article_id,
            'paragraph'=> $request->paragraph, 
            'sub_chapters'=> $request->sub_chapters,
            'description'=> $request->description,
            'type_of_verse'=> $request->type_of_verse
            ]);

        return redirect('/paragraphs/')->with('success', 'Data Ayat berhasil di tambahkan');
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
    public function edit(Paragraph $paragraph)
    {
        //
        $type_of_verse = ["Peringatan Lisan","Surat Peringatan 1","Surat Peringatan 2","Surat Peringatan 3","Surat Peringatan Terakhir","PHK Pesangon","PHK Tanpa Peesangon"];

        return view('hi.pkb.paragraphs.edit', [
            
            
            'articles' => Article::all(),
            'paragraph' => $paragraph,
            'type_of_verse' => $type_of_verse
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
        //
        DB::table('paragraphs')
            ->where('id', $id)
            ->update([
                'article_id'=> $request->article_id,
                'paragraph'=> $request->paragraph, 
                'sub_chapters'=> $request->sub_chapters,
                'description'=> $request->description,
                'type_of_verse'=> $request->type_of_verse
            ]);

        return redirect('/paragraphs/')->with('success', 'Data Ayat berhasil di Ubah');
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
}
