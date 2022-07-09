<?php

namespace Mihatori\CodeigniterVite\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Publisher\Publisher;
use Throwable;

class Remove extends BaseCommand
{
    protected $group        = 'Modules';
    protected $name         = 'vite:remove';
    protected $description  = 'Remove codeigniter vite generated files and settings';

    public function run(array $params)
    {
        # cleaning start.
        CLI::write('Removing Codeigniter Vite 🔥⚡', 'white', 'red');
        CLI::newLine();

        # Now let's remove vite files (vite.config.js, package.json & resources direction).
        $this->removeFrameworkFiles();

        # Reset .env file.
        $this->resetEnvFile();

        # Everything is ready now.
        CLI::write('Codeigniter vite has removed successfuly ✅', 'green');
        CLI::newLine();
    }

    /**
     * Remove vite files (vite.config.js, package.json & resources)
     * 
     * @return void
     */
    private function removeFrameworkFiles()
    {
        CLI::write('⚡ Removing vite files...', 'yellow');
        CLI::newLine();

        # First vite.config.js
        is_file(ROOTPATH . 'vite.config.js') ? unlink(ROOTPATH . 'vite.config.js') : CLI::error('vite.config.js does not exist');

        # package.json
        is_file(ROOTPATH . 'package.json') ? unlink(ROOTPATH . 'package.json') : CLI::error('package.json does not exist');

        # Empty resources dir.
        if (is_dir(ROOTPATH . 'resources'))
        {
            $publisher = new Publisher(null, ROOTPATH . 'resources');
            $publisher->wipe();
        }

        CLI::newLine();
        CLI::write('Deleted ✅', 'green');
        CLI::newLine();
    }

    /**
     * Remove vite configs in .env file
     * 
     * @return void
     */
    private function resetEnvFile()
    {
        CLI::write('Reseting .env file...', 'yellow');
        CLI::newLine();

        # Get the env file.
        $envFile = ROOTPATH . '.env';
        # Get last backup.
        $backupFile = ROOTPATH . env('VITE_BACKUP_FILE');

        # Does exist? if not, generate it =)
        if (is_file($envFile))
        {
            # Remove current .env
            unlink($envFile);
            # Restore backup if exists
            if (is_file($backupFile))
            {
                copy($backupFile, ROOTPATH . '.env');
                unlink($backupFile);
            }
        }

        # env updated.
        CLI::write('.env file updated ✅', 'green');
        CLI::newLine();
    }
}
