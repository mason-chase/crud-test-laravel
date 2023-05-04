<?php

namespace Src\Common\Presentation\CLI;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateControllerCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:controller {domainName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller in the specified domain';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domainName = $this->argument('domainName');

        $path = "src/{$domainName}/Presentation/Controllers/{$domainName}Controller.php";

        if (!File::exists("src/{$domainName}")) {
            $this->alert("The {$domainName} domain has not created.");

            return Command::FAILURE;
        }

        $stub = File::get('./stubs/controller.stub');

        $stubReplace = [
            '**Domain**' => $domainName,
            '**domain_lc**' => Str::snake($domainName),
        ];

        if (!File::exists($path)) {
            $file = strtr($stub, $stubReplace);

            File::put($path, $file);
        } else {
            $this->alert("The {$domainName}Controller already created.");
        }

        return Command::SUCCESS;
    }
}

{

}
