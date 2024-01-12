var agt = navigator.userAgent.toLowerCase();
var isie = (agt.indexOf("msie")!= -1 && document.all);
var client_test;

if (document.getElementById)
{ client_test = "a"; }
else if (document.all)
{ client_test = "b"; }
else if (document.layers)
{ client_test = "c"; }

if(!window.localStorage){
    alert("浏览器不支持localstorage");
    console.log('Web storage is not supported..');
}else{
    var utils = {
        setParam : function (name,value){
            localStorage.setItem(name,value);
        },getParam : function(name){
            return localStorage.getItem(name)
        },delParam:function(name){
            return localStorage.removeItem(name)
        }
    }
}

var request = new function()
{
  var iname,ivalue,icount;
  var urlstr = location.href;
  var inum = urlstr.indexOf("?")
  urlstr = urlstr.substr(inum + 1);
  var arrtmp = urlstr.split("&");
  for(icount = 0; icount < arrtmp.length; icount++)
  {
    inum = arrtmp[icount].indexOf("=");
    if(inum > 0)
    {
      iname = arrtmp[icount].substring(0, inum);
      ivalue = arrtmp[icount].substr(inum + 1);
      this[iname] = ivalue;
    }
  }
}

var xmlhttp = function()
{
  var xmlObj = null;
  if(window.XMLHttpRequest){
      xmlObj = new XMLHttpRequest();
  } else if(window.ActiveXObject){
      xmlObj = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
      return;
  }
  return xmlObj;
}

function click_return(strt)
{
  var tmpvar = strt;
  var tmptrue = window.confirm(tmpvar);
  if (tmptrue) { return true; }
  return false;
}

function get_id(strname)
{
  switch (client_test)
  {
    case "a":
      return document.getElementById(strname);
      break;
    case "b":
      return document.layers[strname];
      break;
    default :
      return document.all(strname);
      break;
  }
}

function get_file_type(fileurl)
{
  var file_pre_length = fileurl.lastIndexOf(".");
  var file_length = fileurl.length;
  var file_type = fileurl.substring(file_pre_length + 1, file_length );
  return file_type;
}

function get_num(strers)
{
  if (isNaN(strers) || strers == "")
  {
    return 0;
  }
  else
  {
    return parseInt(strers);
  }
}

function get_sel_id(obj)
{
  var obj = arguments[0] ? arguments[0] : '';
  var frm = eval("document.sel_form");
  if (frm.sel_id.length)
  {
    var sel_ids = '';
    var slength = frm.sel_id.length;
    for (var i = 0; i < slength; i++)
    {
      if (frm.sel_id[i].checked)
      {
        if (sel_ids == '')
        {
          sel_ids = frm.sel_id[i].value;
        }
        else
        {
          sel_ids = sel_ids + ',' + frm.sel_id[i].value;
        }
      }
    }
  }
  else
  {
    if (frm.sel_id.value)
    {
      if (frm.sel_id.checked) sel_ids = frm.sel_id.value;
    }
  }
  document.sel_form.sel_ids.value = sel_ids;
}

function get_selects_list(strid)
{
  var tobj = strid;
  if (tobj)
  {
    var ti,tstr;
    tstr = "";
    for (ti = 0; ti < tobj.options.length; ti ++)
    {
      if (tstr == "")
      {tstr = tobj.options[ti].value;}
      else
      {tstr += "|" + tobj.options[ti].value;}
    }
    return tstr;
  }
}

function iget(strers)
{
  var nxmlhttp = new xmlhttp();
  nxmlhttp.open("get", strers, false);
  nxmlhttp.send(null);
  return nxmlhttp.responseText;
}

function igets(strers, callback)
{
  var nxmlhttp = new xmlhttp();
  nxmlhttp.onreadystatechange = function()
  {
    if (nxmlhttp.readyState == 4)
    {
      if (nxmlhttp.status == 200 || nxmlhttp.status == 304)
      {
        callback(nxmlhttp.responseText);
      }
      else
      {
        callback("$error$")
      }
    }
  }
  nxmlhttp.open("get", strers, true);
  nxmlhttp.send(null);
}

function igets_xml(strers, callback)
{
  var nxmlhttp = new xmlhttp();
  nxmlhttp.onreadystatechange = function()
  {
    if (nxmlhttp.readyState == 4)
    {
      if (nxmlhttp.status == 200 || nxmlhttp.status == 304)
      {
        callback(nxmlhttp.responseXML);
      }
      else
      {
        callback("$error$")
      }
    }
  }
  nxmlhttp.open("get", strers, true);
  nxmlhttp.send(null);
}

function itextner(strid, strers)
{
  var tobj;
  tobj = get_id(strid);
  if (isie)
  {
    tobj.focus();
    document.selection.createRange().text = strers;
  }
  else
  {
    tobj.focus();
    tobj.value += strers;
  }
}

function iresize(stro, stra, strv)
{
  switch(stra)
  {
    case 1:
      if (stro.width > strv) stro.width = strv;
      break;
    case 2:
      if (stro.height > strv) stro.height = strv;
      break;
    default:
      if (stro.width > strv) stro.width = strv;
  }
}

function location_href(strers)
{
  var tburl = strers;
  var tbbase = get_id("base");
  if (tbbase)
  {
    var tbhref = get_id("base").href;
    if (tbhref) tburl = tbhref + tburl;
  }
  location.href = tburl;
}

function nhrefstate()
{
  var nhref = request["hspan"];
  if(!nhref == "")
  {
    var nhrefobj = get_id(nhref);
    if (nhrefobj)
    {
      nhrefobj.className = "on";
    }
  }
}

function nll(strers)
{}

function switch_display(obj,strers)
{
  var tobj = get_id(strers);
  var pobj = get_id("lists").getElementsByTagName('dl');
  var sobj = get_id("lists").getElementsByTagName('span');
  if(tobj.className == '')
  {
   for(var i = 0; i<pobj.length; i++){
        pobj[i].className = '';
    }
   for(var j = 0; j<sobj.length; j++){
        if(sobj[j].className == 'tit t1 open') sobj[j].className = 'tit t1';
    }
    obj.className = 'tit t1 open';
    tobj.className = 'open';
  }
    else
  {
    obj.className = 'tit t1';
    tobj.className = '';
  }
  var tcontainer = get_id("container");
  var ttopbar = get_id("topbar");
  var fullWidth = document.body.scrollWidth;
  var leftWidth = 180;
  if(fullWidth<640) leftWidth = 70;
  var myWidth = fullWidth - leftWidth;
  document.getElementById('main').style.cssText = 'width:'+myWidth+'px;height:'+(getClientHeight() - ttopbar.offsetHeight) + 'px';
  tcontainer.style.height = (getClientHeight() - ttopbar.offsetHeight) + 'px';
}

function getClientHeight()
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
}

function switch_display_a(strers)
{
  var tlists = get_id("lists");
  var pobj = strers.parentNode.parentNode.parentNode;
  if (tlists.className == "leftmenu min")
  {
  pobj.className = '';
  }
}

function switch_display_default(strers)
{
  var tobj = get_id(strers);
  if(tobj.style.display == 'none')
  {
    tobj.style.display = '';
  }
    else
  {
    tobj.style.display = 'none';
  }
}

function iframe_onload(strers)
{
  var tsrc = strers.contentWindow.location.href;
  var tasrc = get_id("lists").getElementsByTagName('a');
   for(var i = 0; i<tasrc.length; i++){
        if(tasrc[i].href == tsrc) tasrc[i].parentNode.className = "tit t2 on";
        else tasrc[i].parentNode.className = "tit t2";
    }
    if(tsrc.indexOf("?site_language=") != -1) window.location.reload();
}

function select_all()
{
  var frm = eval("document.sel_form");
  if (frm.sel_id == null) {return false;}
  var sall = frm.sel_all.checked;
  if(sall){
    frm.sel_alls.checked = true;
    if (frm.sel_id.length)
    {
      var s1 = frm.sel_id.length;
      for (var i = 0; i < s1; i++) { frm.sel_id[i].checked = true; }
     }else{ frm.sel_id.checked = true; }
   }else{
    frm.sel_alls.checked = false;
    if (frm.sel_id.length)
    {
      var s2 = frm.sel_id.length;
      for (var j = 0; j < s2; j++) { frm.sel_id[j].checked = false; }
     }else{ frm.sel_id.checked = false; }                     
   }
}

function select_alls()
{
  var frm = eval("document.sel_form");
  if (frm.sel_id == null) {return false;}
  var salls = frm.sel_alls.checked;
  if(salls){
    frm.sel_all.checked = true;
    if (frm.sel_id.length)
    {
      var s1 = frm.sel_id.length;
      for (var i = 0; i < s1; i++) { frm.sel_id[i].checked = true; }
     }else{ frm.sel_id.checked = true; }
   }else{
    frm.sel_all.checked = false;
    if (frm.sel_id.length)
    {
      var s2 = frm.sel_id.length;
      for (var j = 0; j < s2; j++) { frm.sel_id[j].checked = false; }
     }else{ frm.sel_id.checked = false; }                     
   }
}

function createXMLHttpRequest() {
  var xmlHttp;
  try{
      xmlHttp = new XMLHttpRequest();
  } catch (e) {
      try {
          xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
          try{
              xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e){
          alert("Your browser does not support AJAX！");
          }
      }
  }            
  return xmlHttp;
}
    
function GetRequest() {
   var url = location.search;
   var theRequest = new Object();  
   if (url.indexOf("?") != -1) {  
      var str = url.substr(1);  
      strs = str.split("&");  
      for(var i = 0; i < strs.length; i ++) {  
         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
      }  
   }
   return theRequest;  
}

function inputSwitch(obj){
    var thisObj = obj;
    var thisVal = thisObj.getElementsByTagName('input')[0];
    if (thisObj.getAttribute('bind') == '1')
    {
    	if(thisVal.value == 0){
		    thisObj.className = 'switch switch-1';
		    thisVal.value = 1;
    	}else{
		    thisObj.className = 'switch';
		    thisVal.value = 0;
    	}
    }else{
	    thisObj.setAttribute("bind","1");
    }
}

function jscheck_topics(strers)
{
  var tstrers = strers;
  if (tstrers == "1") get_id("view_topic").style.display = "inline-block"; 
  else get_id("view_topic").style.display = "none";
}

function jscheck_topic(strtopic,strid)
{
  var strid = arguments[1] ? arguments[1] : '';
  if (strtopic == "") return false;
  if (strid == "") igets("manage.php?type=check_topic&topic=" + strtopic, jscheck_topics);
  else igets("manage.php?type=check_topic&topic=" + strtopic + "&id=" + strid, jscheck_topics);
}

function setTab(name,cursel,n){
    for(i=1;i<=n;i++){
        var menu=document.getElementById(name+i);
        var con=document.getElementById("con_"+name+"_"+i);
        menu.className=i==cursel?"hover":"";
        con.className=i==cursel?"hover":"";
        con.style.display=i==cursel?"block":"none";
    }
}

function resetWidthHeight(id) 
{ 
  var e=document.getElementById(id); 
  var con=e.innerHTML; 
  con = con.replace(/[ \t]*height[ \t]*=[ \t]*("[^"]+")|('[^']+')/ig,""); 
  con = con.replace(/[ \t]*height[ \t]*=[ \t]*[^ \t]+/ig,"");
  con = con.replace(/<img[^>]*>/gi, function (match,capture) {
    return match.replace(/style\s*?=\s*?(['"])[\s\S]*?\1/ig,'style="max-width:90%;height:auto;margin:0 auto;text-align:center;"');
  });
  e.innerHTML=con; 
}

Validator = {
  Require : /.+/,
  Email : /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
  Phone : /^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/,
  Mobile : /^((\(\d{3}\))|(\d{3}\-))?1\d{10}$/,
  Url : /^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,
  IdCard : /^[1-9]\d{5}(18|19|20)\d{2}((0[1-9])|(1[0-2]))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/,
  Currency : /^\d+(\.\d+)?$/,
  Number : /^\d+$/,
  Zip : /^[1-9]\d{5}$/,
  QQ : /^[1-9]\d{4,8}$/,
  Integer : /^[-\+]?\d+$/,
  Double : /^[-\+]?\d+(\.\d+)?$/,
  English : /^[A-Za-z]+$/,
  Chinese :  /^[\u0391-\uFFE5]+$/,
  UnSafe : /^(([A-Z]*|[a-z]*|\d*|[-_\~!@#\$%\^&\*\.\(\)\[\]\{\}<>\?\\\/\'\"]*)|.{0,5})$|\s/,
  IsSafe : function(str){return !this.UnSafe.test(str);},
  SafeString : "this.IsSafe(value)",
  Limit : "this.limit(value.length,getAttribute('min'),  getAttribute('max'))",
  LimitB : "this.limit(this.LenB(value), getAttribute('min'), getAttribute('max'))",
  Date : "this.IsDate(value, getAttribute('min'), getAttribute('format'))",
  Repeat : "value == document.getElementsByName(getAttribute('to'))[0].value",
  Range : "getAttribute('min') < value && value < getAttribute('max')",
  Compare : "this.compare(value,getAttribute('operator'),getAttribute('to'))",
  Custom : "this.Exec(value, getAttribute('regexp'))",
  Group : "this.MustChecked(getAttribute('name'), getAttribute('min'), getAttribute('max'))",
  ErrorItem : [document.forms[0]],
  ErrorMessage : ["Tips:"],
  Validate : function(theForm, mode){
    var obj = theForm || event.srcElement;
    var count = obj.elements.length;
    this.ErrorMessage.length = 1;
    this.ErrorItem.length = 1;
    this.ErrorItem[0] = obj;
    for(var i=0;i<count;i++){
      with(obj.elements[i]){
        var _dataType = getAttribute("dtype");
        if(typeof(_dataType) == "object" || typeof(this[_dataType]) == "undefined")  continue;
        this.ClearState(obj.elements[i]);
        if(getAttribute("require") == "false" && value == "") continue;
        switch(_dataType){
          case "Date" :
          case "Repeat" :
          case "Range" :
          case "Compare" :
          case "Custom" :
          case "Group" : 
          case "Limit" :
          case "LimitB" :
          case "SafeString" :
            if(!eval(this[_dataType]))  {
              this.AddError(i, getAttribute("dmsg"));
            }
            break;
          default :
            if(!this[_dataType].test(value)){
              this.AddError(i, getAttribute("dmsg"));
            }
            break;
        }
      }
    }
    if(this.ErrorMessage.length > 1){
      mode = mode || 1;
      var errCount = this.ErrorItem.length;
      switch(mode){
      case 2 :
        for(var i=1;i<errCount;i++)
          this.ErrorItem[i].style.color = "red";
      case 1 :
        alert(this.ErrorMessage.join("\n"));
        this.ErrorItem[1].focus();
        break;
      case 3 :
        for(var i=1;i<errCount;i++){
        try{
          var span = document.createElement("SPAN");
          span.id = "__ErrorMessagePanel";
          span.style.color = "red";
          this.ErrorItem[i].parentNode.appendChild(span);
          span.innerHTML = this.ErrorMessage[i].replace(/\d+:/,"&nbsp;*");
          }
          catch(e){alert(e.description);}
        }
        this.ErrorItem[1].focus();
        break;
      default :
        alert(this.ErrorMessage.join("\n"));
        break;
      }
      return false;
    }
    return true;
  },
  limit : function(len,min, max){
    min = min || 0;
    max = max || Number.MAX_VALUE;
    return min <= len && len <= max;
  },
  LenB : function(str){
    return str.replace(/[^\x00-\xff]/g,"**").length;
  },
  ClearState : function(elem){
    with(elem){
      if(style.color == "red")
        style.color = "";
      var lastNode = parentNode.childNodes[parentNode.childNodes.length-1];
      if(lastNode.id == "__ErrorMessagePanel")
        parentNode.removeChild(lastNode);
    }
  },
  AddError : function(index, str){
    this.ErrorItem[this.ErrorItem.length] = this.ErrorItem[0].elements[index];
    this.ErrorMessage[this.ErrorMessage.length] = this.ErrorMessage.length + ":" + str;
  },
  Exec : function(op, reg){
    return new RegExp(reg,"g").test(op);
  },
  compare : function(op1,operator,op2){
    switch (operator) {
      case "NotEqual":
        return (op1 != op2);
      case "GreaterThan":
        return (op1 > op2);
      case "GreaterThanEqual":
        return (op1 >= op2);
      case "LessThan":
        return (op1 < op2);
      case "LessThanEqual":
        return (op1 <= op2);
      default:
        return (op1 == op2);            
    }
  },
  MustChecked : function(name, min, max){
    var groups = document.getElementsByName(name);
    var hasChecked = 0;
    min = min || 1;
    max = max || groups.length;
    for(var i=groups.length-1;i>=0;i--)
      if(groups[i].checked) hasChecked++;
    return min <= hasChecked && hasChecked <= max;
  },
  IsDate : function(op, formatString){
    formatString = formatString || "ymd";
    var m, year, month, day;
    switch(formatString){
      case "ymd" :
        m = op.match(new RegExp("^((\\d{4})|(\\d{2}))([-./])(\\d{1,2})\\4(\\d{1,2})$"));
        if(m == null ) return false;
        day = m[6];
        month = m[5]--;
        year =  (m[2].length == 4) ? m[2] : GetFullYear(parseInt(m[3], 10));
        break;
      case "dmy" :
        m = op.match(new RegExp("^(\\d{1,2})([-./])(\\d{1,2})\\2((\\d{4})|(\\d{2}))$"));
        if(m == null ) return false;
        day = m[1];
        month = m[3]--;
        year = (m[5].length == 4) ? m[5] : GetFullYear(parseInt(m[6], 10));
        break;
      default :
        break;
    }
    if(!parseInt(month)) return false;
    month = month==12 ?0:month;
    var date = new Date(year, month, day);
        return (typeof(date) == "object" && year == date.getFullYear() && month == date.getMonth() && day == date.getDate());
    function GetFullYear(y){return ((y<30 ? "20" : "19") + y)|0;}
  }
 }