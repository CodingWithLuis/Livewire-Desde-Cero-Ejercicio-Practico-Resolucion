<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('employees.create')}}" class="btn btn-primary">Nuevo empleado</a>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Empleado</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Salario</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->name}}</td>
                                    <td>
                                        @if($employee->employee_photo)
                                        <img src="{{asset($employee->employee_photo)}}" width="100" height="100" class="img-fluid rounded">
                                        @endif
                                    </td>
                                    <td>{{$employee->employee_code}}</td>
                                    <td>{{$employee->salary}}</td>
                                    <td>{{$employee->address}}</td>
                                    <td>{{$employee->phone_number}}</td>
                                    <td>{{$employee->employee_status->name}}</td>
                                    <td>
                                        <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-success">Editar</a>
                                        <button wire:click="deleteConfirm({{$employee->id}})" type="button" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$employees->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')

@if(session('success'))
<script>
    Swal.fire({
        title: "{{session('success')}}",
        icon: 'success'
    })
</script>
@endif

<script>
    window.addEventListener('swal-confirm', event => {
        Swal.fire({
            title: event.detail.title,
            icon: event.detail.icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, quiero eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', event.detail.id);
            }
        })
    })
</script>
@endsection
