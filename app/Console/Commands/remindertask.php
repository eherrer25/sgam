<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class remindertask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recordatorio alarma';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        $users->map(function($user){
            $messages = GetThreadMessages::new($user);

            $user->notify(new \App\Notifications\ReminderTask($messages, $user));
        });
    }
}
