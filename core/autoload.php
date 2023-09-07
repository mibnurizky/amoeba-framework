<?php
ini_set('session.cookie_lifetime', 0);
session_start();

/** Define */
define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);

/** Include Helper */
foreach (glob(ROOT_PATH.'/helpers/*.php') as $filename)
{
    include_once $filename;
}

/** Include Database */
include_once ROOT_PATH.'/core/database.php';

/** Include Cache */
include_once ROOT_PATH.'/core/cache.php';

/** Include App Config */
include_once ROOT_PATH.'/core/app.php';

/** Include Component */
include_once ROOT_PATH.'/core/session.php';

/** Include Component */
include_once ROOT_PATH.'/core/component.php';

/** Include Model */
include_once ROOT_PATH.'/core/model.php';

/** Bootstrap */
global $CComponent,$CApp,$CDatabase,$CModel;
$CComponent = new Component();
$CApp = new App();
$CDatabase = new Database();
$CModel = new Model();
$CCache = new Cache();
$CSession = new Session();
if(empty($_GET['c'])){
    $CComponent->redirect('home');
}
$CComponent->includeComponent($_GET['c']);
?>