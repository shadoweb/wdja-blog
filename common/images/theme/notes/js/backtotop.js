(function() {
  var THRESHOLD = 50;
  var backToTop = document.querySelector('.back-to-top');
  var readingProgressBar = document.querySelector('.reading-progress-bar');
  // For init back to top in sidebar if page was scrolled after page refresh.
  window.addEventListener('scroll', () => {
    if (backToTop || readingProgressBar) {
      var docHeight = document.querySelector('.container').offsetHeight;
      var winHeight = window.innerHeight;
      var contentVisibilityHeight = docHeight > winHeight ? docHeight - winHeight : document.body.scrollHeight - winHeight;
      var scrollPercent = Math.min(100 * window.scrollY / contentVisibilityHeight, 100);
      if (backToTop) {
        backToTop.classList.toggle('back-to-top-on', window.scrollY > THRESHOLD);
        backToTop.querySelector('span').innerText = Math.round(scrollPercent) + '%';
      }
      if (readingProgressBar) {
        readingProgressBar.style.width = scrollPercent.toFixed(2) + '%';
      }
    }
  });

  backToTop && backToTop.addEventListener('click', () => {
    window.anime({
      targets  : document.scrollingElement,
      duration : 500,
      easing   : 'linear',
      scrollTop: 0
    });
  });
})()