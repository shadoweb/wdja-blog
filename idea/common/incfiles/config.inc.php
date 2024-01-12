<?php
/*
判断是否作为网站首页使用
*/
if (ii_strlen(dirname($_SERVER['PHP_SELF']))>1) {
  $nroute = 'node';
  $ngenre = ii_get_actual_genre(__FILE__, $nroute);
}else{
  $nroute = '';
  $ngenre = 'idea';
}
wdja_cms_init($nroute);
$nhead = $variable[ii_cvgenre($ngenre) . '.nhead'];
$nfoot = $variable[ii_cvgenre($ngenre) . '.nfoot'];
if (ii_isnull($nhead)) $nhead = $default_head;
if (ii_isnull($nfoot)) $nfoot = $default_foot;
$ndatabase = $variable[ii_cvgenre($ngenre) . '.ndatabase'];
$nidfield = $variable[ii_cvgenre($ngenre) . '.nidfield'];
$nfpre = $variable[ii_cvgenre($ngenre) . '.nfpre'];
$npagesize = $variable[ii_cvgenre($ngenre) . '.npagesize'];
$nlisttopx = $variable[ii_cvgenre($ngenre) . '.nlisttopx'];
$nviewpwd = $variable[ii_cvgenre($ngenre) . '.nviewpwd'];
$ntitle = ii_itake('module.channel_title', 'lng');
?>