var genre = document.getElementById('filterForm').getAttribute("genre");
var list = document.getElementById('list_fields');
var as = list.getElementsByTagName("a");

SetRequestParam();

function delClick(obj){
  var a = obj.parentNode.getElementsByTagName("a");
  var idvalue = a[0].getAttribute("id").split("_");
  document.getElementById(idvalue[0]).value = 0;
  document.getElementById("filterForm").submit();
}

(function(){
  for(var i = 0; i < as.length; i++){
    as[i].onclick = function(){
      var idvalue = this.getAttribute("id").split("_");
      document.getElementById('offset').value = 0;
      document.getElementById(idvalue[0]).value = idvalue[1];
      document.getElementById("filterForm").submit();
    };
  }
})();

function show(){
  for(var i = 0; i < as.length; i++){
    var aval = as[i].getAttribute("id").split("_");
    if((utils.getParam(genre + '_' + aval[0]) == aval[1]) && aval[0] == 'classid' && as[i].parentNode.localName != 'strong'){
      for(var a = 1;a < aval.length;a++){
        for(var c = 0; c < as.length; c++){
          var cval = as[c].getAttribute("id").split("_");
          if(aval[a] == cval[1] && cval[0] == 'classid' && as[c].parentNode.localName != 'strong') as[c].className = "show";
        }
      }
    }
  }
  for(var i = 0; i < as.length; i++){
    var aval = as[i].getAttribute("id").split("_");
    if((utils.getParam(genre + '_' + aval[0]) == aval[1]) && as[i].parentNode.localName != 'strong') as[i].className = "show";
    if(utils.getParam(genre + '_' + aval[0]) == 0 || utils.getParam(genre + '_' + aval[0]) == '') as[i].parentNode.getElementsByTagName("strong")[0].className = "show";
  }
}

function SetRequestParam() {
  var url = location.search;//获取url中"?"符后的字串
  var theRequest = new Object();
  if (url.indexOf("?") != -1) {
    var str = url.substr(1);
    strs = str.split("&");
    for(var i = 0; i < strs.length; i ++) {
      if(strs[i].split("=")[0] != 'type'){
        utils.setParam(genre + '_' + strs[i].split("=")[0],unescape(strs[i].split("=")[1]));
      }
    }
  }else{
    var input = document.getElementById('filterForm').getElementsByTagName("input");
    for(var i = 0; i < input.length; i ++) {
    var delid = input[i].getAttribute("id");
      if(delid != 'type'){
        utils.delParam(genre + '_' + delid);
      }
    }
    var strong = list.getElementsByTagName("strong");
    for(var i = 0; i < strong.length; i ++) {
      strong[i].className = "show";
    }
  }
  show();
}