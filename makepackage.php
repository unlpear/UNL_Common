<?php
ini_set('display_errors',true);

unlink('data/unl_common.sqlite');
set_include_path(dirname(__FILE__).'/src');
require_once 'UNL/Common/Building/City.php';
require_once 'UNL/Common/Building/East.php';
$c = new UNL_Common_Building_City();
$e = new UNL_Common_Building_East();
