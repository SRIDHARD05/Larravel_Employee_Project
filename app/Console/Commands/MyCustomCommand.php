<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MyCustomCommand extends Command
{
    // Define signature and options
    protected $signature = 'My:myCustomCommand';

    protected $description = 'This command processes all users and shows a progress bar.';

    public function handle()
    {
        // Fetch all users and process each user while showing a progress bar
        $users = $this->withProgressBar(User::all(), function (User $user) {
            $this->performTask($user);
        });

        // Optional: Additional message after all users have been processed
        $this->info("All users have been processed successfully.");
    }

    // A method to perform some task on each user
    protected function performTask(User $user)
    {
        // Example task: just a placeholder for the task you want to run
        // You can replace this with whatever logic you need
        // e.g., updating user information, sending notifications, etc.

        $user->update([
            'email_verified_at' => now(),
        ]);

        // Simulate a long-running task, you can remove this in production
        sleep(1); // Simulate some time-consuming task
    }
}
