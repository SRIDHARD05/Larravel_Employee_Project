<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body>
    <br><br>
    <form action="{{ url('/') }}" method="get">
        <div class="container mx-auto px-4">
            <label for="employee-search">Search </label>
            <input type="text" name="search" placeholder="Search items..." value="{{ $search ?? '' }}">
        </div>
    </form>
    <br><br><br>
    <hr>
    <div class="container mx-auto px-4">
        <div class="table-none md:table-fixed ...">
            <table class="table-fixed">
                <thead>
                    <tr>
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
                    <tr>
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
                {{ $data->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</body>

</html>