function bsearch(id,obj){
  get_id(id).value=obj.value;
  get_id('btn_search').click();
}

clicktips = {
  init:function(){
    var click_html;
    click_html = '<div class="popup_mask" id="pop_mask" style="display: none;"></div>';
    click_html += '<div class="popup_page on" id="pop_page" style="display: none;">';
    click_html += '<div class="content">';
    click_html += '    <table cellpadding="10" cellspacing="0" class="tableF">';
    click_html += '        <tr>';
    click_html += '        <td>正在处理中，请稍后...</td>';
    click_html += '        </tr>';
    click_html += '    </table>';
    click_html += '</div>';
    click_html += '</div>';
    document.write (click_html);
  },
  go:function(){
    get_id("pop_mask").style.display = 'block';
    get_id("pop_page").style.display = 'block';
    get_id("pop_mask").className = 'popup_mask on';
    get_id("pop_page").className = 'popup_page on';
  }
}

preview = {
  init:function(){
    var preview_html;
    preview_html = "<div class=\"popup_mask\" id=\"popup_mask\" style=\"display:none;\"></div>";
    preview_html += "<div class=\"popup_page\" id=\"popup_page\">";
    preview_html += "<a href=\"javascript:preview.preview_images_close();\" target=\"_self\"><span class=\"close\"></span></a>";
    preview_html += "<div class=\"content\">";
    preview_html += "<div class=\"title\">";
    preview_html += "<input type=\"text\" class=\"title\" value=\"\">";
    preview_html += "</div>";
    preview_html += "<div class=\"attPreview\" id=\"preview_images_bottom\">";
    preview_html += "</div>";
    preview_html += "</div>";
    preview_html += "</div>";
    document.write (preview_html);
  },
  preview_images_close:function()
  {
    get_id("popup_mask").style.display = 'none';
    get_id("popup_mask").className = 'popup_mask';
    get_id("popup_page").className = 'popup_page';
  },
  preview_images:function(strurl, e)
  {
    get_id("popup_mask").style.display = 'block';
    get_id("popup_mask").className = 'popup_mask on';
    get_id("popup_page").className = 'popup_page on';
    get_id("preview_images_bottom").innerHTML = "<img class=\"item\" src=\"" + strurl + "\" border=\"0\" onload=\"if (this.width > 300)this.width = 300;if (this.height > 180)this.height = 180;\" alt=\"" + strurl + "\">";
  },
  preview_img:function(strurl, e)
  {
    var curPosX, curPosY
    var file_arr = strurl.split("#:#");
    var file_arr_len = file_arr.length - 1;
    var file_url = file_arr[file_arr_len];
    var file_title = file_arr[0];
    var file_desc = file_arr[1];
    get_id("popup_mask").style.display = 'block';
    get_id("popup_mask").className = 'popup_mask on';
    get_id("popup_page").className = 'popup_page on';
    get_id("preview_images_bottom").innerHTML = "<img class=\"item\" src=\"" + file_url + "\" border=\"0\" onload=\"if (this.width > 300)this.width = 300;if (this.height > 180)this.height = 180;\" title=\"" + file_title + "\" alt=\"" + file_desc + "\">";
  }
}

popup = {
  getClientHeight: function(obj)
  {
    var clientHeight=0;
    if(document.body.clientHeight&&document.documentElement.clientHeight)
    {
    var clientHeight = (document.body.clientHeight<document.documentElement.clientHeight)?document.documentElement.clientHeight:document.body.clientHeight;
    }
    else
    {
    var clientHeight = (document.body.clientHeight<document.documentElement.clientHeight)?document.documentElement.clientHeight:document.body.clientHeight;
    }
    return clientHeight;
  },
  pop_iframe: function(obj)
  {
    var popdom = get_id("iframe_" + obj);
    var fullWidth = document.body.scrollWidth;
    var leftWidth = 180;
    if(fullWidth<640) leftWidth = 70;
    var myWidth = fullWidth - leftWidth;
    var myHeight = this.getClientHeight();
    if(myWidth>640) myWidth = 780;
    if(fullWidth<640) myWidth = 320;
    if(myHeight>640) myHeight = 640;
    if(fullWidth<640) myHeight = 320;
    popdom.style.cssText = 'width:'+myWidth+'px;min-height:'+ myHeight + 'px';
    popdom.src = popdom.getAttribute("data-src");
    get_id("pop_mask_" + obj).style.display = 'block';
    get_id("pop_page_" + obj).style.display = 'block';
    get_id("pop_mask_" + obj).className = 'popup_mask on';
    get_id("pop_page_" + obj).className = 'popup_page on';
  },
  pop_iframe_close: function(obj)
  {
    get_id("iframe_" + obj).src = '';
    get_id("pop_mask_" + obj).style.display = 'none';
    get_id("pop_page_" + obj).style.display = 'none';
    get_id("pop_mask_" + obj).className = 'popup_mask';
    get_id("pop_page_" + obj).className = 'popup_page';
  },
  pop_del_li: function(obj)
  {
    get_id(obj).parentNode.remove();
    var delid = obj.split('_')[1];
    var vid = obj.split('_')[0] + '_sid';
    var oval = get_id(vid).value;
    var oary = oval.split(',');
    var narys = [];
    for (var i = 0; i < oary.length; i++) {
      if(oary[i] != '' && oary[i] != null && oary[i] != delid) narys.push(oary[i]);
    }
    var nval = narys.join(',')
    get_id(vid).value = nval;
  },
  pop_display: function(strid)
  {
    get_id("pop_mask").style.display = 'block';
    get_id("pop_page").style.display = 'block';
    get_id("pop_add").style.display = 'block';
    get_id("pop_mask").className = 'popup_mask on';
    get_id("pop_page").className = 'popup_page on';
    get_id("strid").value = strid;
  },
  pop_close: function ()
  {
    get_id("pop_mask").style.display = 'none';
    get_id("pop_page").style.display = 'none';
    get_id("pop_add").style.display = 'none';
    get_id("pop_edit").style.display = 'none';
    get_id("pop_mask").className = 'popup_mask';
    get_id("pop_page").className = 'popup_page';
  },
  pop_addok: function (strid){
      var file_title = get_id("file_title").value ;
      var file_desc = get_id("file_desc").value ;
      var file_url = get_id("file_url").value ;
      var opname = file_title ;
      var opvalue = file_title+"#:#"+file_desc+"#:#"+file_url ;
      if (file_title == "" || file_title.length == 0){
          alert(get_id("file_title").getAttribute("msg"));
      }
      else if (file_url == "" || file_url.length == 0){
          alert(get_id("file_url").getAttribute("msg"));
      }
      else{
          selects.add(get_id(strid), opname, opvalue);
          get_id("file_title").value = '';
          get_id("file_desc").value = '';
          get_id("file_url").value = '';
          alert(get_id("file_url").getAttribute("msgok"));
          this.pop_close();
      }
  },
  pop_editdisplay: function(strers)
  {
    get_id("pop_mask").style.display = 'block';
    get_id("pop_page").style.display = 'block';
    get_id("pop_edit").style.display = 'block';
    get_id("pop_mask").className = 'popup_mask on';
    get_id("pop_page").className = 'popup_page on';
  },
  pop_editfile: function(strid, strvalue)
  {
      if(strvalue == "" || strvalue == null || strvalue == undefined){
           alert(get_id("file_url").getAttribute("msgerr"));
      }else{
      this.pop_editdisplay();
      var file_array= new Array();
      file_array = strvalue.split("#:#");;
      get_id("edit_title").value = file_array[0];
      get_id("edit_desc").value = file_array[1];
      get_id("edit_url").value = file_array[2];
      get_id("strid").value = strid;
      }
  },
  pop_editok: function (strid){
      var file_title = get_id("edit_title").value ;
      var file_desc = get_id("edit_desc").value ;
      var file_url = get_id("edit_url").value ;
      var opname = file_title ;
      var opvalue = file_title+"#:#"+file_desc+"#:#"+file_url ;
      if (file_title == "" || file_title.length == 0){
          alert(get_id("edit_title").getAttribute("msg"));
      }
      else if (file_url == "" || file_url.length == 0){
          alert(get_id("edit_url").getAttribute("msg"));
      }
      else{
          selects.remove(get_id(strid));
          selects.add(get_id(strid), opname, opvalue);
          get_id("edit_title").value = '';
          get_id("edit_desc").value = '';
          get_id("edit_url").value = '';
          alert(get_id("edit_url").getAttribute("msgok"));
          this.pop_close();
      }
  },
  pop_insertfile: function(strid, strurl, strntype, strtype, strbase)
  {
    var tstrtype;
    var file_arr = strurl.split("#:#");
    var file_arr_len = file_arr.length - 1;
    var file_url = file_arr[file_arr_len];
    var file_title = file_arr[0];
    var file_desc = file_arr[1];
    if (strtype == -1)
    {tstrtype = strntype;}
    else
    {
      var thtype = request["htype"];
      if (thtype == undefined)
      {tstrtype = strtype;}
      else
      {tstrtype = get_num(thtype);}
    }
    var file_type = get_file_type(strurl);
    switch (tstrtype)
    {
      case 0:
        if(file_type =='mp4' || file_type == 'avi' || file_type == 'webm' || file_type == 'ogg' || file_type == 'wmv' || file_type == 'm4v' || file_type == 'flv' || file_type == 'rm'){
          editor_insert(strid, "<p style=\"text-align: center;\"><video controls=\"controls\" style=\"width:85%;height:auto;max-width:750px;margin:0 auto;\"><source src=\"" + file_url + "\" /></video></p>");
        }else if(file_type =='mp3' || file_type =='wav' || file_type =='wma' || file_type =='flac'){
           editor_insert(strid, "<p style=\"text-align: center;\"><audio controls=\"\" oncontextmenu=\"return false\" autoplay=\"\" controlslist=\"nodownload\" src=\"" + file_url + "\" />!audio not supported .</audio></p>");
        }else if(file_type =='jpg' || file_type =='png' || file_type =='gif' || file_type =='jpeg' || file_type =='bmp' || file_type =='webp'){
           editor_insert(strid, "<p style=\"text-align: center;\"><img src=\"" + file_url + "\" title=\"" + file_title + "\" alt=\"" + file_desc + "\" border=\"0\"></p>");
        }else{
          editor_insert(strid, "<p style=\"text-align: left;\"><strong><a href=\"" + file_url + "\" download>" + file_title + "</a></strong></p>");
        }
        break;
      case 3:
        itextner(strid,  "<img src=\"" + file_url + "\" border=\"0\">");
        break;
    }
  }
}

selects = {
  add: function(strid, strero, strers)
  {
    var tobj = strid;
    if (tobj)
    {
      var ti, tstr, tisext;
      for (ti = 0; ti < tobj.options.length; ti ++)
      {
       if (tobj.options[ti].text == strero &&  tobj.options[ti].value == strers)
       {tisext = true;}
      }
      if (!tisext){tobj.options.add(new Option(strero, strers));}
    }
  },
  remove: function(strid)
  {
    var tobj = strid;
    if (tobj)
    {
      var tidx = tobj.selectedIndex;
      if (!(tidx == -1)){tobj.options[tidx] = null;}
    }
  },
  displace: function(strid, strindex, strkey)
  {
    if (strindex >= 0)
    {
      var tobj = strid;
      if (tobj)
      {
        var tstrvalue, tstrtext;
        tstrtext = tobj.options[strindex].text;
        tstrvalue = tobj.options[strindex].value;
        if (strkey == 38)
        {
          if (!(strindex == 0))
          {
            tobj.options[strindex].text = tobj.options[strindex - 1].text;
            tobj.options[strindex].value = tobj.options[strindex - 1].value;
            tobj.options[strindex - 1].text = tstrtext;
            tobj.options[strindex - 1].value = tstrvalue;
          }
        }
        if (strkey == 40)
        {
          if (!(strindex == (tobj.options.length - 1)))
          {
            tobj.options[strindex].text = tobj.options[strindex + 1].text;
            tobj.options[strindex].value = tobj.options[strindex + 1].value;
            tobj.options[strindex + 1].text = tstrtext;
            tobj.options[strindex + 1].value = tstrvalue;
          }
        }
      }
    }
  }
}