<?php
function wdja_cms_module_index()
{
  global $nurs;
  $tappstr = md5(ii_cvgenre($ngenre).'/'.$nurs);
  if (ii_cache_html($tappstr))
  {
    $tmpstr = ii_cache_get($tappstr, 2);
  }else{
    mm_cntitle('');
    $tmpstr = ii_ireplace('module.index', 'tpl');
    ii_cache_put($tappstr, 2, $tmpstr);
  }
  return $tmpstr;
}

function wdja_cms_module()
{
  return wdja_cms_blog_index();
}
?>