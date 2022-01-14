<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use App\Models\EmployeeStatus;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $employee_code;
    public $salary;
    public $address;
    public $phone_number;
    public $employee_photo;
    public $employee_status_id;
    public $statuses;

    public function mount()
    {
        $this->statuses = EmployeeStatus::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.employees.create')
            ->extends('layouts.app')
            ->section('content');
    }

    public function save()
    {
        $data = $this->validate();

        $employee_photo = $this->employee_photo ? 'storage/' . $this->employee_photo->store('employees', 'public') : null;

        Employee::create([
            'employee_photo' => $employee_photo
        ] + $data);

        $this->reset();

        return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente');
    }

    protected $rules = [
        'name' => [
            'required'
        ],
        'employee_code' => [
            'required'
        ],
        'salary' => [
            'required',
            'numeric'
        ],
        'address' => [
            'required'
        ],
        'phone_number' => [
            'nullable',
            'string'
        ],
        'employee_photo' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg'
        ],
        'employee_status_id' => [
            'required'
        ]
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio',
        'employee_code.required' => 'El codigo del empleado es obligatorio',
        'salary.required' => 'El salario es un campo obligatorio',
        'salary.numeric' => 'Debe ingresar valores numericos',
        'address.required' => 'La direccion es un campo obligatorio',
        'employee_photo.image' => 'Debe subir una imagen',
        'employee_photo.mimes' => 'Los formatos aceptados son: png, jpg, jpeg',
        'employee_status_id.required' => 'El estado del empleado es obligatorio',
    ];
}
