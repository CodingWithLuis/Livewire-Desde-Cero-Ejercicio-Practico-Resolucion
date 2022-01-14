<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar empleado</div>

                    <div class="card-body">
                        <form wire:submit.prevent="submit">

                            <div class="form-group mb-2">
                                <label>Nombre del empleado</label>
                                <input type="text" wire:model.defer="employee.name" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}">
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label>Codigo del empleado</label>
                                <input type="text" wire:model.defer="employee.employee_code" name="employee_code" class="form-control {{$errors->has('employee_code') ? 'is-invalid' : ''}}">
                                <div class="text-danger">
                                    {{ $errors->first('employee_code') }}
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label>Foto del Empleado</label>
                                <input type="file" wire:model.defer="employee_photo" name="employee_photo" class="form-control {{$errors->has('employee_photo') ? 'is-invalid' : ''}}">
                                <div class="text-danger">
                                    {{ $errors->first('employee.employee_photo') }}
                                </div>

                                @if($employee_photo)
                                <h3 class="mt-3">Visualización de Imagen</h3>

                                <img src="{{$employee_photo->temporaryUrl()}}" class="img-fluid" width="100" height="100" />
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <label>Direccion</label>
                                <input type="text" wire:model.defer="employee.address" name="address" class="form-control {{$errors->has('address' ? 'is-invalid' : '')}}">
                                <div class="text-danger">
                                    {{ $errors->first('address') }}
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label>Telefono</label>
                                <input type="text" wire:model.defer="employee.phone_number" name="phone_number" class="form-control {{$errors->has('phone_number') ? 'is-invalid' : ''}}">

                                <div class="text-danger">
                                    {{ $errors->first('phone_number') }}
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label>Salario</label>
                                <input type="number" wire:model.defer="employee.salary" name="salary" class="form-control {{$errors->has('salary') ? 'is-invalid' : ''}}">
                                <div class="text-danger">
                                    {{ $errors->first('salary') }}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div wire:ignore>
                                    <label>Estado del empleado</label>
                                    <select class="form-control select2" wire:model.defer="employee.employee_status_id">
                                        <option>Seleccione</option>
                                        @foreach($statuses as $key => $status)
                                        <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger">
                                    {{ $errors->first('employee.employee_status_id') }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Editar empleado</button>
                            <a href="{{route('employees.index')}}" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2()

        $('.select2').on('change', function() {
            @this.set('employee.employee_status_id', $(this).val())
        })
    })
</script>
@endsection
