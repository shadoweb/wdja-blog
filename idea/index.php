<?php
require('../common/incfiles/autoload.php');
global $nviewpwd;
MkEncrypt($nviewpwd);
wdja_cms_module_action();
$myhtml = wdja_cms_module();
echo $myhtml;
?>