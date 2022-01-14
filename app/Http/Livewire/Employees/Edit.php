<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use App\Models\EmployeeStatus;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Employee $employee;

    public $employee_photo;
    public $statuses;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;

        $this->statuses = EmployeeStatus::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.employees.edit')
            ->extends('layouts.app')
            ->section('content');
    }

    public function submit()
    {
        $data = $this->validate();

        $employee_photo = $this->employee_photo ? 'storage/' . $this->employee_photo->store('employees', 'public') : null;

        $this->employee->update(['employee_photo' => $employee_photo] + $data);

        return redirect()->route('employees.index')->with('success', 'Empleado editado exitosamente');
    }

    protected $rules = [
        'employee.name' => [
            'required'
        ],
        'employee.employee_code' => [
            'required'
        ],
        'employee.salary' => [
            'required',
            'numeric'
        ],
        'employee.address' => [
            'required'
        ],
        'employee.phone_number' => [
            'nullable',
            'string'
        ],
        'employee_photo' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg'
        ],
        'employee.employee_status_id' => [
            'nullable',
            'exists:employee_statuses,id',
        ]
    ];

    protected $messages = [
        'employee.name.required' => 'El nombre es obligatorio',
        'employee.employee_code.required' => 'El codigo del empleado es obligatorio',
        'employee.salary.required' => 'El salario es un campo obligatorio',
        'employee.salary.numeric' => 'Debe ingresar valores numericos',
        'employee.address.required' => 'La direccion es un campo obligatorio',
        'employee.employee_photo.image' => 'Debe subir una imagen',
        'employee.employee_photo.mimes' => 'Los formatos aceptados son: png, jpg, jpeg',
        'employee.employee_status_id.required' => 'El estado del empleado es obligatorio',
    ];
}
