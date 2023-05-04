<?php

namespace Src\Common\Presentation\CLI;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateDomainCmd extends Command
{
    protected readonly string $basePath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {domainName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new domain directory structure';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $domainName = $this->argument('domainName');

            $this->basePath = "src/{$domainName}";

            $dirs = [
                'Application',
                'Domain',
                'Infrastructure',
                'Presentation'
            ];

            foreach ($dirs as $dir) {
                $this->{"make{$dir}Dirs"}();
            }
        } catch (\Exception $exception) {
            $this->alert($exception->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function makeApplicationDirs()
    {
        $applicationStructure = [
            'Common/Behaviours',
            'Common/Exceptions',
            'Common/Interfaces',
            'Common/Mapping',
            'Common/Models',
            'Common/Security',
            'Items/Queries',
            'Items/Commands',
            'List/Queries',
            'List/Commands',
            'Events',
            'Exceptions',
            'Providers',
        ];

        $this->mkdirs('Application', $applicationStructure);
    }

    protected function makeDomainDirs()
    {
        $domainStructure = [
            'Common',
            'Entities',
            'Enums',
            'Events',
            'Exceptions',
            'ValueObjects'
        ];

        $this->mkdirs('Domain', $domainStructure);
    }

    protected function makeInfraStructureDirs()
    {

        $infrastructureStructure = [
            'Common',
            'Files',
            'Identity',
            'Persistence',
            'Services',
        ];

        $this->mkdirs('Infrastructure', $infrastructureStructure);
    }

    protected function makePresentationDirs()
    {
        $presentationStructure = [
            'Routes',
            'Middlewares',
            'Requests',
            'Controllers'
        ];

        $this->mkdirs('Presentation', $presentationStructure);
    }

    protected function mkdirs($mainDir, array $dirs)
    {
        foreach ($dirs as $dir) {
            $path = "{$this->basePath}/{$mainDir}/{$dir}";

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }
    }
}
