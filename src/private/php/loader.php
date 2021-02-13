<?php
date_default_timezone_set("America/Mexico_City");
$model = json_decode($argv[1], true);

foreach($model as $key => $value) {
  $$key = $value;
}

$_GET = $settings['_GET'];
$_POST = $settings['_POST'];
$_SESSION = $settings['_SESSION'];

set_include_path($_VIEWS_PATH);

include $_TEMPLATE;