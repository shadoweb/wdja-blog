<?php
function mm_get_author($auid,$nid)
{
  //获取虚拟用户名
  global $conn, $ngenre, $variable, $nurlpre, $nlng;
  $tauthor = mm_get_field($ngenre,$nid,'author');
  $tgenre = 'author';
  $tdatabase = $variable[ii_cvgenre($tgenre) . '.ndatabase'];
  $tidfield = $variable[ii_cvgenre($tgenre) . '.nidfield'];
  $tfpre = $variable[ii_cvgenre($tgenre) . '.nfpre'];
  $trsPre = ii_itake('global.' . $tgenre . ':manage.upload_user', 'lng');
  $trsNext = ii_itake('global.' . $tgenre . ':manage.tips_user', 'lng');
  $tsqlstr = "select " . ii_cfnames($tfpre, 'topic') . " from $tdatabase where $tidfield = $auid";
  $trs = ii_conn_query($tsqlstr, $conn);
  $trs = ii_conn_fetch_array($trs);
  if (is_array($trs) && $tauthor == 1) return $trsPre.'<a href="'.$nurlpre.'/'.$tgenre.'/'.ii_iurl('detail', $auid, $GLOBALS['nurltype']).'" target="_blank">'.$trs[ii_cfnames($tfpre, 'topic')].'</a>'.$trsNext;
}

function mm_get_rand_author()
{
  //随机获取虚拟用户ID
  global $conn, $variable, $nurlpre, $nlng;
  $ngenre = 'author';
  $ndatabase = $variable[ii_cvgenre($ngenre) . '.ndatabase'];
  $nidfield = $variable[ii_cvgenre($ngenre) . '.nidfield'];
  $nfpre = $variable[ii_cvgenre($ngenre) . '.nfpre'];
  $tsqlstr = "select $nidfield from $ndatabase order by rand() desc";
  $trs = ii_conn_query($tsqlstr, $conn);
  $trs = ii_conn_fetch_array($trs);
  return $trs[$nidfield];
}

function api_author_genre_lists(){
  global $ngenre, $variable;
  $nsearch_genre = $variable[ii_cvgenre($ngenre) . '.nsearch_genre'];
  $tgenres = explode(',', $nsearch_genre);
  $tmpstr = '';
  foreach ($tgenres as $genre)
  {
    $tmpstr .= api_author_genre_list($genre);
  }
  return $tmpstr;
}

function api_author_genre_list($genre,$num='10') {
  //调用指定模块内容
  global $conn,$variable;
  $tid = ii_get_num($_GET['id']);
  $tnum = ii_get_num($num);
  $ndatabase_genre = $variable[ii_cvgenre($genre) . '.ndatabase'];
  $nidfield_genre = $variable[ii_cvgenre($genre) . '.nidfield'];
  $nfpre_genre = $variable[ii_cvgenre($genre) . '.nfpre'];
  $tmpstr = '';
  if(!ii_isnull($ndatabase_genre)){
      $tsqlstr = "select * from $ndatabase_genre where ".ii_cfnames($nfpre_genre,'auid')  . " = $tid and ".ii_cfnames($nfpre_genre,'hidden')."=0 order by ".ii_cfnames($nfpre_genre,'time')." desc limit 0,".$tnum;
      $trs = ii_conn_query($tsqlstr, $conn);
      if(ii_conn_affected_rows($conn) > 0) {
          $tmpstr = ii_itake('global.author:module.api_author_genre_list', 'tpl');
          $tmpastr = ii_ctemplate($tmpstr, '{@}');
          $tmptstr = '';
          $tmprstr = '';
          while ($trow = ii_conn_fetch_array($trs))
          {
            $ttopic = ii_htmlencode($trow[ii_cfnames($nfpre_genre,'topic')]);
            $tmptstr = str_replace('{$topic}', $ttopic, $tmpastr);
            $tmptstr = str_replace('{$id}', ii_get_num($trow[$nidfield_genre]), $tmptstr);
            $tmptstr = str_replace('{$genre}', $genre, $tmptstr);
            $tmptstr = ii_creplace($tmptstr);
            $tmprstr .= $tmptstr;
          }
          $tmpstr = str_replace(WDJA_CINFO, $tmprstr, $tmpstr);
          $tmpstr = str_replace('{$genre}', $genre, $tmpstr);
          $tmpstr = str_replace('{$id}', $tid, $tmpstr);
          $tmpstr = ii_creplace($tmpstr);
      }
  }
  return $tmpstr;
}