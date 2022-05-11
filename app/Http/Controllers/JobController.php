<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::latest();

        if(request('search')){
            $jobs->where('code_job_level', 'like', '%' . request('search') . '%')
                      ->orWhere('job_level', 'like', '%' . request('search') . '%');
        }

        return view('jobs.index', [
            
            
            'jobs' => $jobs->paginate(15)
             
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
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validatedData =  $request->validate([
            'code_job_level' => ['required', 'unique:jobs'],
            'job_level' => 'required',
            'level' => 'required'
        ]);

        Job::create($validatedData);
        return redirect('/jobs')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('jobs.show', [
            
            
            'job' => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
        return view('jobs.edit', [
            
            
            'job' => $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
        $rules =  [
            'code_job_level' => ['required', 'unique:jobs'],
            'job_level' => 'required',
            'level' => 'required'
        ];
        $validatedData = $request->validate($rules);
        Job::where('id', $job->id)
                ->update($validatedData);
        return redirect('/jobs')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
        Job::destroy($job->id);
        return redirect('/jobs')->with('success', 'Post has been deleted!');
    }
}
