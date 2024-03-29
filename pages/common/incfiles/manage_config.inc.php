<?php
wdja_cms_admin_init();
$nsearch = 'topic,id';
$ncontrol = 'select,hidden,good,delete';

function pp_manage_navigation()
{
  return ii_ireplace('manage.navigation', 'tpl');
}

function pp_nav_topic($fsid)
{
  global $conn;
  global $ngenre,$slng;
  global $ndatabase, $nidfield, $nfpre;
  $tfsid = ii_get_num($fsid);
  $tfid = mm_get_field($ngenre,$fsid,'fid').','.$fsid;
  $tfidary = explode(',',$tfid);
  $tpl_href = ii_itake('global.tpl_config.a_href_sort', 'tpl');
  $tmpstr = '';
  foreach($tfidary as $fid)
  {
    if($fid !=0 && !ii_isnull($fid)){
        $ttopic = mm_get_field($ngenre,$fid,'topic');
        $tstr = $tpl_href;
        $tstr = str_replace('{$explain}', $ttopic, $tstr);
        $tstr = str_replace('{$value}', '?type=list&fsid=' . $fid .'&hspan=nav_list', $tstr);
        $tmpstr .= $tstr;
    }
  }
  $tmpstr = ii_creplace($tmpstr);
  return $tmpstr;
}

function pp_sel_topic($fsid,$lng)
{
  global $ngenre;
  $ffsid = pp_get_ffsid($fsid);
  $tarys = pp_get_topics($ffsid,$lng,$fsid);
  if (is_array($tarys))
  {
    $tfsid = ii_get_num($fsid,0);
    $trestr = ii_itake('global.tpl_config.sys_spsort', 'tpl');
    if($ffsid == 0) $option_pre = '<option value="0" selected>'.ii_itake('global.lng_config.unselect', 'lng').'</option>';
    else $option_pre = '<option value="'.$ffsid.'" selected>'.mm_get_field($ngenre,$ffsid,'topic').'</option>';
    $option_unselected = ii_itake('global.tpl_config.option_unselect', 'tpl');
    $option_selected = ii_itake('global.tpl_config.option_select', 'tpl');
    $tmpstr = '';
    $treturnstr = '';
    foreach ($tarys as $key => $val)
    {
      if ($val['id'] == $tfsid) $tmpstr = $option_selected;
      else $tmpstr = $option_unselected;
      $tmpstr = str_replace('{$explain}', str_repeat($trestr, pp_get_fid_incount($val['fid'], ',') + 1) . $val['topic'], $tmpstr);
      $tmpstr = str_replace('{$value}', $val['id'], $tmpstr);
      $treturnstr .= $tmpstr;
    }
    return $option_pre.$treturnstr;
  }else{
    return $option_pre;
  }
}

function pp_get_topics($ffsid,$lng,$fsid)
{
  global $conn;
  global $ngenre;
  global $ndatabase, $nidfield, $nfpre;
  $tarys = Array();
  $tlng = ii_get_safecode($lng);
  $tid = ii_get_num($_GET['id'],0);
  $tfsid = ii_get_num(mm_get_field($ngenre,$fsid,'fsid'));
  $tffsid = ii_get_num($ffsid,0);
  $tsqlstr = "select * from $ndatabase where " . ii_cfnames($nfpre, 'fsid') . "=$tffsid and " . ii_cfnames($nfpre, 'type') . "=0 and " . ii_cfnames($nfpre, 'lng') . "='$tlng' and " . ii_cfnames($nfpre, 'hidden') . "=0";
  if($tid!=0) $tsqlstr .= " and " . $nidfield . "!=$tid";
  $tsqlstr .= " order by " . ii_cfnames($nfpre, 'time') . " asc";
  $trs = ii_conn_query($tsqlstr, $conn);
  while ($trow = ii_conn_fetch_array($trs))
  {
    $tary[$trow[$nidfield]]['id'] = $trow[$nidfield];
    $tary[$trow[$nidfield]]['fid'] = $trow[ii_cfnames($nfpre, 'fid')];
    $tary[$trow[$nidfield]]['fsid'] = $trow[ii_cfnames($nfpre, 'fsid')];
    $tary[$trow[$nidfield]]['topic'] = $trow[ii_cfnames($nfpre, 'topic')];
    $tarys += $tary;
    if($trow[$nidfield]!=$fsid && $tfsid!=$trow[ii_cfnames($nfpre, 'fsid')]) $tarys += pp_get_topics($trow[$nidfield],$tlng,$fsid);//显示当前内容级别的子内容
  }
  return $tarys;
}

function pp_get_ffsid($fsid)
{
  global $conn;
  global $ngenre, $slng;
  global $ndatabase, $nidfield, $nfpre;
  $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "='$slng' and $nidfield=$fsid";
  $trs = ii_conn_query($tsqlstr, $conn);
  $trs = ii_conn_fetch_array($trs);
  if ($trs) $tfid = $trs[ii_cfname('fid')];
  $ffsid = ii_get_lrstr($tfid, ',', 'left');
  return $ffsid;
}

function pp_get_fid_incount($fid)
{
  if ($fid == '0') return -1;
  else return substr_count($fid, ',');
}

function pp_get_fid($fid, $id)
{
  if (ii_isnull($fid) || $fid == '0')return $id;
  else return $fid . ',' . $id;
}

function wdja_cms_admin_manage_adddisp()
{
  global $conn;
  global $ngenre, $slng;
  global $ndatabase, $nidfield, $nfpre, $nsaveimages;
  $tbackurl = $_GET['backurl'];
  $tfsid = ii_get_num($_POST['fsid']);
  $tckstr = 'topic:' . ii_itake('global.lng_config.topic', 'lng');
  $tary = explode(',', $tckstr);
  $Err = array();
  foreach ($tary as $val)
  {
    $tvalary = explode(':', $val);
    if (ii_isnull($_POST[$tvalary[0]])) $Err[count($Err)] = str_replace('[]', '[' . $tvalary[1] . ']', ii_itake('global.lng_error.insert_empty', 'lng'));
  }
  if (is_array($Err) && count($Err) > 0) wdja_cms_admin_msg($Err[0], $tbackurl, 1);
  $timage = ii_left(ii_cstr($_POST['image']), 255);
  if (mm_search_field($ngenre,ii_cstr($_POST['ucode']),'ucode') && !ii_isnull($_POST['ucode'])) wdja_cms_admin_msg(ii_itake('manage.ucode_failed', 'lng'), $tbackurl, 1);
  if ($nsaveimages == '1') $tcontent = ii_left(ii_cstr(saveimages($_POST['content'])), 100000);
  else $tcontent =ii_left(ii_cstr($_POST['content']), 100000);
  $tcontent_atts_list = ii_left(ii_cstr($_POST['content_atts_list']), 10000);
  $tswitch = ii_get_num($_POST['timer_switch']);
  $tevent = ii_get_num($_POST['event']);//0发布,1隐藏
  if ($tswitch == 1) {
    if ($tevent == 1) $thidden = 0;
    else $thidden = 1;
  }
  else $thidden = ii_get_num($_POST['hidden']);
  $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "='$slng' and $nidfield=$tfsid";
  $trs = ii_conn_query($tsqlstr, $conn);
  $trs = ii_conn_fetch_array($trs);
  if ($trs) $tfid = pp_get_fid($trs[ii_cfname('fid')], $tfsid);
  else $tfid = '0';
  $tsqlstr = "insert into $ndatabase (
  " . ii_cfname('topic') . ",
  " . ii_cfname('titles') . ",
  " . ii_cfname('keywords') . ",
  " . ii_cfname('description') . ",
  " . ii_cfname('fid') . ",
  " . ii_cfname('fsid') . ",
  " . ii_cfname('type') . ",
  " . ii_cfname('image') . ",
  " . ii_cfname('features') . ",
  " . ii_cfname('content') . ",
  " . ii_cfname('content_atts_list') . ",
  " . ii_cfname('ucode') . ",
  " . ii_cfname('time') . ",
  " . ii_cfname('update') . ",
  " . ii_cfname('hidden') . ",
  " . ii_cfname('good') . ",
  " . ii_cfname('lng') . "
  ) values (
  '" . ii_left(ii_cstr($_POST['topic']), 250) . "',
  '" . ii_left(ii_cstr($_POST['titles']), 250) . "',
  '" . ii_left(ii_cstr($_POST['keywords']), 250) . "',
  '" . ii_left(ii_cstr($_POST['description']), 250) . "',
  '" . $tfid . "',
  " . $tfsid . ",
  " . ii_get_num($_POST['type']) . ",
  '$timage',
  '" . ii_left(ii_cstr($_POST['features']), 10000) . "',
  '$tcontent',
  '$tcontent_atts_list',
  '" . ii_left(ii_cstr($_POST['ucode']), 50) . "',
  '" . ii_now() . "',
  '" . ii_now() . "',
  " . $thidden . ",
  " . ii_get_num($_POST['good']) . ",
  '$slng'
  )";
  $trs = ii_conn_query($tsqlstr, $conn);
  if ($trs)
  {
    $upfid = ii_conn_insert_id($conn);
    api_save_fields($upfid);
    api_save_tags($upfid);
    api_save_timer($upfid);
    $tsource = $_POST['source'];
    foreach($tsource as $k => $v){
      $ttitle = ii_left(ii_cstr($_POST[$v.'_title']), 250);
      $tsid = ii_left(ii_cstr($_POST[$v.'_sid']), 250);
      api_save_related($ngenre,$upfid,$v,$ttitle,$tsid);
    }
    uu_upload_update_database_note($ngenre, $tcontent_atts_list, 'content_atts', $upfid);
    wdja_cms_admin_msg(ii_itake('global.lng_public.add_succeed', 'lng'), $tbackurl, 1);
  }
  else wdja_cms_admin_msg(ii_itake('global.lng_public.add_failed', 'lng'), $tbackurl, 1);
}

function wdja_cms_admin_manage_editdisp()
{
  global $conn;
  global $ngenre,$slng;
  global $ndatabase, $nidfield, $nfpre, $nsaveimages;
  $tbackurl = $_GET['backurl'];
  $tfsid = ii_get_safecode($_POST['fsid']);
  $tckstr = 'topic:' . ii_itake('global.lng_config.topic', 'lng');
  $tary = explode(',', $tckstr);
  $Err = array();
  foreach ($tary as $val)
  {
    $tvalary = explode(':', $val);
    if (ii_isnull($_POST[$tvalary[0]])) $Err[count($Err)] = str_replace('[]', '[' . $tvalary[1] . ']', ii_itake('global.lng_error.insert_empty', 'lng'));
  }
  if (is_array($Err) && count($Err) > 0) wdja_cms_admin_msg($Err[0], $tbackurl, 1);
  $tid = ii_get_num($_GET['id']);
  $timage = ii_left(ii_cstr($_POST['image']), 255);
  if (mm_search_field($ngenre,ii_cstr($_POST['ucode']),'ucode',$tid) && !ii_isnull($_POST['ucode'])) wdja_cms_admin_msg(ii_itake('manage.ucode_failed', 'lng'), $tbackurl, 1);
  if ($nsaveimages == '1') $tcontent = ii_left(ii_cstr(saveimages($_POST['content'])), 100000);
  else $tcontent = ii_left(ii_cstr($_POST['content']), 100000);
  $tcontent_atts_list = ii_left(ii_cstr($_POST['content_atts_list']), 10000);
  $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "='$slng' and $nidfield=$tfsid";
  $trs = ii_conn_query($tsqlstr, $conn);
  $trs = ii_conn_fetch_array($trs);
  if ($trs)
  {
    //判断上级分类是否包含当前分类.
    $afid = preg_split( ',',$trs[ii_cfname('fid')]);
    foreach($afid as $aid) {
      if ($tid == $aid) return;
    }
    $tfid = pp_get_fid($trs[ii_cfname('fid')], $tfsid);
  }
  else
  {
    $tfid = '0';
  }
  $tsqlstr = "update $ndatabase set
  " . ii_cfname('topic') . "='" . ii_left(ii_cstr($_POST['topic']), 250) . "',
  " . ii_cfname('titles') . "='" . ii_left(ii_cstr($_POST['titles']), 250) . "',
  " . ii_cfname('keywords') . "='" . ii_left(ii_cstr($_POST['keywords']), 250) . "',
  " . ii_cfname('description') . "='" . ii_left(ii_cstr($_POST['description']), 250) . "',
  " . ii_cfname('fid') . "='$tfid',
  " . ii_cfname('fsid') . "='$tfsid',
  " . ii_cfname('type') . "=" . ii_get_num($_POST['type']) . ",
  " . ii_cfname('image') . "='$timage',
  " . ii_cfname('features') . "='" . ii_left(ii_cstr($_POST['features']), 10000) . "',
  " . ii_cfname('content') . "='$tcontent',
  " . ii_cfname('content_atts_list') . "='$tcontent_atts_list',
  " . ii_cfname('ucode') . "='" . ii_left(ii_cstr($_POST['ucode']), 50) . "',
  " . ii_cfname('time') . "='" . ii_get_date(ii_cstr($_POST['time'])) . "',
  " . ii_cfname('update') . "='" . ii_now() . "',
  " . ii_cfname('count') . "=" . ii_get_num($_POST['count']) . ",
  " . ii_cfname('hidden') . "=" . ii_get_num($_POST['hidden']) . ",
  " . ii_cfname('good') . "=" . ii_get_num($_POST['good']) . "
  where $nidfield=$tid";
  $trs = ii_conn_query($tsqlstr, $conn);
  if ($trs)
  {
    $upfid = $tid;
    api_update_fields($upfid);
    api_update_tags($upfid);
    api_update_timer($upfid);
    $tsource = $_POST['source'];
    foreach($tsource as $k => $v){
      $ttitle = ii_left(ii_cstr($_POST[$v.'_title']), 250);
      $tsid = ii_left(ii_cstr($_POST[$v.'_sid']), 250);
      api_update_related($ngenre,$upfid,$v,$ttitle,$tsid);
    }
    uu_upload_update_database_note($ngenre, $tcontent_atts_list, 'content_atts', $upfid);
    wdja_cms_admin_msg(ii_itake('global.lng_public.edit_succeed', 'lng'), $tbackurl, 1);
  }
  else wdja_cms_admin_msg(ii_itake('global.lng_public.edit_failed', 'lng'), $tbackurl, 1);
}

function wdja_cms_admin_manage_action()
{
  global $ngenre,$ndatabase, $nidfield, $nfpre, $ncontrol;
  switch($_GET['action'])
  {
    case 'add':
      wdja_cms_admin_manage_adddisp();
      break;
    case 'edit':
      wdja_cms_admin_manage_editdisp();
      break;
    case 'delete':
      wdja_cms_admin_deletedisp($ndatabase, $nidfield);
      break;
    case 'control':
      wdja_cms_admin_controldisp($ndatabase, $nidfield, $nfpre, $ncontrol);
      break;
    case 'upload':
      uu_upload_files();
      break;
    case 'uploads':
      uu_uploads_files();
      break;
  }
}

function wdja_cms_admin_manage_add()
{
  global $nupsimg, $nupsimgs;
  $tmpstr = ii_itake('manage.add', 'tpl');
  $tmpstr = str_replace('{$upsimg}', $nupsimg, $tmpstr);
  $tmpstr = str_replace('{$upsimgs}', $nupsimgs, $tmpstr);
  $tmpstr = ii_creplace($tmpstr);
  return $tmpstr;
}

function wdja_cms_admin_manage_edit()
{
  global $conn;
  global $ndatabase, $nidfield, $nfpre, $nupsimg, $nupsimgs;
  $tid = ii_get_num($_GET['id']);
  $tsqlstr = "select * from $ndatabase where $nidfield=$tid";
  $trs = ii_conn_query($tsqlstr, $conn);
  $trs = ii_conn_fetch_array($trs);
  if ($trs)
  {
    $tmpstr = ii_itake('manage.edit', 'tpl');
    foreach ($trs as $key => $val)
    {
      $tkey = ii_get_lrstr($key, '_', 'rightr');
      $GLOBALS['RS_' . $tkey] = $val;
      $tmpstr = str_replace('{$' . $tkey . '}', ii_htmlencode($val), $tmpstr);
    }
    $tmpstr = str_replace('{$id}', $trs[$nidfield], $tmpstr);
    $tmpstr = str_replace('{$type}', ii_get_num($trs[ii_cfname('type')]), $tmpstr);
    $tmpstr = str_replace('{$upsimg}', $nupsimg, $tmpstr);
    $tmpstr = str_replace('{$upsimgs}', $nupsimgs, $tmpstr);
    $tmpstr = ii_creplace($tmpstr);
    return $tmpstr;
  }
  else mm_client_alert(ii_itake('global.lng_public.sudd', 'lng'), -1);
}

function wdja_cms_admin_manage_list()
{
  global $conn, $slng;
  global $ngenre, $nclstype, $npagesize, $nlisttopx;
  global $ndatabase, $nidfield, $nfpre;
  $toffset = ii_get_num($_GET['offset']);
  $tfsid = ii_get_num($_GET['fsid'],0);
  $search_field = ii_get_safecode($_GET['field']);
  $search_keyword = ii_get_safecode($_GET['keyword']);
  $tmpstr = ii_itake('manage.list', 'tpl');
  $tmpastr = ii_ctemplate($tmpstr, '{@recurrence_ida}');
  $tmprstr = '';
  $tsqlstr = "select * from $ndatabase where " . ii_cfname('lng') . "='$slng' and ". ii_cfname('fsid') . "=$tfsid ";
  if ($search_field == 'topic') $tsqlstr .= " and " . ii_cfname('topic') . " like '%" . $search_keyword . "%'";
  if ($search_field == 'good') $tsqlstr .= " and " . ii_cfname('good') . "=" . ii_get_num($search_keyword);
  if ($search_field == 'hidden') $tsqlstr .= " and " . ii_cfname('hidden') . "=" . ii_get_num($search_keyword);
  if ($search_field == 'id') $tsqlstr .= " and $nidfield=" . ii_get_num($search_keyword);
  $tsqlstr .= " order by " . ii_cfname('time') . " desc";
  $tcp = new cc_cutepage;
  $tcp -> id = $nidfield;
  $tcp -> sqlstr = $tsqlstr;
  $tcp -> offset = $toffset;
  $tcp -> pagesize = $npagesize;
  $tcp -> rslimit = $nlisttopx;
  $tcp -> init();
  $trsary = $tcp -> get_rs_array();
  $font_disabled = ii_itake('global.tpl_config.font_disabled', 'tpl');
  $postfix_good = ii_ireplace('global.tpl_config.postfix_good', 'tpl');
  if (!(ii_isnull($search_keyword)) && $search_field == 'topic') $font_red = ii_itake('global.tpl_config.font_red', 'tpl');
  if (is_array($trsary))
  {
    foreach($trsary as $trs)
    {
      $tid = ii_get_num($trs[$nidfield]);
      $tfsid = ii_get_num($trs[ii_cfname('fsid')]);
      $ttopic = ii_htmlencode($trs[ii_cfname('topic')]);
      $ttype = ii_get_num($trs[ii_cfname('type')],0);
      if (isset($font_red))
      {
        $font_red = str_replace('{$explain}', $search_keyword, $font_red);
        $ttopic = str_replace($search_keyword, $font_red, $ttopic);
      }
      if ($trs[ii_cfname('hidden')] == 1) $ttopic = str_replace('{$explain}', $ttopic, $font_disabled);
      if ($trs[ii_cfname('good')] == 1) $ttopic .= $postfix_good;
      global $variable,$nurltype;
      if($ttype == 0) $url = '/'.$ngenre.'/'.ii_iurl('list',$tid, $nurltype);
      else $url = '/'.$ngenre.'/'.ii_iurl('detail',$tid, $nurltype);
      if($ttype == 0) $turl = '?type=list&fsid='.$tid;
      else $turl = '?type=edit&id='.$tid.'&fsid='.$tfsid.'&backurl='.urlencode($GLOBALS['nurl']);
      $tmptstr = str_replace('{$topic}', $ttopic, $tmpastr);
      $tmptstr = str_replace('{$topicstr}', ii_encode_scripts(ii_htmlencode($trs[ii_cfname('topic')])), $tmptstr);
      $tmptstr = str_replace('{$url}', $url, $tmptstr);
      $tmptstr = str_replace('{$turl}', $turl, $tmptstr);
      $tmptstr = str_replace('{$type}', $ttype, $tmptstr);
      $tmptstr = str_replace('{$time}', ii_get_date($trs[ii_cfname('time')]), $tmptstr);
      $tmptstr = str_replace('{$fsid}', $tfsid, $tmptstr);
      $tmptstr = str_replace('{$id}', $tid, $tmptstr);
      $tmprstr .= $tmptstr;
    }
  }
  $tmpstr = str_replace('{$cpagestr}', $tcp -> get_pagenum(), $tmpstr);
  $tmpstr = str_replace(WDJA_CINFO, $tmprstr, $tmpstr);
  $tmpstr = ii_creplace($tmpstr);
  return $tmpstr;
}

function wdja_cms_admin_manage()
{
  switch($_GET['type'])
  {
    case 'add':
      return wdja_cms_admin_manage_add();
      break;
    case 'edit':
      return wdja_cms_admin_manage_edit();
      break;
    case 'list':
      return wdja_cms_admin_manage_list();
      break;
    case 'upload':
      uu_upload_files_html('upload_html');
      break;
    case 'uploads':
      uu_upload_files_html('uploads_html');
      break;
    default:
      return wdja_cms_admin_manage_list();
      break;
  }
}
?>