<?php

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'ClientAPI.php';

$clientApi = new ClientAPI();
$clientApi->doCurl();

?>
