<?php
function wdja_cms_admin_manage_delete($dir='')
{
  global $nuri;
  $tfile = $_GET['file'];
  $badstr = array("/","..","../","<", ">", "--", ":/", "\0", "\'", "\/\*","\.\.\/", "\.\/", "%00", "\r",' ', '"', "'", "   ", "%3C", "%3E", "'",'#','=','`','$','&',';','(',')', '<?', '?>');
  foreach($badstr as $key) {
    if (strstr($tfile,$key))
    {
        wdja_cms_admin_msg(ii_itake('manage.delete_error', 'lng'), $nuri, 1);
    }
  }
  $tcache_dir = ii_get_actual_route('./') . CACHE_DIR;
  if (!ii_isnull($dir))
  {
    $tcache_dir .= '/'.$dir;
    $tbackurl = $nuri.'?type='.$dir.'&hspan=nav_'.$dir;
  }
  else $tbackurl = $nuri.'?type=list&hspan=nav_list';
  $tfilename = $tcache_dir . '/' . $tfile;
  $tfilename = iconv (CHARSET, 'cp936', $tfilename);
  if (unlink($tfilename))
  {
    wdja_cms_admin_msg(ii_itake('manage.delete_success', 'lng'), $tbackurl, 1);
  }
  else
  {
    wdja_cms_admin_msg(ii_itake('manage.delete_error', 'lng'), $tbackurl, 1);
  }
}

function wdja_cms_admin_manage_removeall($dir='')
{
  global $nuri;
  $type = 'list';
  if (!ii_isnull($dir))
  {
    @ii_cache_remove('',$dir);
    $tbackurl = $nuri.'?type='.$dir.'&hspan=nav_'.$dir;
  }else{
    @ii_cache_remove();
    $tbackurl = $nuri.'?type=list&hspan=nav_list';
  }
  wdja_cms_admin_msg(ii_itake('manage.delete_success', 'lng'), $tbackurl, 1);
}

function wdja_cms_admin_manage_action()
{
  switch($_GET['action'])
  {
    case 'delete':
      wdja_cms_admin_manage_delete();
      break;
    case 'php':
      wdja_cms_admin_manage_delete('php');
      break;
    case 'html':
      wdja_cms_admin_manage_delete('html');
      break;
    case 'removeall':
      wdja_cms_admin_manage_removeall();
      break;
    case 'removephp':
      wdja_cms_admin_manage_removeall('php');
      break;
    case 'removehtml':
      wdja_cms_admin_manage_removeall('html');
      break;
  }
}

function wdja_cms_admin_manage_list($dir='')
{
  global $nuri;
  $hspan = 'nav_list';
  if (!ii_isnull($dir))
  {
    $type = $dir;
	$hspan = 'nav_'.$dir;
    $tmpstr = ii_ireplace('manage.list_'.$dir, 'tpl');
  }
  else  $tmpstr = ii_ireplace('manage.list', 'tpl');
  $tmpastr = ii_ctemplate($tmpstr, '{#recurrence_ida}');
  $tcache_dir = ii_get_actual_route('./') . CACHE_DIR;
  if (!ii_isnull($dir)) $tcache_dir .= '/'.$dir;
  if (!(is_dir($tcache_dir))) @mkdir($tcache_dir, 0700);
  $tcdirs = dir($tcache_dir);
  $cache_arys=array();
  while($tentry = $tcdirs -> read())
  {
    if (is_numeric(strpos($tentry, '.')))
    {
      $ttentry = iconv('cp936', CHARSET, $tentry);
      $tcachename = ii_get_lrstr($ttentry, '.', 'left');
      if (!(ii_isnull($tcachename)))
      {
        $cache_arys[$tcachename] = urlencode($ttentry);
      }
    }
  }
  $tcdirs -> close();
  $totals = count($cache_arys);
  $pageno = '20';
  $pages = ceil($totals/$pageno);
  if($totals>0){
    $cache_ary = array_slice($cache_arys,$start,$pageno);
    foreach($cache_ary as $k => $v){
        $tmptstr = str_replace('{$cache_name}', $k, $tmpastr);
        $tmptstr = str_replace('{$file_name}', $v, $tmptstr);
        $tmprstr = $tmprstr . $tmptstr;
    }
  }
  $tmpstr = str_replace(WDJA_CINFO, $tmprstr, $tmpstr);
  $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
  $page = $page > 100 ? 100 : $page;
  $start = 0;
  if($page > 1) $start = ($page-1)*$pageno;
  $pagestr = '';
  $prepage = ($page - 1) > 0 ? $page - 1 : 1;
  $nextpage = ($page + 1) < $pages ? $page + 1 : $pages;
  $pagestr .= '<a style="padding:3px 10px;border:1px solid #666;" href="'.$nuri.'?type='.$type.'&page='.$prepage.'&hspan='.$hspan.'">上一页</a>  ';
  for($i=1;$i<=$pages;$i++){
      if($i == $page) $pagestr .= '<a style="display: inline-block;margin:5px;padding:3px 10px;border:1px solid #666;background:#666;color:#eee;" href="'.$nuri.'?type='.$type.'&page='.$i.'&hspan='.$hspan.'">'.$i.'</a>  ';
      else $pagestr .= '<a style="display: inline-block;margin:5px;padding:3px 10px;border:1px solid #666;" href="'.$nuri.'?type='.$type.'&page='.$i.'&hspan='.$hspan.'">'.$i.'</a>';
  }
  $pagestr .= '<a style="margin:5px;padding:3px 10px;border:1px solid #666;" href="'.$nuri.'?type='.$type.'&page='.$nextpage.'&hspan='.$hspan.'">下一页</a>';
  $pagestr .= '<a style="padding:3px 10px;border:1px solid #666;background:#666;color:#eee;">共'.$pages.'页</a>';
  if($totals - $pageno <= 0 ) $pagestr = '';
  $tmpstr = str_replace('{$pagestr}', $pagestr, $tmpstr);
  return $tmpstr;
}

function wdja_cms_admin_manage()
{
  switch($_GET['type'])
  {
    case 'list':
      return wdja_cms_admin_manage_list();
      break;
    case 'php':
      return wdja_cms_admin_manage_list('php');
      break;
    case 'html':
      return wdja_cms_admin_manage_list('html');
      break;
    default:
      return wdja_cms_admin_manage_list();
      break;
  }
}
?>