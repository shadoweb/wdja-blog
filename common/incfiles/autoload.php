<?php
$file = __DIR__. DIRECTORY_SEPARATOR;
$dopath = dirname($_SERVER["SCRIPT_FILENAME"]) . DIRECTORY_SEPARATOR;
$webpath = str_replace('common/incfiles/','',str_replace('\\','/',$file));
if(is_file($file.'const.inc.php')) require_once($file.'const.inc.php');
if(is_file($file.'class.inc.php')) require_once($file.'class.inc.php');
if(is_file($file.'function.inc.php')) require_once($file.'function.inc.php');
if(is_file($file.'ip.inc.php')) require_once($file.'ip.inc.php');
if(is_file($file.'save_images.inc.php')) require_once($file.'save_images.inc.php');
if(is_file($file.'oss.inc.php')) require_once($file.'oss.inc.php');
if(is_file($file.'common.inc.php')) require_once($file.'common.inc.php');
if(is_file($file.'admin.inc.php')) require_once($file.'admin.inc.php');
if(is_file($file.'upfiles.inc.php')) require_once($file.'upfiles.inc.php');
//主题函数文件引用
$current_theme = ii_isMobileAgent() ? MOBILE_SKIN : DEFAULT_SKIN;
$themes_guide = $webpath.'support/themes/themes.php';
$themes_function = $webpath.'support/themes/'.$current_theme.'/common/incfiles/theme.inc.php';
if(is_file($themes_guide)) require_once($themes_guide);
if(is_file($themes_function)) require_once($themes_function);
//模块配置文件引用
$config_file = $dopath.'common/incfiles/config.inc.php';
if(is_file($config_file)) require_once($config_file);
//模块函数文件引用
$module_config_file = $dopath.'common/incfiles/' . (ii_isAdmin() ? 'manage_config.inc.php' : 'module_config.inc.php');
if(is_file($module_config_file)) require_once($module_config_file);
//功能插件函数文件引用
ii_require_ApiFile($webpath);
//定时功能引用
if(is_file($webpath.'cron.php')) require_once($webpath.'cron.php');
?>