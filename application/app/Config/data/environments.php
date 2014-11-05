<?php
/**
 * Configuracion de entorno.
 */
$host = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : 'cli';

// staging
if (strpos($host, 'liveurl') > -1 && strpos($_SERVER['REQUEST_URI'], '/staging') === 0) {
    $config = array(
        'Config.environment'           => 'staging',
        'debug'                        => 0,
        'AssetCompress.raw'            => false,
        'Cache.disable'                => false,
        'Config.logEngine'             => 'FileLog',

        //cache config
        'Config.cache_type'            => 'Memcached',
        'Config.cache_server'          => array('127.0.0.1:11211'),
        'Config.cache_prefix'          => 'project_prefix_staging_',
        'Config.cache_serialize'       => false,
        'Config.cache_persistent_name' => 'project_prefix_staging',
        'Config.core_duration'         => 31536000,
        'Config.default_duration'      => 5184000,

        //database
        'db_host'                      => 'localhost',
        'db_login'                     => '',
        'db_password'                  => '',
        'db_database'                  => '',
        'db_prefix'                    => '',
        'db_encoding'                  => 'utf8',
    );
} else if (strpos($host, 'liveurl') > -1) {
    $config = array(
        'Config.environment'           => 'production',
        'debug'                        => 0,
        'AssetCompress.raw'            => false,
        'Cache.disable'                => false,
        'Config.logEngine'             => 'FileLog',

        //cache config
        'Config.cache_type'            => 'Memcached',
        'Config.cache_server'          => array('127.0.0.1:11211'),
        'Config.cache_prefix'          => 'project-prefix_',
        'Config.cache_persistent_name' => 'project-prefix',
        'Config.cache_serialize'       => false,
        'Config.core_duration'         => 31536000,
        'Config.default_duration'      => 5184000,

        //database
        'db_host'                      => 'localhost',
        'db_login'                     => '',
        'db_password'                  => '',
        'db_database'                  => '',
        'db_prefix'                    => '',
        'db_encoding'                  => 'utf8',
    );
} else {
    $config = array(
        'Config.environment'           => 'local',
        'debug'                        => 2,
        'AssetCompress.raw'            => true,
        'Cache.disable'                => false,
        'Config.logEngine'             => 'FileLog',
        'Config.logQueries'            => true,

        //cache config
        'Config.cache_type'            => 'File',
        'Config.cache_server'          => array('127.0.0.1:11211'),
        'Config.cache_prefix'          => 'project_prefix_',
        'Config.cache_persistent_name' => 'project_prefix',
        'Config.cache_serialize'       => true,
        'Config.core_duration'         => 31536000,
        'Config.default_duration'      => 5184000,

        //database config
        'db_host'                      => 'localhost',
        'db_login'                     => 'root',
        'db_password'                  => 'root',
        'db_database'                  => 'zenadmin',
        'db_prefix'                    => '',
        'db_encoding'                  => 'utf8',
    );
}

/**
 * Configuraciones extra que se mantienen identicas en todos los entornos, pero por semántica y comodidad es mejor
 * ponerlas acá
 */
