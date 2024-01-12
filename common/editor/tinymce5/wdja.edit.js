function image_upload_handler(blobInfo, succFun, failFun)
{
  var xhr, formData;
  var file = blobInfo.blob();//转化为易于理解的file对象
  var domain = document.domain;
  var url='';
  var port = window.location.port ? window.location.port : 80;
  if(port == 443 || port == 80) url = '//'+domain+'/upload.php';
  else url = '//'+domain+':'+port+'/upload.php';
  xhr = new XMLHttpRequest();
  xhr.withCredentials = false;
  xhr.open('POST', url);
  xhr.onload = function()
  {
      var json;
      if (xhr.status != 200) {
          failFun('HTTP Error: ' + xhr.status);
          return;
      }
      json = JSON.parse(xhr.responseText);
      if (!json || typeof json.location != 'string') {
          failFun('Invalid JSON: ' + xhr.responseText);
          return;
      }
      succFun(json.location);
  };
  formData = new FormData();
  formData.append('file', file, file.name );//此处与源文档不一样
  xhr.send(formData);
};

tinymce.init({
  autosave_ask_before_unload: false,
  selector: 'textarea.wdjaedit',
  menubar: false,
  toolbar_items_size: 'small',
  language:'zh_CN',
  convert_urls: false,
  remove_script_host: false,
  branding: false,
  width: '100%', 
  min_height: 500,
  max_height:650,
  plugins: 'preview clearhtml searchreplace layout fullscreen image imagetools media code codesample table charmap hr pagebreak anchor advlist lists indent2em lineheight formatpainter powerpaste letterspacing wordcount autoresize link importword',
  toolbar1: 'preview |code fullscreen undo redo importword cut copy paste forecolor backcolor bold italic underline strikethrough alignment formatpainter searchreplace subscript superscript fontselect fontsizeselect',
  toolbar2: '|formatselect link unlink table image layout removeformat alignleft aligncenter alignright indent2em outdent indent lineheight letterspacing media charmap hr pagebreak clearhtml codesample bullist numlist blockquote',
  mobile: {
    min_height: 300,
    max_height:450,
    toolbar1: 'code undo redo importword cut copy paste forecolor bold link unlink table image layout clearhtml removeformat media codesample',
    toolbar2: ''
  },
  toolbar_mode: 'sliding',
  end_container_on_empty_block:true,
  paste_data_images:true,
  powerpaste_word_import: 'propmt',
  powerpaste_html_import: 'propmt',
  powerpaste_allow_local_images: true,
  images_upload_handler: image_upload_handler,
  fontsize_formats: '12px 14px 16px 18px 24px 36px 48px 56px 72px',
  font_formats: '微软雅黑=Microsoft YaHei,Helvetica Neue,PingFang SC,sans-serif;苹果苹方=PingFang SC,Microsoft YaHei,sans-serif;宋体=simsun,serif;仿宋体=FangSong,serif;黑体=SimHei,sans-serif;Arial=arial,helvetica,sans-serif;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats;',
  importword_filter: function(result,insert,message)
  {
    insert(result)
  }
}).then(function(res){});
 
function editor_insert(strid, strers)
{
  tinyMCE.execCommand("mceInsertContent", false, strers);
}