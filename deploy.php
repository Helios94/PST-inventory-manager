<?php
namespace Deployer;

require 'recipe/laravel.php';

set('use_relative_symlinks', false);
set('composer_options', 'install --verbose');
//set('composer_options', 'install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');

// Project name
set('application', 'PST Inventory Manager');

// Project repository
set('repository', 'git@github.com:Helios94/livewire-app.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
host('207.154.214.31')
    ->user('helios')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/livewire-app');

// Tasks

task('build', function () {
    run('cd {{release_path}} && composer install');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

