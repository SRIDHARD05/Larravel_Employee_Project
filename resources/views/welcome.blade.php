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
    <form action="{{ url('/') }}" method="get">
        <div class="container mx-auto px-4">
            <h1 class="d-flex justify-content-center">Employee Modal</h1>
        </div>
    </form>
    <br><br><br>
    <hr>
    <button id="submit-btn">Submit</button>
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
                            <input type="checkbox" id="{{ $employee->id }}" name="{{ $employee->id }}" value="Bike">
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
   

</body>

</html>