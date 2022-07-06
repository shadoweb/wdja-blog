//参考:https://github.com/wayou/selected

var goMusic = {
    init: function(songId,songUrl,songName,songLrc,noLrctxt,loadingLrc,loadLrcFail) {
        this.player = document.getElementById('player');
        this.audio = document.getElementById('audio');
        this.lyricContainer = document.getElementById('lyricContainer');
        this.lyric = null;
        this.lyricStyle = 0;
        this.borswer = navigator.userAgent.toLowerCase();
        this.isIE = true;
        // 判断是否为IE浏览器内核
        if(this.borswer.indexOf("trident") > -1) this.isIE = true;
        else this.isIE = false;
        if(this.isIE) {
            //this.player.innerHTML='不支持IE浏览器！';
            //return;
        }
        var that = this;
        this.noLrctxt = noLrctxt;
        this.loadingLrc = loadingLrc;
        this.loadLrcFail = loadLrcFail;
        this.songId = songId;
        this.songUrl = songUrl;
        this.audio.setAttribute("controlslist", "nodownload");
        this.audio.setAttribute("oncontextmenu", "return false");
        this.audio.setAttribute("autoplay", "autoplay");
        this.audio.onended = function() {
            that.playNext();
        };
        this.audio.onerror = function(e) {
            that.lyricContainer.textContent = '!fail to load the song :(';
        };
        window.addEventListener('keydown',function(e) {
            if (e.keyCode === 32) {
                if (that.audio.paused) {
                    that.audio.play();
                } else {
                    that.audio.pause();
                }
            }
        },false);
        this.play(songName, songLrc);
    },
    play: function(songName, songLrc) {
        var that = this;
        if(this.isIE) this.audio.innerHTML = "<source type='audio/mpeg' src="+songName+">";
        else this.audio.src = songName;
        this.lyricContainer.style.top = '30px';
        this.lyric = null;
        this.lyricContainer.textContent = this.loadingLrc;
        this.lyricStyle = Math.floor(Math.random() * 4);
        this.audio.addEventListener('canplay',function() {
            that.getLyric(songLrc);
        });
        this.audio.addEventListener("timeupdate",function(e) {
            if (!that.lyric) return;
            for (var i = 0, l = that.lyric.length; i < l; i++) {
                if (this.currentTime > that.lyric[i][0] - 0.50) {
                    var line = document.getElementById('line-' + i),
                    prevLine = document.getElementById('line-' + (i > 0 ? i - 1 : i));
                    if(prevLine){
                      prevLine.className = '';
                      line.className = 'current-line-' + that.lyricStyle;
                      that.lyricContainer.style.top = 30 - line.offsetTop + 'px';
                    }
                };
            };
        });
    },
    playNext: function() {
        var wdjaMusic = utils.getParam("wdjaMusic");
        var playlist = document.getElementById('musiclist');
        if(wdjaMusic){
            var jsonstr = JSON.parse(wdjaMusic);
            var musiclist = jsonstr.musiclist;
            if(musiclist.length>0){
                for (var i=0;i<musiclist.length;i++) {
                    var id = musiclist[i].id;
                    var url=this.songUrl;
                    if(id==this.songId){
                        if(i+1==musiclist.length) url=url+musiclist[0].id;
                        else url=url+musiclist[i+1].id;
                        window.location.href=url;
                    }
                    else window.location.href=url+id;
                }
            }
        }
    },
    getLyric: function(url) {
        if(url.substring(url.lastIndexOf('.') + 1)=='lrc'){
            var that = this,
            request = new XMLHttpRequest();
            request.open('GET', url, true);
            request.responseType = 'text';
            request.onload = function() {
                if (request.readyState == 4)
                {
                  if (request.status == 200 || request.status == 304)
                  {
                      that.lyric = that.parseLyric(request.response);
                      that.appendLyric(that.lyric);
                  }
                }
            };
            request.onerror = request.onabort = function(e) {
                that.lyricContainer.textContent = this.loadLrcFail;
            }
            this.lyricContainer.textContent = this.loadingLrc;
            request.send();
        }else{
            this.lyricContainer.textContent = this.noLrctxt;
        }
    },
    parseLyric: function(text) {
        var lines = text.split('\n'),
        pattern = /\[\d{2}:\d{2}.\d{2}\]/g,
        result = [];
        var offset = this.getOffset(text);
        while (!pattern.test(lines[0])) {
            lines = lines.slice(1);
        };
        lines[lines.length - 1].length === 0 && lines.pop();
        lines.forEach(function(v, i, a) {
            var time = v.match(pattern),
            value = v.replace(pattern, '');
            time.forEach(function(v1, i1, a1) {
                var t = v1.slice(1, -1).split(':');
                result.push([parseInt(t[0], 10) * 60 + parseFloat(t[1]) + parseInt(offset) / 1000, value]);
            });
        });
        result.sort(function(a, b) {
            return a[0] - b[0];
        });
        return result;
    },
    appendLyric: function(lyric) {
        var that = this,
        lyricContainer = this.lyricContainer,
        fragment = document.createDocumentFragment();
        this.lyricContainer.innerHTML = '';
        lyric.forEach(function(v, i, a) {
            var line = document.createElement('p');
            line.id = 'line-' + i;
            line.textContent = v[1];
            fragment.appendChild(line);
        });
        lyricContainer.appendChild(fragment);
    },
    getOffset: function(text) {
        var offset = 0;
        try {
            var offsetPattern = /\[offset:\-?\+?\d+\]/g,
            offset_line = text.match(offsetPattern)[0],
            offset_str = offset_line.split(':')[1];
            offset = parseInt(offset_str);
        } catch(err) {
            offset = 0;
        }
        return offset;
    }
};