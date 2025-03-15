<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MyCustomCommand extends Command
{
    // Define signature and options
    protected $signature = 'My:myCustomCommand';

    protected $description = 'This command processes all users and shows a progress bar.';


    public function handle()
    {
        Log::info("My custom Command Has Been Tested Successfullt" . now());
    }

    // public function handle()
    // {
    //     $users = $this->withProgressBar(User::all(), function (User $user) {
    //         $this->performTask($user);
    //     });

    //     $this->info("All users have been processed successfully.");
    // }

    // protected function performTask(User $user)
    // {
    //     $user->update([
    //         'email_verified_at' => now(),
    //     ]);

    //     // usleep(500000);
    // }
}
