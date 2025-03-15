@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="row ms-3 me-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/search') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" name="first_name" placeholder="Search First Name here..." onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" name="last_name" onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Search Second Name here...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-outline">
                                <input type="email" class="form-control" name="email" placeholder="Search Email here..." onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" name="position" placeholder="Search Position here..." onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" id="submit-search-btn">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-4 ms-3 me-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col d-flex justify-content-start">
                        <h4>Employees</h4>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button class="btn bg-gradient-success text-white btn-sm" id="employee-export-btn" style="display: none;">Export Employees</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 ms-3 me-3">
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="checkbox-all-section">
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">First Name </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Position</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $employee)
                        <tr id="{{  $employee->employer_id  }}">
                            <th>
                                <input type="checkbox" id="{{ $employee->employer_id }}" name="checkbox" value="Bike">
                            </th>
                            <form action=""></form>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->salary }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="d-flex justify-content-end">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleVisibility() {
        if ($('input[name="checkbox"]:checked').length > 0) {
            $('#employee-export-btn').css('display', 'block');
        } else {
            $('#employee-export-btn').css('display', 'none');
        }
    }

    $(document).ready(function() {
        $("#checkbox-all-section").on('change', function() {
            var isChecked = this.checked;
            $("input[type='checkbox'][name='checkbox']").prop('checked', isChecked);
            toggleVisibility();
        });

        $(document).on('change', 'input[name="checkbox"]', function() {
            toggleVisibility();
        });

        $("#employee-export-btn").on('click', function() {
            var selectedEmployees = [];

            $("input[name='checkbox']:checked").each(function() {
                var row = $(this).closest("tr");
                var employeeData = {};

                var checkboxId = $(this).attr('id');
                var data = @json($data);

                for (var i = 0; i < data.data.length; i++) {
                    if (data.data[i].employer_id == checkboxId) {

                        employeeData = data.data[i];

                        delete employeeData.employer_id;
                        employeeData.id = selectedEmployees.length + 1;
                        selectedEmployees.push(employeeData);
                    }
                }

            });

            var json = JSON.stringify(selectedEmployees, null, 2);
            var blob = new Blob([json], {
                type: "application/json"
            });

            var a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = "selected_employees.json";
            a.click();
        });


    });
</script>

@endsection