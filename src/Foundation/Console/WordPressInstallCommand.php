<?php

namespace FilcPress\Foundation\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use InvalidArgumentException;
use RuntimeException;

class WordPressInstallCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordpress:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run WordPress install';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (is_blog_installed()) {
            throw new RuntimeException('WordPress is already installed.');
        }

        $appName = config('app.name');
        $adminEmail = env('ADMIN_EMAIL');
        $adminUsername = env('ADMIN_USERNAME');
        $adminPassword = env('ADMIN_PASSWORD');

        if (! is_string($adminEmail) || empty($adminEmail)) {
            throw new InvalidArgumentException('"ADMIN_EMAIL" option not set in environment file.');
        }

        if (! is_string($adminUsername) || empty($adminUsername)) {
            throw new InvalidArgumentException('"ADMIN_USERNAME" option not set in environment file.');
        }

        if (! is_string($adminPassword) || empty($adminPassword)) {
            $adminPassword = $this->generateStrongPassword();

            // Now, we'll persist the newly created password to the environment file.
            if (! $this->setKeyAdminPasswordInEnvironmentFile($adminPassword)) {
                return;
            }
        }

        $this->installWordPress($appName, $adminEmail, $adminUsername, $adminPassword);

        $this->info("WordPress installed successfully.");
    }

    /**
     * Generate a strong password.
     *
     * @return string
     */
    protected function generateStrongPassword()
    {
        return str_random(32);
    }

    /**
     * Set the admin password in the environment file.
     *
     * @param  string $password
     * @return bool
     */
    protected function setKeyAdminPasswordInEnvironmentFile($password)
    {
        $this->writeNewEnvironmentFileWith($this->adminPasswordReplacementPattern(), 'ADMIN_PASSWORD', $password);

        return true;
    }

    /**
     * Write a new environment file with the given key-value pair.
     *
     * @param  string $currentOptionPattern
     * @param  string $key
     * @param  string $value
     * @return void
     */
    protected function writeNewEnvironmentFileWith($currentOptionPattern, $key, $value)
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $currentOptionPattern,
            $key.'='.$value,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }

    /**
     * Get a regex pattern that will match env APP_KEY with any random key.
     *
     * @return string
     */
    protected function adminPasswordReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['app.key'], '/');

        return "/^ADMIN_PASSWORD{$escaped}/m";
    }

    /**
     * Install WordPress.
     *
     * @param string $appName Site title.
     * @param string $adminEmail User's email.
     * @param string $adminUsername User's username.
     * @param string $adminPassword User's chosen password.
     *
     * @return array Array keys 'url', 'user_id', 'password', and 'password_message'.
     */
    private function installWordPress($appName, $adminEmail, $adminUsername, $adminPassword)
    {
        /** Load WordPress Administration Upgrade API */
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        return wp_install($appName, $adminUsername, $adminEmail, true, null, wp_slash($adminPassword));
    }
}
