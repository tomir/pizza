<?php

require_once 'bootstrap.php';

$sClassName = (isset($_GET['admin']) && $_GET['admin'] == true)
              ? 'Backend'
              : 'Frontend';

// Admin Url -> /admin.html

$oController = new $sClassName();
$oController->init();



