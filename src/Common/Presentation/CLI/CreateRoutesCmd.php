<?php

namespace Src\Common\Presentation\CLI;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateRoutesCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:routes {domainName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new router in the specified domain';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domainName = $this->argument('domainName');

        $path = "src/{$domainName}/Presentation/Routes/api.php";

        if (!File::exists("src/{$domainName}")) {
            $this->alert("The {$domainName} domain has not created.");

            return Command::FAILURE;
        }

        $stub = File::get('./stubs/routes.stub');

        $stubReplace = [
            '**Domain**' => $domainName,
            '**domain_lc**' => Str::plural(Str::snake($domainName)),
        ];

        if (!File::exists($path)) {
            $file = strtr($stub, $stubReplace);

            File::put($path, $file);
        } else {
            $this->alert("The routes file already created.");
        }

        return Command::SUCCESS;
    }
}
