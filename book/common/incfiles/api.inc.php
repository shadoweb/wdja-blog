<?php
function vv_inavpath($genre)
{
  global $nurltype,$nurlpre;
  $tgenre = $genre;
  $tid = isset($_GET['id']) ? ii_get_num($_GET['id']) : '0';
  $tmpstr = '';
  $tpl_href = ii_itake('global.tpl_config.a_href_self', 'tpl');
  $thome = ii_itake('global.module.channel_title', 'lng');
  $toutstr = $tpl_href;
  $toutstr = vv_inavrepeat($thome,ii_get_actual_route('./'));
  $ttopic = ii_itake('global.book:module.channel_title', 'lng');
  $toutstr .= NAV_SP_STR . vv_inavrepeat($ttopic,ii_get_actual_route('book'));
  if($tid != 0)
  {
    if($tgenre == 'book/section')
    {
      $tsectiontitle = mm_get_field($tgenre,$tid,'topic');
      $tbookid = mm_get_field($tgenre,$tid,'book_id');
      $tbooktitle = mm_get_field('book',$tbookid,'topic');
      $toutstr .= NAV_SP_STR . vv_inavrepeat($tbooktitle,ii_curl(ii_get_actual_route('book'), ii_iurl('detail', $tbookid, $nurltype)));
      $toutstr .= NAV_SP_STR . vv_inavrepeat($tsectiontitle,ii_curl(ii_get_actual_route($tgenre), ii_iurl('detail', $tid, $nurltype)));
    }else{
      $tbooktitle = mm_get_field('book',$tid,'topic');
      $toutstr .= NAV_SP_STR . vv_inavrepeat($tbooktitle,ii_curl(ii_get_actual_route('book'), ii_iurl('detail', $tid, $nurltype)));
    }
  }
  return $toutstr;
}

function vv_inavrepeat($title,$url){
  $tpl_href = ii_itake('global.tpl_config.a_href_self', 'tpl');
  $toutstr = $tpl_href;
  $toutstr = str_replace('{$explain}', $title, $toutstr);
  $toutstr = str_replace('{$value}', $url, $toutstr);
  return $toutstr;
}


