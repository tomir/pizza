<?php

$sPath = dirname(__DIR__);
define('DS', DIRECTORY_SEPARATOR) ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $sPath) ? null : define('SITE_ROOT', $sPath);
define('SMARTY_PATH',SITE_ROOT.DS."vendor".DS."smarty".DS."cache".DS)
    ? null : define('SMARTY_PATH',SITE_ROOT.DS."vendor".DS."smarty".DS."cache".DS);

$aDbConfig['local'] = array(
     'hostname'   => 'localhost',
     'username'   => 'root',
     'password'   => 'romantica123',
     'database'   => 'romantica',
     'dbProvider' => 'mysql',
);
$activeGroup = 'local';

switch ($aDbConfig[$activeGroup]['dbProvider']) {
    case 'mysql':
        $sProviderString = sprintf('mysql:host=%s;dbname=%s', $aDbConfig[$activeGroup]['hostname'], $aDbConfig[$activeGroup]['database']);
        break;

    default:
        $sProviderString = null;
        break;
}

ORM::configure($sProviderString);
ORM::configure('username',$aDbConfig[$activeGroup]['username']);
ORM::configure('password',$aDbConfig[$activeGroup]['password']);
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
