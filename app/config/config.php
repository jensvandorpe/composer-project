<?php

$db = array_merge(['port' => 3306], parse_url(getenv(getenv('DATABASE_URL_NAME') ?: 'DATABASE_URL')));

$projectDir = dirname(__DIR__, 2);

return array_replace_recursive($this->loadConfig($this->AppPath() . 'Configs/Default.php'), [

    'db' => [
        'username' => $db['user'],
        'password' => $db['pass'],
        'dbname'   => substr($db['path'], 1),
        'host'     => $db['host'],
    ],

    'phpSettings' => [
        'display_errors' => 1
    ],

    'template' => [
        'forceCompile' => true,
        'templateDir' => $projectDir . '/themes',
    ],

    'plugin_directories' => [
        'Default'   => $this->AppPath('Plugins_' . 'Default'),
        'Local'     => $projectDir . '/Plugins/Local/',
        'Community' => $projectDir . '/Plugins/Community/',
        'ShopwarePlugins' => $projectDir .'/custom/plugins/',
    ],
    
    'cdn' => [
        'liveMigration' => true,
        'adapters' => [
            'local' => [
                'path' => $projectDir,
            ],
        ],
    ],
    'app' => [
        'rootDir' => $projectDir,
        'downloadsDir' => $projectDir . '/files/downloads',
        'documentsDir' => $projectDir . '/files/documents',
    ],
    'web' => [
        'webDir' => $projectDir . '/web',
        'cacheDir' => $projectDir . '/web/cache',
    ],

    'csrfProtection' => [
        'frontend' => false,
        'backend' => false,
    ],

    'front' => [
        'showException' => true,
        'throwExceptions' => true,
        'noErrorHandler' => false,
    ],

    //Zeige Low-Level PHP-Fehler
    'phpsettings' => [
        'display_errors' => 1,
    ],

    // Backend-Cache
    'cache' => [
        'backend' => 'Black-Hole',
        'backendOptions' => [],
        'frontendOptions' => [
            'write_control' => false,
        ],
    ],

    // Model-Cache
    'model' => [
        'cacheProvider' => 'Array' // supports Apc, Array, Wincache and Xcache
    ],

    // Http-Cache
    'httpcache' => [
        'enabled' => true, // true or false
        'debug' => true,
    ],
]);
