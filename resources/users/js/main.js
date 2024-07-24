$(document).ready(function () {
  // fullPage + swiper 설정
  const handleResize = () => {
    const isLargeScreen = window.innerWidth > 992;
    $('#lnb').css('display', isLargeScreen ? 'block' : 'none');

    if (isLargeScreen) {
      //  fulllpage 설정
      $("#fullpage").fullpage({
        anchors: [
            "main",
            "consulting",
            "allService",
            "proposalDocument",
            "introduction",
            "businessReport",
            "educationalMaterials",
            "more",
          ],
        menu: "#header",
        verticalCentered: true, // 세로 중앙 정렬
        scrollOverflow: true,
        sectionsColor: ["#000", "#fff"], // 섹션별 컬러
        navigation: true,
        keyboardScrolling: true,
        animateAnchor: true,
        recordHistory: true,
        css3: true,
        navigationPosition: "right",
        loopHorizontal: false, // 반복여부
        controlArrows: false, // 슬라이드 좌우 이동 제어
        passive: false,
        scrollbars: true,
        // 모바일에서는 fullpage 초기화
        responsiveWidth: 992,
        onLeave: function (anchorLink, index, direction) {
            
        },
        afterLoad: function (anchorLink, index) {
          // handleSectionEntry(index);

          if(index === 1) {
            $("#fp-nav").hide();
            $('#lnb').hide();

            $(".header_i img").fadeOut();
            $("#top_fixed").fadeOut();

            // 첫 번째 색션일 경우 상단 로고 색상 흰 색으로 
            $('.menu_line').css({ 'background': '#fff' });
            $('.logo_text').css({ 'color': '#fff' });

          } else {
            $("#fp-nav").show();
            $('#lnb').show();
            
            $(".header_i img").fadeIn();
            $("#top_fixed").fadeIn();

            // 첫 번째 아닐 경우 상단 로고 색상 흰 색으로 
            $('.menu_line').css({ 'background': '#000' });
            $('.logo_text').css({ 'color': '#000' });
          }

          // 두 번째 색션일 경우, 좌측 상단 메뉴 글 색상 흰색으로
          if (index === 2) {
            $('#lnb .lnb_menu_01 ul li a').css({ 'color': '#fff' });
          } else {
            $('#lnb .lnb_menu_01 ul li a').css({ 'color': '#000' });
          }

          if (index === 4) {
            $('#top-icon-img').attr('src', 'resources/users/img/icon/i_top_button_white.png');
          } else {
            $('#top-icon-img').attr('src', 'resources/users/img/icon/i_top_button.png');
          }

          if(index === 8) {
            $('.footer_pc').css({display: 'block'})

          } else {
            $('.footer_pc').css({display: 'none'})
          }
          
        }
      });

      // // Function to handle section entry
      // function handleSectionEntry(index) {
      //   if (index === 6) {
      //     $('#footer').css('bottom', '78px')
      //   }
      // }

      // // Function to handle initial load with hash
      // function handleInitialLoadWithHash() {
      //   var hash = window.location.hash;
      //   if (hash === '#7') {
      //     $('#footer').css('bottom', '0px')
      //   }
      // }

      // // Check hash on initial load
      // handleInitialLoadWithHash();

    } else {
      const viewportHeight = $(window).height();
      // 모바일일 경우의 스크롤 이벤트
      // 첫 번째 색션을 지났을 경우/안지났을 경우
      $(window).on('scroll', function () {
        const scrollPosition = $(window).scrollTop();
        $('.header').css('background', scrollPosition >= viewportHeight ? '#fff' : 'transparent' )
        $('.menu_line').css('background', scrollPosition >= viewportHeight ? '#000' : '#fff');
        $('.logo_text').css('color', scrollPosition >= viewportHeight ? '#000' : '#fff');
        $('.fp-nav').css('display', scrollPosition >= viewportHeight ? 'block' : 'none')
      });
    }
  };

  handleResize();

  $(".sub_menu li").click(function () {
    $(this).toggleClass("active");
  });

  // 처음에 첫 번째 .ppt_wrap의 .accordion-panel을 열어두기
  $('.ppt_wrap:first .accordion-panel').show();
  $('.ppt_wrap:first .accordion-trigger').addClass('active');
  $('.ppt_wrap:first .accordion-trigger .accordion-trigger-arrow-img').attr('src', 'resources/users/img/main/mobile/arrow_bottom.png');


  // 모바일 footer 노출
  // Intersection Observer 설정
  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0 // 섹션이 조금이라도 보이면 콜백 실행
  };

  const observerCallback = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
          console.log('hi')
        $('.mo.footer').css({position: 'fixed', 'bottom': 0})
      } else {
        $('.mo.footer').css({position: 'relative'})
      }
    });
  };

  const observer = new IntersectionObserver(observerCallback, observerOptions);
  const footerElement = document.querySelectorAll('.mo .portfolio_list');
  observer.observe(footerElement[0]);
});