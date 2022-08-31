<?php

namespace App\Console\Commands;

use App\Services\Contracts\UserManagerInterface;
use Illuminate\Console\Command;

class CreateNewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command used to register a new user by CLI.';


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
     * @param UserManagerInterface $userManager
     * @return void
     */
    public function handle(UserManagerInterface $userManager): void
    {
        $name = $this->ask('What is your name?');

        $email = $this->ask('What is your email?');

        $password = $this->secret('Enter the user password.');

        if ($this->confirm('Do you wish to continue?', true)) {
            try {
                $userManager->create(['name' => $name, 'email' => $email, 'password' => $password]);

                $this->info('User registered successfully.');
            }catch (\Exception $exception){
                $this->error('An error occurred while trying to register a user on the system.');
            }
        }
    }
}
