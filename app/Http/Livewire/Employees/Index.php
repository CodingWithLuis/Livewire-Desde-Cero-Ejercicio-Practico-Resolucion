<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];

    public function render()
    {
        $employees = Employee::with('employee_status')->paginate(4);

        return view('livewire.employees.index', compact('employees'))
            ->extends('layouts.app')
            ->section('content');
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal-confirm', [
            'title' => 'Estás seguro que deseas eliminar el dato?',
            'icon' => 'warning',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        Employee::where('id', $id)->delete();
    }
}
