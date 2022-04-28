<?php

namespace App\Exports;

use App\Models\Alphabet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class AlphabetsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Alphabet::all();
        
    // }

    public function view(): View
    {
        return view('exports.alphabets.alphabets', [
            'alphabets' => Alphabet::all()
        ]);
    }
}
