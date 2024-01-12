<?php
function wdja_cms_module_index()
{
  global $ngenre,$ntitles,$nkeywords,$ndescription;
  global $nurs;
  $tappstr = md5(ii_cvgenre($ngenre).'/'.$nurs);
  if (ii_cache_html($tappstr))
  {
    $tmpstr = ii_cache_get($tappstr, 2);
  }else{
    $tmpstr = ii_itake('module.index', 'tpl');
    mm_cntitle($ntitles);
    mm_cnkeywords($nkeywords);
    mm_cndescription($ndescription);
    $tmpstr = str_replace('{$genre}', $ngenre, $tmpstr);
    $tmpstr = ii_creplace($tmpstr);
    ii_cache_put($tappstr, 2, $tmpstr);
  }
  return $tmpstr;
}

function wdja_cms_module()
{
  switch($_GET['type'])
  {
    case 'index':
      return wdja_cms_module_index();
      break;
    default:
      return wdja_cms_module_index();
      break;
  }
}
?>