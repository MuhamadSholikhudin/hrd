<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class HistoryDatatables extends LivewireDatatable
{
    public $model = Employee::class;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),
  
            Column::name('name')
                ->label('Name'),
  
            Column::name('number_of_employees'),
  
            DateColumn::name('created_at')
                ->label('Creation Date')
        ];
    }
}




/* Aslinya
class HistoryDatatables extends Component
{
    public function render()
    {
        return view('livewire.history-datatables');
    }
}
*/
