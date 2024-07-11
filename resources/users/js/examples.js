$(document)
  .ready(function () {
    if (window.innerWidth > 992) {
      // 다바이스 크기가 992px 이상일 때

      // 풀페이지 옵션
      $(document).ready(function () {
        $("#fullpage").fullpage({
          // anchors: ["main", "consulting", "allservice", "subscribe", "founded", "smallbusiness", "institutions", "notice", "footer"],
          anchors: [
            "main",
            "consulting",
            "allservice",
            "pptdesign",
            "institutions",
            "smallbusiness",
            "subscribe",
            "notice",
            "footer",
          ],
          menu: "#header",
          verticalCentered: true, // 세로 중앙 정렬
          scrollOverflow: false,
          sectionsColor: ["#fff", "#f9f9f9", "#f9f9f9"], // 섹션별 컬러
          navigation: true,
          keyboardScrolling: true,
          animateAnchor: true,
          recordHistory: true,
          css3: true,
          navigationPosition: "right",
          loopHorizontal: false, // 반복여부
          controlArrows: false, // 슬라이드 좌우 이동 제어
          onLeave: function (anchorLink, index, direction) {
            var pages = $(".section").length;
            var currentPage = index - 1;
          },

          afterLoad: function (anchorLink, index) {
            if (index != "1") {
              $(".header_i img").fadeIn();
              $(".header_i li a span.i_home_main").fadeIn();
              $("#top_fixed").fadeIn();
              $("#lnb").removeClass("d-none").fadeIn();
            } else {
              $("#lnb").fadeOut();
              $(".header_i li a span.i_home_main").fadeOut();
              $(".header_i img").fadeOut();
              $("#top_fixed").fadeOut();
            }

            if (index == "5") {
              $("#lnb .line_02").show();
              $("#lnb .lnb_menu_02 ul li").addClass("active");
              $(".header_login li").addClass("active");
            } else if (index == "7") {
              $("#lnb .line_02").show();
              $("#lnb .lnb_menu_02 ul li").addClass("active");
              $(".header_login li").addClass("active");
            } else {
              $("#lnb .line_02").hide();
              $("#lnb .lnb_menu_02 ul li").removeClass("active");
              $(".header_login li").removeClass("active");
            }
          },
        });
      });

      // listSwiper
      var listSwiper_pc = new Swiper(".listSwiper_pc", {
        slidesPerView: 9,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        centeredSlidesBounds: false, // t슬라이드 시작과 끝의 중앙배치
        loop: true, // 무한반복
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      // partnerSwiperOne
      var partnerSwiper = new Swiper(".partnerSwiper", {
        slidesPerView: 4,
        spaceBetween: 0, // 슬라이드 여백
        loop: true, // 무한반복
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
        },
      });

      // partnerSwiperOne + Two 연동제어
      // partnerSwiperOne.controller.control = partnerSwiperTwo;
      // partnerSwiperTwo.controller.control = partnerSwiperOne;

      // ppSwiper
      var portfolioSwiper = new Swiper(".portfolioSwiper", {
        slidesPerView: 3,
        spaceBetween: 0, // 슬라이드 여백
        loop: true, // 무한반복
        // touchRatio: 0,//드래그 금지
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      });

      // serviceIcon01
      var serviceIcon01 = new Swiper(".serviceIcon01", {
        slidesPerView: 5,
        spaceBetween: 16, // 슬라이드 여백
        loop: true, // 무한반복
        autoplay: {
          delay: 1000,
          disableOnInteraction: false,
        },
        navigation: false,
      });

      // serviceIcon02
      var serviceIcon02 = new Swiper(".serviceIcon02", {
        slidesPerView: 4,
        spaceBetween: 16, // 슬라이드 여백
        centeredSlides: false, // 슬라이드 중앙정렬
        loop: true, // 무한반복
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        navigation: false,
      });

      // workImg06
      var workImg06 = new Swiper(".workImg06", {
        slidesPerView: 1,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        effect: "fade",
        loop: true, // 무한반복
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
        },
        navigation: false,
      });

      // workImg07
      var workImg07 = new Swiper(".workImg07", {
        slidesPerView: 1,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        effect: "fade",
        loop: true, // 무한반복
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
        },
        navigation: false,
      });

      // workImg10
      var workImg10 = new Swiper(".workImg10", {
        slidesPerView: 1,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        effect: "fade",
        loop: true, // 무한반복
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
        },
        navigation: false,
      });

      // workImg14
      var workImg14 = new Swiper(".workImg14", {
        slidesPerView: 1,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        effect: "fade",
        loop: true, // 무한반복
        autoplay: {
          delay: 4000,
          // disableOnInteraction: true // 쓸어 넘기거나 버튼 클릭 시 자동 슬라이드 정지
        },
        navigation: false,
      });

      // consulting_partnerSubSwiper
      var partnerSubSwiper = new Swiper(".partnerSubSwiper", {
        slidesPerView: 4,
        spaceBetween: 16, // 슬라이드 여백
        centeredSlides: false, // 슬라이드 중앙정렬
        loop: true, // 무한반복
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      // 상세페이지 Swiper
      // 명함
      var product_01_01 = new Swiper(".product_01_01", {
        slidesPerView: 3,
        grid: {
          rows: 3,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        spaceBetween: 20,
      });

      var product_01_02 = new Swiper(".product_01_02", {
        spaceBetween: 10,
        thumbs: {
          swiper: product_01_01,
        },
      });

      // pptDesignSwiper
      var pptDesignSwiper = new Swiper(".pptDesignSwiper", {
        slidesPerView: 3,
        spaceBetween: 0, // 슬라이드 여백
        loop: true, // 무한반복
        // touchRatio: 0,//드래그 금지
        autoplay: {
          delay: 2500,
        },
      });

    } else {
      // 디바이스 크기가 992px 이하일 때

      // listSwiper
      var listSwiper_mo = new Swiper(".listSwiper_mo", {
        slidesPerView: 3,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        // initialSlide: 1, //초기 슬라이드 색인 번호
        loop: true, // 무한반복
        autoplay: {
          delay: 2000,
          disableOnInteraction: false, // 쓸어 넘기거나 버튼 클릭 시 자동 슬라이드 정지
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      // partnerSwiper
      var partnerSwiper = new Swiper(".partnerSwiper", {
        slidesPerView: 3,
        spaceBetween: 5, // 슬라이드 여백
        centeredSlides: true, // 슬라이드 중앙정렬
        loop: true, // 무한반복
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
        },
      });

      // ppSwiper
      var portfolioSwiper = new Swiper(".portfolioSwiper", {
        slidesPerView: 2,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: false, // 슬라이드 중앙정렬
        loop: true, // 무한반복
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      });

      var pptDesignSwiper_mo = new Swiper(".pptDesignSwiper_mo", {
        slidesPerView: 1,
        spaceBetween: 0, // 슬라이드 여백
        centeredSlides: false, // 슬라이드 중앙정렬
        loop: true, // 무한반복        
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      });      

      // consulting_partnerSubSwiper
      var partnerSubSwiper = new Swiper(".partnerSubSwiper", {
        slidesPerView: 3,
        spaceBetween: 8, // 슬라이드 여백
        centeredSlides: false, // 슬라이드 중앙정렬
        loop: true, // 무한반복
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      });

      // 상세페이지 Swiper
      // 명함
      var product_01_01 = new Swiper(".product_01_01", {
        spaceBetween: 10,
        slidesPerView: 3,
        freeMode: true,
        watchSlidesProgress: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
      var product_01_02 = new Swiper(".product_01_02", {
        spaceBetween: 10,
        thumbs: {
          swiper: product_01_01,
        },
      });
    }
  })
  .resize();

$(document).ready(function () {
  $(".sub_menu li").click(function () {
    $(this).toggleClass("active");
  });
});

// sub top fixed
let topFixed = document.getElementById("top_fixed");
window.onscroll = function () {
  if (topFixed) scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    topFixed.style.display = "block";
  } else {
    topFixed.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
