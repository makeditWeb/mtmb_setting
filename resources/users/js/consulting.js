// 단계 전환 함수
function goToStep(currentStep, nextStep) {
    $(currentStep).removeClass('active');
    $(nextStep).addClass('active');

    if(currentStep == '.step_0') {
      $(currentStep).css({'display': 'none'});
    }

    if(currentStep === '.step_01' && nextStep === '.step_0') {
      $(nextStep).css({'display': 'flex'});
    }
}

// $(document).ready(function () {
  let selectedIndex = 0;

  // service_wrap 요소들을 선택
  const serviceWraps = $('.service_wrap');

  // 각 요소에 순차적으로 애니메이션 지연 시간을 적용
  serviceWraps.each(function (index) {
    const $item = $(this).find('img');
    const delay = index * 2; // 각 요소마다 2초 간격으로 지연 시간 설정
    $item.css('animation-delay', `${delay}s`);
  });

//   // partnerSwiperOne
//   var partnerSwiper = new Swiper(".consulting_partnerSwiper", {
//     spaceBetween: 0,
//     freeMode: false,
//     enteredSlides: true,
//     speed: 5000,
//     autoplay: {
//       delay: 1,
//     },
//     loop: true,
//     slidesPerView: 'auto',
//     allowTouchMove: false,
//     disableOnInteraction: true
//   });


//   // 초기 설정: 첫 번째 단계인 .step_0에 .active 클래스를 추가
//   $('.step_0').addClass('active');


//   // .right_wrap span:nth-child(2)를 클릭했을 때 첫 번째 단계에서 두 번째 단계로 이동
//   $('.step_0 .right_wrap span:nth-child(2)').on('click', function() {
//       goToStep('.step_0', '.step_01');
//   });

//   // 각 단계별 .prev 클릭 이벤트
//   $('.step_01 .step_control_container .prev').on('click', function() {
//       goToStep('.step_01', '.step_0');
//   });

//   $('.step_02 .step_control_container .prev').on('click', function() {
//       goToStep('.step_02', '.step_01');
//   });

//   $('.step_03 .step_control_container .prev').on('click', function() {
//       goToStep('.step_03', '.step_02');
//   });

//   $('.step_04 .step_control_container .prev').on('click', function() {
//       goToStep('.step_04', '.step_03');
//   });

//   $('.step_05 .step_control_container .prev').on('click', function() {
//       goToStep('.step_05', '.step_04');
//   });

//   // 각 단계별 .next 클릭 이벤트
//   $('.step_01 .step_control_container .next').on('click', function() {
//       goToStep('.step_01', '.step_02');
//   });

//   $('.step_02 .step_control_container .next').on('click', function() {
//       goToStep('.step_02', '.step_03');
//   });

//   $('.step_03 .step_control_container .next').on('click', function() {
//       goToStep('.step_03', '.step_04');
//   });

//   $('.step_04 .step_control_container .next').on('click', function() {
//       goToStep('.step_04', '.step_05');
//   });


// const urlParams = new URLSearchParams(window.location.search);
//   const consultingIndex = parseInt(urlParams.get('consultingIndex'));

//   if(consultingIndex) {
//       goToStep('.step_0', '.step_01');
//   }
// });

// window.addEventListener("load", function() {
//   var hash = location.hash;
//   if (hash !== "") {
//     var target = document.querySelector(hash);
//     if (target) {
//       var headerHeight = document.querySelector("header").offsetHeight;
//       var targetPosition = target.getBoundingClientRect().top;
//       window.scrollTo({
//         top: targetPosition + window.pageYOffset - headerHeight - 100,
//         behavior: "auto"
//       });
//     }
//   }
// });


// let consulting_index = 0;

// const consulting_list = [];
// const consulting_type_group = [];

// 전체적용
// $('input[name="consulting_type"]').change(function() {
//     $('.survey_container').empty();
    
//     consulting_list.length = 0;  
//     $('input[name="consulting_type"]:checked').each(function() {
//         consulting_list.push({
//           title: $(this).val(),
//           value: ''
//         });
//     });

//     consulting_list.forEach(function(consulting_type) {
//         $('.survey_container').append(
//             `<div class='survey_wrap'>
//                 <span class='title'>${consulting_type.title}</span>
//                 <span class='content'></span>
//             </div>`
//         );
//     });

//     console.log(consulting_list); // For debugging
// });

// $('input[name="consulting_type"]').change(function() {
//     // Clear the previous list
//     consulting_list.length = 0;
//     // Clear the survey container
//     $('.step_01 .survey_container').empty();
//     $('.step_01 .survey_container').append(`
//         <span class='survey_content_title'>문의 내용</span>
//       `)
    
//     // Update the consulting_list with checked values
//     $('input[name="consulting_type"]:checked').each(function() {
//         consulting_list.push({
//           title: $(this).val(),
//           value: ''
//         });
//     });

//     // Append the new survey_wrap elements
//     consulting_list.forEach(function(consulting_type) {
//         $('.step_01 .survey_container').append(
//             `<div class='survey_wrap'>
//                 <span class='title'>${consulting_type.title}</span>
//                 <span class='content'></span>
//             </div>`
//         );
//     });

//     console.log(consulting_list); // For debugging
// });

// function updateSurveyContent() {
//     const consultContent = $('input[name="consulting_type_group"]:checked').val();
//     const planContent = $('input[name="businessPlan_group"]:checked').val();
//     const scheduleContent = $('input[name="workScheduleGroup"]:checked').val();

//     $('.content.consult_content').text(consultContent || '');
//     $('.content.plan_content').html(
//         `${planContent ? `전체페이지: ${planContent}` : ''} ${scheduleContent ? `<br>작업일정: ${scheduleContent}` : ''}`
//     );
// }

// $('input[name="consulting_type_group"], input[name="businessPlan_group"], input[name="workScheduleGroup"]').change(function() {
//     updateSurveyContent();
// });

// // Initial content update on page load
// updateSurveyContent();


// $('.next').on('click', function() {
//   const companyName = $('#company_name').val();
//   const name = $('#name').val();
//   const companyPhone = $('#company_phone').val();
//   const phone = $('#phone').val();
//   const email = $('#email').val();

//   const customerInfo = `
//       ${companyName}<br />
//       ${name}<br />
//       ${companyPhone}<br />
//       ${phone}<br />
//       ${email}<br />
//   `;

//   $('.content.customer_info').html(customerInfo);
// });

// $('.detail_input_wrap textarea').on('input', function() {
//     const moreInfo = $(this).val();
//     $('.content.more_info').text(moreInfo);
// });

// $('.mo .next').on('click', function() {
//   const companyName = $('.mo #company_name').val();
//   const name = $('.mo #name').val();
//   const companyPhone = $('.mo #company_phone').val();
//   const phone = $('.mo #phone').val();
//   const email = $('.mo #email').val();

//   const customerInfo = `
//       ${companyName}<br />
//       ${name}<br />
//       ${companyPhone}<br />
//       ${phone}<br />
//       ${email}<br />
//   `;

//   $('.mo .content.customer_info').html(customerInfo);
// });


// window.addEventListener("load", function() {
//   var hash = location.hash;
//   if (hash !== "") {
//     var target = document.querySelector(hash);
//     if (target) {
//       var headerHeight = document.querySelector("header").offsetHeight;
//       var targetPosition = target.getBoundingClientRect().top;
//       window.scrollTo({
//         top: targetPosition + window.pageYOffset - headerHeight,
//         behavior: "auto"
//       });
//     }
//   }

// });
