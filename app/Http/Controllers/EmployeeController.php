<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Notifications\ProfileUpdated;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;


class EmployeeController extends Controller
{

    public function index(): View
    {
        $query = Employee::query();
        $data = Employee::orderBy('id')->cursorPaginate(10);

        return view('welcome', compact('data'));
    }

    public function search(Request $request): View
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');
        $position = $request->input('position');

        $employees = Employee::query();

        if ($firstName) {
            $employees = $employees->where('first_name', 'like', '%' . $firstName . '%');
        }
        if ($lastName) {
            $employees = $employees->where('last_name', 'like', '%' . $lastName . '%');
        }
        if ($email) {
            $employees = $employees->where('email', 'like', '%' . $email . '%');
        }
        if ($position) {
            $employees = $employees->where('position', 'like', '%' . $position . '%');
        }

        $data = $employees->paginate(10);

        return view('search', compact('data'));
    }

    public function templates(): View
    {
        return view('templates');
    }
    public function welcome(Request $request)
    {
        return view('test');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('dashboard');
    }
    public function register(Request $request)
    {
        return view('register');
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function register_store(Request $request)
    {
        $agree = $request->has('agree');
        if ($agree) {
            $cred = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:5|confirmed',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $cred['password'] = bcrypt($cred['password']);

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'agree' => 'You must agree to the terms and conditions to proceed.',
            ]);
        }
    }
    public function login_store(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $email = $request->input('email');

        if (Auth::attempt($credentials, $request->input('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials provided.']);
        }
    }

    public function users(RoleService $roleService)
    {
        // $data = $roleService->viewUser(2);
        // dd($data);
        // dd(session()->all());
        // dd(gettype((string) Str::uuid()));
        // $username = Auth::user()->name;
        // $email = Auth::user()->email;
        // Log::info("User -> {$username} has been succesfully created");
        // Log::info("Username -> {$username} and Email -> {$email}");

        // dd(Log::warning('There is a critical bug inside the employee controller'));
        // Log::channel('slack')->info('registeration successful');
        $logFiles = glob(storage_path('logs/*.log'));
        foreach ($logFiles as $logFile) {
            echo "Logs from: " . basename($logFile) . "\n";
            echo nl2br(file_get_contents($logFile));
            echo "\n\n";
        }
    }

    public function cache(Request $request)
    {
        $user = auth()->user();
        $action = 'Profile Updated';
        $user->notify(new ProfileUpdated($user, $action));

        return view('cache');
    }


    public function showNotifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications;

        $unreadNotifications = $user->unreadNotifications;

        return view('profile.notifications', [
            'notifications' => $notifications,
            'unread' => $unreadNotifications
        ]);
    }

    public function read($id, Response $response)
    {
        // auth()->user()->notifications->where('id', $id)->markAsRead();
        auth()->user()->unreadNotifications->markAsRead();

        dd($id);


        // $locale = App::currentLocale();

        // if (App::isLocale('en')) {
        //     dd("Hello world");
        // }
    }

    public function process()
    {
        $process = new Process(['dir']);
        $process->run();

        if ($process->isSuccessful()) {
            dd($process->getOutput());
        } else {
            dd('Error: ' . $process->getErrorOutput());
        }
    }
}
