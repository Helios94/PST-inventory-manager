<?php
namespace Deployer;

require 'recipe/laravel.php';

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
    ->set('deploy_path', '/var/www/pst-inventory-manager');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');

