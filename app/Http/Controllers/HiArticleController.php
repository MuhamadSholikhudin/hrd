<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use App\Models\Article;

class HiArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
                //
                $articles = Article::oldest();
                if(request('search_articles')){
                    $articles->where('article', 'like', '%' . request('search_paragraph') . '%')
                              ->orWhere('chapters', 'like', '%' . request('search_paragraph') . '%')
                              ->orWhere('article_sound', 'like', '%' . request('search_paragraph') . '%');
                }
                
                return view('hi.pkb.articles.index', [
                    
                    
                    'articles' => $articles->paginate(10),
                    // 'articles' => DB::table('articles')->get(),
                    'count' => DB::table('articles')->count()
                     
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
        DB::table('articles')->insert([
                'article'=> $request->article,
                'chapters'=> $request->chapters,
                'article_sound'=> $request->article_sound
            ]);
            $remark = "menambahkan pasal ".$request->article;
            $action = "add";
    
            DB::table('histories')->insert([
                'user_id' => auth()->user()->id,
                'role_id' => auth()->user()->role_id,
                'remark' => $remark,
                'action' => $action,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return redirect('/articles/')->with('success', 'Data Huruf berhasil di tambahkan');

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
    public function edit(Article $article)
    {
        //
        return view('hi.pkb.articles.edit', [
            
            
            'article' => $article
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
        DB::table('articles')
        ->where('id', $request->id)
            ->update([
            'article'=> $request->article,
            'chapters'=> $request->chapters,
            'article_sound'=> $request->article_sound
        ]);

        $remark = "mengubah pasal ".$request->article;
        $action = "update";

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    return redirect('/articles/')->with('success', 'Data Pasal berhasil di Update');

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
