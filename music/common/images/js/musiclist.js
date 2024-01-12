function addMusic(id, topic) {
    var music = {'id': id,'name': topic}
    goList.addMusic(music);
};
var goList = {
    init: function(url,topic) {
        this.url = url;
        this.listTopic=topic;
        this.updateMusic(url);
    },
    addMusic: function(music) {
        var wdjaMusic = utils.getParam("wdjaMusic");
        if (wdjaMusic == null || wdjaMusic == "") {
            var jsonstr = {"musiclist": [{"id": music.id,"name": music.name}]};
            utils.setParam("wdjaMusic", JSON.stringify(jsonstr));
        } else {
            var jsonstr = JSON.parse(wdjaMusic);
            var musiclist = jsonstr.musiclist;
            var result = false;
            for (var i in musiclist) {
                if (musiclist[i].id == music.id) result = true;
                if (result) break;
            }
            if (!result) {
                musiclist.push({"id": music.id,"name": music.name});
            }
            utils.setParam("wdjaMusic", JSON.stringify(jsonstr));
        }
        this.updateMusic(this.url);
    },
    delMusic: function(id) {
        var wdjaMusic = utils.getParam("wdjaMusic");
        var jsonstr = JSON.parse(wdjaMusic);
        var musiclist = jsonstr.musiclist;
        var list = [];
        for (var i in musiclist) {
            if (musiclist[i].id !== id) list.push(musiclist[i]);
        }
        jsonstr.musiclist = list;
        utils.setParam("wdjaMusic", JSON.stringify(jsonstr));
        this.updateMusic(this.url);
    },
    updateMusic: function(url) {
        var resList = document.getElementById('musiclist');
        var wdjaMusic = utils.getParam("wdjaMusic");
        if(wdjaMusic){
            var jsonstr = JSON.parse(wdjaMusic);
            var musiclist = jsonstr.musiclist;
            var wrapLeft = document.getElementById('wrap-left');
            var wrapRight = document.getElementById('wrap-right');
            var wrapTopic = document.getElementById('wrap-topic');
            if(musiclist.length>0){
                var resTopic = '';
                resTopic = document.createElement("h3");
                resTopic.id = 'wrap-topic';
                resTopic.innerHTML = '<i class="menu-item-icon fa fa-fw fa-navicon"></i>'+this.listTopic;
                wrapLeft.style.display='';
                if(document.documentElement.clientWidth > 767){
                    wrapLeft.style.width='45%';
                    wrapRight.style.width='50%';
                }else{
                    wrapLeft.style.width='100%';
                    wrapRight.style.width='100%';
                }
                var resLi = '';
                for (var i in musiclist) {
                    var id = musiclist[i].id;
                    var name = musiclist[i].name;
                    resLi += '<li><a href="' + url + id + '" >' + name + '</a>&nbsp;<span onclick="goList.delMusic(\'' + id + '\')"><i class="menu-item-icon fa fa-fw fa-trash"></i></span></li>';
                }
                resList.innerHTML = resLi;
                if(resList.offsetHeight > 350) resList.style.overflowY='scroll';
                if(!wrapTopic) resList.parentNode.insertBefore(resTopic,resList);
            }else{
                wrapLeft.style.display='none';
                wrapRight.style.width='100%';
            }
        }
    }
};