<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

Configure::write(
    'Dispatcher.filters',
    array(
        'CacheDispatcher',
        'AssetDispatcher'
    )
);

if (isset($_SERVER['REMOTE_ADDR']) && Cache::read($_SERVER['REMOTE_ADDR'], 'attempts')) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit();
}

//tipo de encriptación de cookies, lo dejamos aca porque core.php es más para configs nativas de Cake
Configure::write('Security.encryptType', 'rijndael');

//lenguaje default
define('DEFAULT_LANGUAGE', '');

//lista de lenguajes
Configure::write('Config.languages', array('eng', 'spa'));


//carga todos los plugins
CakePlugin::loadAll(
    array(
        'AssetCompress' => array('bootstrap' => true),
        'I18n'          => array('routes' => true)
    )
);

// Read config files from app/Config
App::uses('PhpReader', 'Configure');
Configure::config('default', new PhpReader());

//reads environments data to config
Configure::load('data/environments', 'default');

//reads adminsitrators data to config
Configure::load('data/administrators', 'default');

//reads settings data to config
Configure::load('data/settings', 'default');

//Configures Cache site-wide
$cache_type = Configure::read('Config.cache_type');
$cache_prefix = Configure::read('Config.cache_prefix');
$cache_server = Configure::read('Config.cache_server');
$cache_persistent_name = Configure::read('Config.cache_persistent_name');
$cache_serialize = Configure::read('Config.cache_serialize');

$core_duration = Configure::read('Config.core_duration');
$default_duration = Configure::read('Config.default_duration');

if (Configure::read('debug') > 0) {
    $core_duration = '+10 seconds';
}

Cache::config(
    '_cake_core_',
    array(
        'engine'      => $cache_type,
        'duration'    => $core_duration,
        'probability' => 100,
        'prefix'      => $cache_prefix . 'cake_core_',
        'persistent'  => $cache_persistent_name,
        'path'        => CACHE . 'persistent' . DS,
        'serialize'   => $cache_serialize
    )
);

Cache::config(
    '_cake_model_',
    array(
        'engine'      => $cache_type,
        'duration'    => $core_duration,
        'probability' => 100,
        'prefix'      => $cache_prefix . 'cake_model_',
        'persistent'  => $cache_persistent_name,
        'path'        => CACHE . 'models' . DS,
        'serialize'   => $cache_serialize
    )
);

Cache::config(
    'asset_compress',
    array(
        'engine'      => $cache_type,
        'duration'    => $core_duration,
        'probability' => 100,
        'prefix'      => $cache_prefix . 'asset_compress_',
        'persistent'  => $cache_persistent_name,
        'path'        => CACHE . 'persistent' . DS,
        'serialize'   => $cache_serialize
    )
);


Cache::config(
    'default',
    array(
        'engine'      => $cache_type,
        'duration'    => $default_duration,
        'probability' => 100,
        'prefix'      => $cache_prefix . 'default_',
        'persistent'  => $cache_persistent_name,
        'path'        => CACHE . 'data' . DS,
        'serialize'   => $cache_serialize
    )
);

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');

$logEngine = Configure::read('Config.logEngine');

// Error log configured to use variable engine, preferably SysLog in live mode
CakeLog::config(
    'error',
    array(
        'engine' => $logEngine,
        'types'  => array('notice', 'warning', 'error', 'alert', 'critical', 'emergency'),
        'format' => '%s - %s',
        'file'   => 'error',
    )
);

// debug info logged to file
CakeLog::config(
    'debug',
    array(
        'engine' => 'FileLog',
        'types'  => array('notice', 'debug', 'info'),
        'format' => '%s - %s',
        'scopes' => array('debug'),
        'file'   => 'debug',
    )
);

// sql queries logged to file, if enabled
CakeLog::config(
    'sql',
    array(
        'engine' => 'FileLog',
        'types'  => array('info'),
        'scopes' => array('sql'),
        'format' => '%s - %s',
        'file'   => 'sql',
    )
);

