<?php
require('../common/incfiles/autoload.php');
if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Please provide a date range.");
}

$diff = strtotime($_GET['end']) - strtotime($_GET['start']);
if(abs(round($diff / 86400))==7) $middle_time = date('Y-m-d H:i:s',strtotime("+3 days",strtotime($_GET['start'])));
else $middle_time = date('Y-m-d H:i:s',strtotime("+15 days",strtotime($_GET['start'])));

$time_zone = null;
if (isset($_GET['timeZone'])) {
  $time_zone = new DateTimeZone($_GET['timeZone']);
}

$json = get_events_json($middle_time);

$input_arrays = json_decode($json, true);

echo json_encode($input_arrays);

function get_events_json($date=''){
  global $conn,$variable,$nurltype,$nurlpre;
  $genre = 'note';
  $ndatabase = $variable[ii_cvgenre($genre) . '.ndatabase'];
  $nidfield = $variable[ii_cvgenre($genre) . '.nidfield'];
  $nfpre = $variable[ii_cvgenre($genre) . '.nfpre'];
  $isurl = ii_get_num($variable[ii_cvgenre($genre) . '.isurl'],0);
  if(!ii_isnull($date)) $now = $date;
  else $now = ii_now();
  $now_year = ii_format_date($now,7);
  $now_month = ii_format_date($now,12);
  $tsqlstr = 'select * from '.$ndatabase.' where '.ii_cfnames($nfpre,'hidden').' = 0 and Year('.ii_cfnames($nfpre,'start').') = '.$now_year.' and (Month('.ii_cfnames($nfpre,'start').') = '.$now_month.' || Month('.ii_cfnames($nfpre,'start').') = '.$now_month.'-1 || Month('.ii_cfnames($nfpre,'start').') = '.$now_month.'+1)';
  $trs = ii_conn_query($tsqlstr, $conn);
  $rsa = ii_conn_fetch_all($trs);
  $res = array();
  for($i=0;$i<count($rsa);$i++){
      $isallday = $rsa[$i][ii_cfnames($nfpre,'isallday')];
      $isend = $rsa[$i][ii_cfnames($nfpre,'isend')];
      $res[$i]['id'] = $rsa[$i][$nidfield];
      $res[$i]['title'] = $rsa[$i][ii_cfnames($nfpre,'topic')];
      if($isurl == 1)$res[$i]['url'] = $nurlpre.'/'.$genre.'/'.ii_iurl('detail', $rsa[$i][$nidfield], $nurltype);
      $res[$i]['start'] = $rsa[$i][ii_cfnames($nfpre,'start')];
      if($isend == 1) $res[$i]['end'] = $rsa[$i][ii_cfnames($nfpre,'end')];
      if($isallday == 1) $res[$i]['allDay'] = $isallday;
      if($isallday == 1 && $isend == 1){
          $end = $rsa[$i][ii_cfnames($nfpre,'end')];
          $end_new = date('Y-m-d',strtotime("+1 days",strtotime($end)));
          $res[$i]['end'] = $end_new;
          
      }
  }
  return json_encode($res);
}