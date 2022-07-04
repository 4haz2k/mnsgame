<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'MNS_GAME');

// Project repository
set('repository', 'git@github.com:4haz2k/GSMS.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', [
    '.env',
]);

add('shared_dirs', [
    'public/img/banners',
    'public/profiles',
    'storage',
]);

// Writable dirs by web server
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);


// Hosts

host('dev')
    ->hostname('134.0.113.225')
    ->user('deployer')
    ->identityFile('C:\Users\Пользователь\.ssh\id_rsa')
    ->multiplexing(false)
    ->set('deploy_path', '/var/www/134-0-113-225.cloudvps.regruhosting.ru');

host('prod')
    ->hostname('134.0.113.225')
    ->user('deployer')
    ->identityFile('C:\Users\Пользователь\.ssh\id_rsa')
    ->multiplexing(false)
    ->set('deploy_path', '/var/www/134-0-113-225.cloudvps.regruhosting.ru');

// Tasks
task('php-fpm:restart', function () {
    run('sudo systemctl restart php7.4-fpm.service');
});

//after('deploy:symlink', 'php-fpm:restart');

//task('upload:env', function () {
//    upload('.env.production', '{{deploy_path}}/shared/.env');
//})->desc('Environment setup');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

