<?php

namespace Mihatori\CodeigniterVite\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Publisher\Publisher;
use Throwable;

class Init extends BaseCommand
{
    protected $group        = 'CodeIgniter Vite';
    protected $name         = 'vite:init';
    protected $description  = 'Initialize codeigniter vite package';

    /**
     * @var string
     */
    private string $framework;

    private array $supportedFrameworks = ['none', 'react', 'vue', 'svelte', 'sveltekit'];

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
        CLI::write('Initializing Codeigniter Vite Package 🔥⚡', 'white', 'cyan');
        CLI::newLine();

        # Set framework.
        $this->framework = $params['framework'] ?? CLI::prompt('Choose a framework: ', $this->supportedFrameworks);
        CLI::newLine();

        # But, what if user select a none supported framework ?!
        # if that's true, return an error message with available frameworks.
        if (!in_array($this->framework, $this->supportedFrameworks))
        {
            CLI::error("❌ Sorry, but $this->framework is not supported!");
            CLI::error('Available frameworks are: ' . CLI::color(implode(', ', $this->supportedFrameworks), 'green'));
            CLI::newLine();
            return;
        }

        # Now let's generate vite necesary files (vite.config.js, package.json ...etc).
        $this->generateFrameworkFiles();

        # Update .env file.
        $this->updateEnvFile();

        # Everything is ready now.
        CLI::write('Codeigniter vite initialized successfully ✅', 'green');
        CLI::newLine();
        CLI::write('run: npm install && npm run dev');
        CLI::newLine();
    }

    /**
     * Generate vite files (vite.config.js, package.json & resources ...etc)
     * 
     * @return void
     */
    private function generateFrameworkFiles()
    {
        helper('filesystem');

        CLI::write('⚡ Generating vite files...', 'yellow');
        CLI::newLine();

        # Framework files.
        $frameworkPath = ($this->framework === 'none') ? 'frameworks/default' : "frameworks/$this->framework";

        $frameworkFiles = directory_map($this->path . $frameworkPath, 1, true);

        $publisher = new Publisher($this->path . "$frameworkPath", ROOTPATH);

        # Publish them.
        try
        {
            $publisher->addPaths($frameworkFiles)->merge(true);
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

        # For backup.
        $backupFile = is_file($envFile) ? 'env-BACKUP-' . time() : null;

        # Does exist? if not, generate it =)
        if (is_file($envFile))
        {
            # But first, let's take a backup.
            copy($envFile, ROOTPATH . $backupFile);

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

        # set the backup name in the current one.
        if ($backupFile)
        {
            $envContent = file_get_contents(ROOTPATH . '.env');
            $backupUpdate = str_replace('VITE_BACKUP_FILE=', "VITE_BACKUP_FILE='$backupFile'", $envContent);
            file_put_contents($envFile, $backupUpdate);
        }

        # Define framework.
        if ($this->framework !== 'none')
        {
            # Get .env content.
            $envContent = file_get_contents($envFile);
            # Set framework.
            $updates = str_replace("VITE_FRAMEWORK='none'", "VITE_FRAMEWORK='$this->framework'", $envContent);

            file_put_contents($envFile, $updates);

            # React entry file (main.jsx).
            if ($this->framework === 'react')
            {
                $envContent = file_get_contents($envFile);
                $updates = str_replace("VITE_ENTRY_FILE='main.js'", "VITE_ENTRY_FILE='main.jsx'", $envContent);
                file_put_contents($envFile, $updates);
            }

            # SvelteKit src directory.
            if ($this->framework === 'sveltekit')
            {
                $envContent = file_get_contents($envFile);
                $updates = str_replace("VITE_RESOURCES_DIR='resources'", "VITE_RESOURCES_DIR='src'", $envContent);
                file_put_contents($envFile, $updates);
            }
        }

        # env updated.
        CLI::newLine();
        CLI::write('.env file updated ✅', 'green');
        CLI::newLine();
    }
}
