<?php

namespace Mihatori\CodeigniterVite\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Publisher\Publisher;
use Throwable;

class Init extends BaseCommand
{
    protected $group        = 'Modules';
    protected $name         = 'vite:init';
    protected $description  = 'Initialize codeigniter vite module';

    /**
     * @var string
     */
    private string $framework;


    /**
     *  Module path
     * 
     * @var string
     */
    private $path;

    public function __construct()
    {
        $this->path = service('autoloader')->getNamespace('Mihatori\\CodeigniterVite')[0];
    }

    public function run(array $params)
    {
        # Module start.
        CLI::write('Installing Codeigniter Vite Plugin 🔥⚡', 'white', 'cyan');
        CLI::newLine();

        # Set framework.
        $this->framework = $params['framework'] ?? CLI::prompt('Choose a framework: ', ['none', 'vue', 'react', 'svelte']);
        CLI::newLine();

        # First, what if user select a none supported framework ?!
        # if that's true, return an error message with available frameworks.
        if (!in_array($this->framework, ['none', 'vue', 'react', 'svelte']))
        {
            CLI::error("❌ Sorry, but $this->framework is not supported!");
            CLI::error('Available frameworks are: ' . CLI::color('vue, react and svelte', 'green'));
            CLI::newLine();
            return;
        }

        # Now let's generate vite necesary files (vite.config.js, package.json & resources direction).
        $this->generateFrameworkFiles();

        # Update .env file.
        $this->updateEnvFile();

        # Everything is ready now.
        CLI::write('Codeigniter vite has succussfuly installed ✅', 'green');
        CLI::newLine();
        CLI::write('run: npm install && npm run dev');
        CLI::newLine();
    }

    /**
     * Generate vite files (vite.config.js, package.json & resources)
     * 
     * @return void
     */
    private function generateFrameworkFiles()
    {
        CLI::write('⚡ Generating vite files...', 'yellow');
        CLI::newLine();

        # Framework files.
        $paths = ['vite.config.js', 'package.json', 'resources'];

        if ($this->framework === 'none')
        {
            $publisher = new Publisher($this->path . 'Config/default', ROOTPATH);
        }
        else
        {
            $publisher = new Publisher($this->path . "Config/$this->framework", ROOTPATH);
        }

        # Publish them.
        try
        {
            $publisher->addPaths($paths)->merge(true);
        }
        catch (Throwable $e)
        {
            $this->showError($e);
            return;
        }

        CLI::write('Vite files are ready ✅', 'green');
        CLI::newLine();
    }

    /**
     * Set vite configs in .env file
     * 
     * @return void
     */
    private function updateEnvFile()
    {
        CLI::write('Updating .env file...', 'yellow');

        # Get the env file.
        $envFile = ROOTPATH . '.env';

        # Does exist? if not, generate it =)
        if (is_file($envFile))
        {
            # But first, let's take a backup.
            copy($envFile, $envFile . 'BACKUP-' . time());

            # Get .env.default content
            $content = file_get_contents($this->path . 'Config/env.default');

            # Append it.
            file_put_contents($envFile, "\n\n$content", FILE_APPEND);
        }
        else
        {
            # As we said before, generate it.
            copy($this->path . 'Config/env.default', ROOTPATH . '.env');
        }

        # Define framework.
        if ($this->framework !== 'none')
        {
            # Get .env content.
            $envContent = file_get_contents($envFile);

            # Set framework.
            $updates = str_replace("VITE_FRAMEWORK='none'", "VITE_FRAMEWORK='$this->framework'", $envContent);

            # React entry file (main.jsx).
            if ($this->framework !== 'react')
            {
                $updates = str_replace("VITE_ENTRY_FILE='main.js'", "VITE_ENTRY_FILE='main.jsx'", $envContent);
            }

            file_put_contents($envFile, $updates);
        }

        # env updated.
        CLI::newLine();
        CLI::write('.env file updated ✅', 'green');
        CLI::newLine();
    }
}
