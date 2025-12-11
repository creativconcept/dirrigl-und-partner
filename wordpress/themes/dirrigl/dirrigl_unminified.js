(function ($) {
  /********** MOBILE MENU **********/
  const menuToggle = $('#menu-toggle');
  const mobileMenu = $('#mobile-menu');
  $(menuToggle).click(function() {
      if (mobileMenu.height() == 0) {
          TweenMax.to(mobileMenu, .2, {height: 'auto', opacity:1});
      }
      else {
          TweenMax.to(mobileMenu, .2, {height: 0, opacity: 0});
      }
  });
/**********TOPBAR SCROLL **********/
	var doc = document.documentElement;
	var w = window;
	var prevScroll = w.scrollY || doc.scrollTop;
	var curScroll;
	var direction = 0;
  var prevDirection = 0;
  var header = document.getElementById('top-header');

	var checkScroll = function () {
		curScroll = w.scrollY || doc.scrollTop;
		if (curScroll > prevScroll) {
			direction = 2;
		}
		else if (curScroll < prevScroll) {
			direction = 1;
		}
		if (direction !== prevDirection) {
			toggleHeader(direction, curScroll);
		}
		prevScroll = curScroll;
	};
	var toggleHeader = function (direction, curScroll) {
		if (direction === 2 && curScroll > 85) {
			header.classList.add('opacity-0');
			prevDirection = direction;
		}
		else if (direction === 1) {
			header.classList.remove('opacity-0');
			prevDirection = direction;
		}
	};
	window.addEventListener('scroll', checkScroll);
  /********** MEGA MENU **********/
  /* Branchen Elements */
  const branchen = $('#branchen');
  const branchenMenu = $('#branchen-menu');
  const branchenArrow = $('#branchen-arrow');
  let hoverBranchen = false;
  /* Leistungen Elements */
  const leistungen = $('#leistungen');
  const leistungenMenu = $('#leistungen-menu');
  const leistungenArrow = $('#leistungen-arrow');
  let hoverLeistungen = false;
  /* International Elements */
  const international = $('#international');
  const internationalMenu = $('#international-menu');
  const internationalArrow = $('#international-arrow');
  let hoverInternational = false;
  /* Über uns Elements */
  const ueberuns = $('#ueber-uns');
  const ueberunsMenu = $('#ueber-uns-menu');
  const ueberunsArrow = $('#ueber-uns-arrow');
  let hoverUeberuns = false;
  /* Array Elements */
  const naviElements = [
    [branchen,branchenMenu,branchenArrow,hoverBranchen],
    [leistungen,leistungenMenu,leistungenArrow,hoverLeistungen],
    [international,internationalMenu,internationalArrow,hoverInternational],
    [ueberuns,ueberunsMenu,ueberunsArrow,hoverUeberuns],
  ];
  /* Array positions */
  let otherOne;
  let otherTwo;
  let otherThree;
  /* Show Mega menu */
  for (let i=0; i<naviElements.length; i++) {
    /* Mouse enter */
    $(naviElements[i][0]).mouseenter(function() {
      naviElements[i][3] = true;
      switch(i) {
        case 0: otherOne = 1; otherTwo = 2; otherThree = 3; break;
        case 1: otherOne = 0; otherTwo = 2; otherThree = 3; break;
        case 2: otherOne = 0; otherTwo = 1; otherThree = 3; break;
        case 3: otherOne = 0; otherTwo = 1; otherThree = 2; break;
        default: otherOne = 0; otherTwo = 0; otherThree = 0;
      }
      naviElements[otherOne][3] = false;
      naviElements[otherTwo][3] = false;
      naviElements[otherThree][3] = false;
    });
    /* Mouse move */
    $('#top').mousemove(function() {
      if( naviElements[i][3] ) {
        TweenMax.to(naviElements[i][1], .2, {height: 'auto', opacity: 1});
      }
      else {
        TweenMax.to(naviElements[i][1], .2, {height: '0', opacity: 0});
      }
    });
    /* Mouse leave */
    $('#top').mouseleave(function() {
      if( naviElements[i][3] ) {
        TweenMax.to(naviElements[i][1], .2, {height: '0', opacity: 0});
        naviElements[i][3] = false;
      }
    });
    /* Close on Menu items */
    $('#startseite').hover(function() {
      naviElements[i][3] = false;
    });
    $('#kontakt').hover(function() {
      naviElements[i][3] = false;
    });
  }
}(jQuery));
