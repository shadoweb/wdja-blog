FullCalendar.globalLocales.push(function () {
  'use strict';

  var zhCn = {
    code: 'zh-cn',
    week: {
      // GB/T 7408-1994《数据元和交换格式·信息交换·日期和时间表示法》与ISO 8601:1988等效
      dow: 1, // Monday is the first day of the week.
      doy: 4, // The week that contains Jan 4th is the first week of the year.
    },
    buttonText: {
      prev: '前翻',
      next: '后翻',
      today: '今天',
      month: '月历',
      week: '周历',
      day: '日历',
      list: '清单',
    },
    weekText: '周',
    allDayText: '全天',
    moreLinkText: function(n) {
      return '另外 ' + n + ' 个'
    },
    noEventsText: '没有事件显示',
  };

  return zhCn;

}());
