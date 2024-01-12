<?php
$ngenre = ADMIN_FOLDER;
wdja_cms_init('node');
wdja_cms_admin_init();
$adms_appstr = 'admin_guide_' . $nlng;
$ntitles = $variable[ii_cvgenre($ngenre) . '.ntitles'];
if(ii_isnull($ntitles)) $ntitles = ii_itake('module.channel_title', 'lng');
?>
