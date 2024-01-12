<?php
function wdja_cms_module_list()
{
  global $conn, $nlng, $ngenre;
  $toffset = ii_get_num($_GET['offset']);
  global $nurs;
  $tappstr = md5(ii_cvgenre($ngenre).'/'.$nurs);
  if (ii_cache_html($tappstr))
  {
    return ii_cache_get($tappstr, 2);
  }else{
    global $nclstype, $nlisttopx, $npagesize, $ntitles,$nkeywords,$ndescription;
    global $ndatabase, $nidfield, $nfpre;
    global $nurltype;
    mm_cntitle($ntitles);
    mm_cnkeywords($nkeywords);
    mm_cndescription($ndescription);
    $tclassids = mm_get_sortids($ngenre, $nlng);
    $tmpstr = ii_itake('module.list', 'tpl');
    $tmpastr = ii_ctemplate($tmpstr, '{@recurrence_ida}');
    $tmprstr = '';
    $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "= '" . $nlng . "'";
    $tsqlstr .= " order by " . ii_cfname('time') . " desc";
    $tcp = new cc_cutepage;
    $tcp -> id = $nidfield;
    $tcp -> pagesize = $npagesize;
    $tcp -> rslimit = $nlisttopx;
    $tcp -> sqlstr = $tsqlstr;
    $tcp -> offset = $toffset;
    $tcp -> urlid = $tclassid;
    $tcp -> init();
    $trsary = $tcp -> get_rs_array();
    if (is_array($trsary))
    {
      foreach($trsary as $trs)
      {
        $tmptstr = $tmpastr;
        foreach ($trs as $key => $val)
        {
          $tkey = ii_get_lrstr($key, '_', 'rightr');
          $GLOBALS['RS_' . $tkey] = $val;
          $tmptstr = str_replace('{$' . $tkey . '}', ii_htmlencode($val), $tmptstr);
        }
        $tgourl = mm_get_field($ngenre,$trs[$nidfield],'gourl');
        if (!ii_isnull($tgourl)) $turl = $tgourl;
        else $turl = '/'.$ngenre.'/'.ii_iurl('detail',$trs[$nidfield], $nurltype);
        $tmptstr = str_replace('{$id}', $trs[$nidfield], $tmptstr);
        $tmptstr = str_replace('{$url}', $turl, $tmptstr);
        $tmptstr = ii_creplace($tmptstr);
        $tmprstr .= $tmptstr;
      }
    }
    $tmpstr = str_replace(WDJA_CINFO, $tmprstr, $tmpstr);
    $tmpstr = str_replace('{$cpagestr}', $tcp -> get_pagenum(), $tmpstr);
    $tmpstr = str_replace('{$genre}', $ngenre, $tmpstr);
    $tmpstr = str_replace('{$nlng}', $nlng, $tmpstr);
    $tmpstr = ii_creplace($tmpstr);
    ii_cache_put($tappstr, 2, $tmpstr);
  }
  return $tmpstr;
}

function wdja_cms_module_detail()
{
  global $conn, $ngenre,$nlng;
  global $nvalidate;
  $tid = ii_get_num($_GET['id'],0);
  $tpage = ii_get_num($_GET['page']);
  global $nurs;
  $tappstr = md5(ii_cvgenre($ngenre).'/'.$nurs);
  if (ii_cache_html($tappstr))
  {
    $tmpstr = ii_cache_get($tappstr, 2);
  }else{
    global $ndatabase, $nidfield, $nfpre;
    $tucode = ii_cstr($_GET['ucode']);
    if (!ii_isnull($tucode)) {
      $tsqlstr = "select * from $ndatabase where " . ii_cfname('ucode') . "='$tucode'";
    }elseif ($tid==0) {
      $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "='$nlng' order by ".$nidfield." asc limit 0,1";
    } else{
      $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "='$nlng' and $nidfield=$tid";
    }
    $trs = ii_conn_query($tsqlstr, $conn);
    $trs = ii_conn_fetch_array($trs);
    if ($trs)
    {
      $tid = $trs[$nidfield];
      $ttpl = mm_get_field($ngenre,$tid,'tpl');
      $tgourl = mm_get_field($ngenre,$tid,'gourl');
      if (!ii_isnull($tgourl)) {
          header("HTTP/1.1 301 Moved Permanently");
          header ("Location:$tgourl");
          exit;
      }
      $tcount = $trs[ii_cfname('count')] + 1;
      mm_update_field($ngenre,$trs[$nidfield],'count',$tcount);//访问一次,更新一次访问次数+1;
      if (!ii_isnull($ttpl)) $tmpstr = ii_itake('module.'.$ttpl, 'tpl');
      else $tmpstr = ii_itake('module.detail', 'tpl');
      $titles = ii_htmlencode($trs[ii_cfname('titles')]);
      if(!ii_isnull($titles)) mm_cntitle($titles);
      else mm_cntitle(ii_htmlencode($trs[ii_cfname('topic')]));
      mm_cnkeywords(ii_htmlencode($trs[ii_cfname('keywords')]));
      mm_cndescription(ii_htmlencode($trs[ii_cfname('description')]));
      foreach ($trs as $key => $val)
      {
        $tkey = ii_get_lrstr($key, '_', 'rightr');
        $GLOBALS['RS_' . $tkey] = $val;
        $tmpstr = str_replace('{$' . $tkey . '}', ii_htmlencode($val), $tmpstr);
      }
      $tmpstr = api_replace_fields($tmpstr,$trs[$nidfield],$ngenre);
      $tmpstr = str_replace('{$id}', $trs[$nidfield], $tmpstr);
      $tmpstr = str_replace('{$genre}', $ngenre, $tmpstr);
      $tmpstr = str_replace('{$page}', $tpage, $tmpstr);
      $tmpstr = mm_cvalhtml($tmpstr, $nvalidate, '{@recurrence_valcode}');
      $tmpstr = ii_creplace($tmpstr);
    }else{
      mm_imessage(ii_itake('global.lng_config.nodata', 'lng'), '-1');   
    }
    ii_cache_put($tappstr, 2, $tmpstr);
  }
  return $tmpstr;
}

function wdja_cms_module_index()
{
  global $ngenre,$nvalidate,$ntitles,$nkeywords,$ndescription;
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
    $tmpstr = mm_cvalhtml($tmpstr, $nvalidate, '{@recurrence_valcode}');
    $tmpstr = ii_creplace($tmpstr);
    if(!ii_isnull($tmpstr)) ii_cache_put($tappstr, 2, $tmpstr);
    else return wdja_cms_module_list();
  }
  return $tmpstr;
}

function wdja_cms_module()
{
  switch($_GET['type'])
  {
    case 'list':
      return wdja_cms_module_list();
      break;
    case 'detail':
      return wdja_cms_module_detail();
      break;
    case 'index':
      return wdja_cms_module_index();
      break;
    default:
      return wdja_cms_module_index();
      break;
  }
}
?>