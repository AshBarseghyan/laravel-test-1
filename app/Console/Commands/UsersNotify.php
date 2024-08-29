<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UsersNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to all users having role as admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::role('admin')->get();

        foreach ($users as $user) {

            $this->info('Sending email notification to ' . $user->email);

            Mail::to($user->email)->queue(new \App\Mail\UsersNotify($user));
        }
    }
}
