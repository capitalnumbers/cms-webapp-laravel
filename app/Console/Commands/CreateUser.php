<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Auth\RegisterController;


class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        echo $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $auth = new RegisterController();

        $auth->create(['name'=>$name, 'email'=>$email,  'password'=>$password]);

        echo 'Successfully created user ' . $name. ' and ';
        echo 'password '.$password;
    }
}
