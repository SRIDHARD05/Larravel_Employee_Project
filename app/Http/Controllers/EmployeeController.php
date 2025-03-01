<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function search(Request $request)
    {

        $search = $request->input('search');
        $query = Employee::query();

        if ($search) {

            $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
        }

        $data = $query->paginate(10);
        return view('search', compact('data', 'search'));
    }

    public function index()
    {
        $query = Employee::query();
        $data = Employee::orderBy('id')->cursorPaginate(10);

        return view('welcome', compact('data'));
       
    }
}
