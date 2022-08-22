<?php

namespace Mihatori\CodeigniterVite\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Publisher\Publisher;
use Throwable;

class Remove extends BaseCommand
{
	protected $group        = 'CodeIgniter Vite';
	protected $name         = 'vite:remove';
	protected $description  = 'Remove codeigniter vite generated files and settings';

	/**
	 *  Module path
	 */
	private string $path;

	public function __construct()
	{
		$this->path = service('autoloader')->getNamespace('Mihatori\\CodeigniterVite')[0];
	}

	public function run(array $params)
	{
		# cleaning start.
		CLI::write('Removing Codeigniter Vite 🔥⚡', 'white', 'red');
		CLI::newLine();

		# Now let's remove vite files (vite.config.js, package.json ...etc).
		$this->removeFrameworkFiles();

		# Reset .env file.
		$this->resetEnvFile();

		# Everything is ready now.
		CLI::write('Codeigniter vite has removed successfuly ✅', 'green');
		CLI::newLine();
	}

	/**
	 * Remove vite files (vite.config.js, package.json ...etc).
	 * 
	 * @return void
	 */
	private function removeFrameworkFiles()
	{
		helper('filesystem');

		CLI::write('Removing vite files...', 'yellow');
		CLI::newLine();

		$framework = env('VITE_FRAMEWORK') ?? 'default';

		$frameworkFiles = directory_map($this->path . "frameworks/$framework", 1, true);

		foreach ($frameworkFiles as $file) {
			# Remove resources|src dir.
			if (is_file(ROOTPATH . $file)) {
				unlink(ROOTPATH . $file);
			} elseif (is_dir(ROOTPATH . $file)) {
				(new Publisher(null, ROOTPATH . $file))->wipe();
			} else {
				CLI::error("$file does not exist");
			}
		}

		# Remove package-lock.json
		is_file(ROOTPATH . 'package-lock.json') ? unlink(ROOTPATH . 'package-lock.json') : CLI::error('package-lock.json does not exist');

		# Just in case user has changed the resources directory.
		if (env('VITE_RESOURCES_DIR') && is_dir(ROOTPATH . env('VITE_RESOURCES_DIR'))) {
			(new Publisher(null, ROOTPATH . env('VITE_RESOURCES_DIR')))->wipe();
		}
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
		if (is_file($backupFile)) {
			# Remove current .env
			unlink($envFile);
			# Restore backup if exists
			if (is_file($backupFile)) {
				copy($backupFile, ROOTPATH . '.env');
				unlink($backupFile);
			}
		}
	}
}
