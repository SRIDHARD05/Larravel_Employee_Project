<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <br><br>
    <form action="{{ url('/search') }}" method="get">
        <div class="container mx-auto px-4">
            <div class="row">
                <div class="col col-3">
                    <label for="employee-search">First Name</label>
                    <input type="text" name="first_name" placeholder="Search items..." value="{{ $search ?? '' }}">
                </div>
                <div class="col col-3">
                    <label for="employee-search">Last Name</label>
                    <input type="text" name="last_name" placeholder="Search items..." value="{{ $search ?? '' }}">
                </div>
                <div class="col col-3">
                    <label for="employee-search">Email</label>
                    <input type="text" name="email" placeholder="Search items..." value="{{ $search ?? '' }}">
                </div>
                <div class="col col-3">
                    <label for="employee-search">position</label>
                    <input type="text" name="position" placeholder="Search items..." value="{{ $search ?? '' }}">
                </div>
            </div>
            <div class="row">
                <button class="search-submit-btn bg-primary">Search</button>
            </div>
        </div>
    </form>
    <br>
    <hr>
    <button id="submit-btn">Submit</button>
    <hr>
    <div class="container mx-auto px-4">
        <div class="table-none md:table-fixed ...">
            <table class="table-fixed">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="checkbox-all-section">
                        </th>
                        <th>#</th>
                        <th>First Name </th>
                        <th>Last name</th>
                        <th>email</th>
                        <th> position</th>
                        <th>salary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $employee)
                    <tr id="{{ $employee->id }}">
                        <th>
                            <input type="checkbox" id="{{ $employee->id }}" name="checkbox" value="Bike">
                        </th>
                        <th>{{ $employee->id  }}</th>
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

            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#checkbox-all-section").on('change', function() {
                if (this.checked) {
                    $("input[type='checkbox']").prop('checked', true);
                } else {
                    $("input[type='checkbox']").prop('checked', false);
                }
            });

        });
        $(document).ready(function() {
            $("#submit-btn").on('click', function() {
                var selectedEmployees = [];

                $("input[name='checkbox']:checked").each(function() {
                    var row = $(this).closest("tr");
                    var employeeData = {};

                    var checkboxId = $(this).attr('id');
                    if (checkboxId) {
                        employeeData.id = checkboxId;
                    }

                    employeeData.first_name = row.find("td").eq(0).text().trim();
                    employeeData.last_name = row.find("td").eq(1).text().trim();
                    employeeData.email = row.find("td").eq(2).text().trim();
                    employeeData.position = row.find("td").eq(3).text().trim();
                    employeeData.salary = row.find("td").eq(4).text().trim();

                    selectedEmployees.push(employeeData);
                });

                console.log("Selected Employees Data:", selectedEmployees);
            });
        });
    </script>
</body>

</html>