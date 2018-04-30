<?php

namespace App\Console\Commands\User;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates admin user';

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
        Log::debug('user:create command started');
        $email = $this->ask('Provide email');
        $password = $this->secret('Provide password');

        $user = User::create([
            'name' => $email,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $this->line('User created. You can login now');
        Log::info('User created', [$user]);
    }
}
