let alertCallback, confirmCallback_agree, confirmCallback_cancel;
let base_url,
  curr_title,
  curr_page,
  sch_keyword,
  page_scale,
  sort_key,
  sort_direction,
  url_param,
  url_full,
  data_val,
  param_sch_category,
  param_sch_status;
let sch_category = [];
let sch_status = [];
let page_info = [];

const chart_colors = [
  "rgba(255, 99, 132, 0.3)",
  "rgba(255, 159, 64, 0.3)",
  "rgba(255, 205, 86, 0.3)",
  "rgba(75, 192, 192, 0.3)",
  "rgba(54, 162, 235, 0.3)",
  "rgba(153, 102, 255, 0.3)",
  "rgba(201, 203, 207, 0.3)",
  "rgba(230, 126, 34, 0.3)",
  "rgba(0, 128, 0, 0.3)",
  "rgba(255, 215, 0, 0.3)",
  "rgba(0, 255, 255, 0.3)",
  "rgba(255, 192, 203, 0.3)",
  "rgba(255, 255, 0, 0.3)",
  "rgba(0, 0, 128, 0.3)",
  "rgba(0, 128, 128, 0.3)",
  "rgba(192, 192, 192, 0.3)",
  "rgba(128, 0, 0, 0.3)",
  "rgba(128, 128, 0, 0.3)",
  "rgba(0, 0, 255, 0.3)",
  "rgba(128, 0, 128, 0.3)",
  "rgba(255, 0, 0, 0.3)",
  "rgba(75, 192, 86, 0.3)",
  "rgba(235, 162, 54, 0.3)",
  "rgba(128, 255, 0, 0.3)",
  "rgba(0, 255, 128, 0.3)",
  "rgba(255, 0, 255, 0.3)",
  "rgba(0, 75, 192, 0.3)",
  "rgba(192, 75, 86, 0.3)",
  "rgba(34, 56, 78, 0.3)",
  "rgba(255, 128, 64, 0.3)",
];

const daterangepicker_options_single = {
  autoUpdateInput: false,
  autoApply: true,
  showDropdowns: true,
  timePicker: true,
  timePicker24Hour: true,
  timePickerIncrement: 10,
  singleDatePicker: true,
  opens: "center",
  drops: "auto",
  locale: {
    applyLabel: "확인",
    cancelLabel: "취소",
    format: "YYYY-MM-DD HH:mm",
    daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
    monthNames: [
      "1월",
      "2월",
      "3월",
      "4월",
      "5월",
      "6월",
      "7월",
      "8월",
      "9월",
      "10월",
      "11월",
      "12월",
    ],
    drops: "auto",
  },
};

const daterangepicker_options = {
  autoUpdateInput: false,
  autoApply: false,
  showDropdowns: true,
  timePicker: true,
  timePicker24Hour: true,
  timePickerIncrement: 15,
  opens: "center",
  drops: "auto",
  locale: {
    applyLabel: "확인",
    cancelLabel: "취소",
    format: "YYYY-MM-DD HH:mm",
    daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
    monthNames: [
      "1월",
      "2월",
      "3월",
      "4월",
      "5월",
      "6월",
      "7월",
      "8월",
      "9월",
      "10월",
      "11월",
      "12월",
    ],
    drops: "auto",
  },
};

const daterangepicker_options_none_time = {
  autoUpdateInput: false,
  autoApply: true,
  showDropdowns: true,
  timePicker: false,
  opens: "center",
  drops: "auto",
  locale: {
    applyLabel: "확인",
    cancelLabel: "취소",
    format: "YYYY-MM-DD HH:mm",
    daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
    monthNames: [
      "1월",
      "2월",
      "3월",
      "4월",
      "5월",
      "6월",
      "7월",
      "8월",
      "9월",
      "10월",
      "11월",
      "12월",
    ],
    drops: "auto",
  },
};

let $modal_alert = function (title, content, callback) {
  alertCallback = "";
  alertCallback = callback;
  $("#modal-alert-title").html(title);
  $("#modal-alert-content").html(content);
  $("#modal-alert").modal();
  setTimeout(function () {
    $("#modal-alert-agree").focus();
  }, 100);
};

let $modal_confirm = function (title, content, callback_true, callback_false) {
  confirmCallback_agree = "";
  confirmCallback_cancel = "";
  confirmCallback_agree = callback_true;
  confirmCallback_cancel = callback_false;
  $("#modal-confirm-title").html(title);
  $("#modal-confirm-content").html(content);
  $("#modal-confirm").modal();
  setTimeout(function () {
    $("#modal-confirm-cancel").focus();
  }, 100);
};

let $modal_postcode = function () {
  $("#modal-postcode").modal();
};

let $modal_hide = function () {
  $(".modal").modal("hide");
};

$(function () {
  // confirm callback - agree
  $(document).on("click", "#modal-confirm-agree", function () {
    if (confirmCallback_agree != "") confirmCallback_agree();
  });

  // confirm callback - cancel
  $(document).on("click", "#modal-confirm-cancel", function () {
    if (confirmCallback_cancel != "") confirmCallback_cancel();
  });

  // alert callback
  $(document).on("click", "#modal-alert-agree", function () {
    if (alertCallback != "") alertCallback();
  });

  // modal close
  $(document).on("click", ".closeModalBtn", function () {
    $(".modal").modal("hide");
  });

  // logout
  $(document).on("click", "#btn-logout", function () {
    $.post("/admin/login/logoutSubmit", function (data) {
      var result = JSON.parse(data);
      if (result.flag) location.href = "/admin/login/";
    });
  });

  base_url = "base_url" in page_info ? page_info["base_url"] : "";
  curr_title = "curr_title" in page_info ? page_info["curr_title"] : "";
  curr_page = "curr_page" in page_info ? page_info["curr_page"] : "";
  sch_keyword = "sch_keyword" in page_info ? page_info["sch_keyword"] : "";
  page_scale = "page_scale" in page_info ? page_info["page_scale"] : "";
  sort_key = "sort_key" in page_info ? page_info["sort_key"] : "";
  sort_direction =
    "sort_direction" in page_info ? page_info["sort_direction"] : "";
  url_param = "url_param" in page_info ? page_info["url_param"] : "";
  url_full = "url_full" in page_info ? page_info["url_full"] : "";
  sch_category = "sch_category" in page_info ? page_info["sch_category"] : "";
  sch_status = "sch_status" in page_info ? page_info["sch_status"] : "";
  sch_monthly = "sch_monthly" in page_info ? page_info["sch_monthly"] : "";

  $(".sch_status, .sch_category, .sch_subscribe").on("click", function () {
    if ($(this).hasClass("btn-info")) {
      $(this).removeClass("btn-info").addClass("btn-secondary");
    } else {
      $(this).removeClass("btn-secondary").addClass("btn-info");
    }
  });

  $(".sch_monthly").on("click", function () {
    if ($(this).hasClass("btn-info")) {
      $(this).removeClass("btn-info").addClass("btn-secondary");
    } else {
      $(".sch_monthly").removeClass("btn-info").addClass("btn-secondary");
      $(this).removeClass("btn-secondary").addClass("btn-info");
    }
  });

  $("#table_rows").on("change", function () {
    page_scale = $(this).val();
    fnMove();
  });

  $("#sch_keyword").on("keypress", function (e) {
    sch_keyword = $("#sch_keyword").val();
    if (e.keyCode == 13) {
      fnMove();
    }
  });

  $("#schButton").on("click", function (e) {
    sch_keyword = $("#sch_keyword").val();
    sch_category = [];
    sch_status = [];
    $(".sch_category.btn-info").each(function () {
      data_val = $(this).data("val");
      sch_category.push(data_val);
    });
    $(".sch_status.btn-info").each(function () {
      data_val = $(this).data("val");
      sch_status.push(data_val);
    });

    sch_monthly = $(".sch_monthly.btn-info").data("val")
      ? $(".sch_monthly.btn-info").data("val")
      : "";
    fnMove();
  });

  $(".selectSort").on("click", function () {
    select_sortkey = $(this).data("sort_key");
    if (sort_key == select_sortkey) {
      sort_direction = sort_direction == "desc" ? "asc" : "desc";
    } else {
      sort_direction = "desc";
    }
    sort_key = select_sortkey;
    fnMove();
  });

  if ($(".snEditor").length > 0) {
    $(".snEditor").each(function () {
      var snheight = $(this).data("height") ? $(this).data("height") : 600;
      //var snheight = $(this).data('height');
      $(this).summernote({
        height: snheight,
        minHeight: null,
        maxHeight: null,
        focus: false,
        lang: "ko-KR",
        contents: "",
        callbacks: {
          onImageUpload: function (files) {
            for (var i = files.length - 1; i >= 0; i--) {
              uploadFile(files[i], this, uploadPathInfo);
            }
          },
        },
      });
    });
  }

  if ($(".btn-find-address").length > 0) {
    var element_layer = document.getElementById("modal-postcode-content");
    new daum.Postcode({
      oncomplete: function (data) {
        var addr =
          data.userSelectedType === "R" ? data.roadAddress : data.jibunAddress;
        $("#daumpostcode-addr").val(addr);
        $("#daumpostcode-addr-more").focus();
        $modal_hide();
      },
      width: "100%",
      height: "600px",
    }).embed(element_layer);
  }

  $(".btn-find-address").on("click", function () {
    $modal_postcode();
  });

  $(document).on("click", ".pop_view", function () {
    const param_data = $(this).data();
    const popupWidth = window.screen.width;
    const popupHeight = window.screen.height;
    const popupOptions = `
      width=${popupWidth},
      height=${popupHeight},
      left=0,
      top=0,
      resizable=yes,
      scrollbars=yes,
      toolbar=no,
      location=no,
      directories=no,
      status=no,
      menubar=no,
      copyhistory=no
    `;

    const openUrl = param_data.path + param_data.idx;
    window.open(openUrl, "pop_window", popupOptions);
  });

  $(".btn_download_file").on("click", function () {
    file_path = $(this).data("filepath");
    file_name = $(this).data("filename");
    file_path = encodeURIComponent(file_path);
    file_name = encodeURIComponent(file_name);
    window.open("/download/" + file_path + "/" + file_name, "_blank");
  });
});

function fnMove() {
  param_sch_category = sch_category.join();
  param_sch_status = sch_status.join();
  location.href =
    base_url +
    "?page_scale=" +
    page_scale +
    "&sch_keyword=" +
    sch_keyword +
    "&sort_key=" +
    sort_key +
    "&sort_direction=" +
    sort_direction +
    "&sch_category=" +
    param_sch_category +
    "&sch_monthly=" +
    sch_monthly +
    "&sch_status=" +
    param_sch_status;
}

var format_number = function (num) {
  return num.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
};

var get_from_date = function (date_range, odate) {
  const to_date = new Date(odate);
  const result_date = new Date();
  switch (date_range) {
    case 1:
      result_date.setDate(to_date.getDate()); // 당일
      break;
    case 2:
      result_date.setDate(to_date.getDate() - 1); // 어제
      break;
    case 3:
      result_date.setDate(to_date.getDate() - 6); // 지난 7일
      break;
    case 4:
      result_date.setDate(to_date.getDate() - 30); // 지난 30일
      break;
    case 5:
      result_date.setMonth(to_date.getMonth() - 3); // 지난 3개월
      break;
    case 6:
      result_date.setMonth(to_date.getMonth() - 6); // 지난 6개월
      break;
    case 7:
      result_date.setFullYear(to_date.getFullYear() - 1); // 지난 1년
      break;
    default:
      result_date.setDate(to_date.getDate());
      break;
  }

  return (
    new Date(+result_date + 3240 * 10000).toISOString().substring(0, 10) +
    " 00:00"
  );
};

function set_date_range(date_range) {
  var curr_date = new Date();
  var sDate, eDate;

  switch (date_range) {
    case 1:
      sDate = new Date(curr_date);
      sDate.setDate(curr_date.getDate() - curr_date.getDay() + 1);
      eDate = new Date(curr_date);
      eDate.setDate(curr_date.getDate() - curr_date.getDay() + 7);
      break;
    case 2:
      sDate = new Date(curr_date.getFullYear(), curr_date.getMonth(), 1);
      eDate = new Date(curr_date.getFullYear(), curr_date.getMonth() + 1, 0);
      break;
    case 3:
      var lastMonth = new Date(
        curr_date.getFullYear(),
        curr_date.getMonth() - 1,
        1
      );
      sDate = new Date(lastMonth.getFullYear(), lastMonth.getMonth(), 1);
      eDate = new Date(lastMonth.getFullYear(), lastMonth.getMonth() + 1, 0);
      break;
    case 4:
      sDate = new Date(curr_date.getFullYear(), curr_date.getMonth() - 2, 1);
      eDate = new Date(curr_date.getFullYear(), curr_date.getMonth() + 1, 0);
      break;
    case 5:
      sDate = new Date(curr_date.getFullYear(), curr_date.getMonth() - 5, 1);
      eDate = new Date(curr_date.getFullYear(), curr_date.getMonth() + 1, 0);
      break;
    case 6:
      sDate = new Date(curr_date.getFullYear(), 0, 1);
      eDate = curr_date;
      break;
    case 7:
      sDate = new Date(curr_date.getFullYear() - 1, 0, 1);
      eDate = curr_date;
      break;
    default:
      sDate = null;
      eDate = null;
  }

  return {
    sDate:
      new Date(+sDate + 3240 * 10000).toISOString().substring(0, 10) + " 00:00",
    eDate:
      new Date(+eDate + 3240 * 10000).toISOString().substring(0, 10) + " 23:59",
  };
}

// email validate
function verifyEmail(emailValue) {
  var regExp =
    /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  return emailValue.match(regExp) != null ? true : false;
}

// hp validate
function verifyTelnum(numValue) {
  var regExp = /^\d{2,4}[.-]?\d{3,4}[.-]?\d{4}$/;
  return numValue.match(regExp) != null ? true : false;
}

// json validate
function isjson(str) {
  return typeof JSON.parse(str) === "object" ? true : false;
}

// isnull validate
function isNull(str) {
  return str == null || str == "null" ? true : false;
}

var formValidate = function (obj = "body") {
  var valid_Count = 0;
  $(obj)
    .find(".form-valid")
    .each(function () {
      var valid_msg = [
        "필수 입력 입니다.",
        "숫자만 입력 가능합니다.",
        "이메일 주소만 가능합니다.",
        "연락처만 입력 가능합니다.",
      ]; // [비어있을때, 숫자가아닐때, 이메일형식]
      var valid_thisFlag = false;
      var popover_Content;
      var _this = $(this);
      _this.popover("dispose");

      if (_this.val().length == 0 && _this.hasClass("fv_empty")) {
        valid_Count++;
        popover_Content = valid_msg[0];
      } else if (
        _this.val().length > 0 &&
        _this.hasClass("fv_numeric") &&
        !$.isNumeric(_this.val())
      ) {
        valid_Count++;
        popover_Content = valid_msg[1];
      } else if (
        _this.val().length > 0 &&
        _this.hasClass("fv_email") &&
        !verifyEmail(_this.val())
      ) {
        valid_Count++;
        popover_Content = valid_msg[2];
      } else if (
        _this.val().length > 0 &&
        _this.hasClass("fv_telnum") &&
        !verifyTelnum(_this.val())
      ) {
        valid_Count++;
        popover_Content = valid_msg[3];
      } else {
        valid_thisFlag = true;
        _this.removeClass("is-invalid").addClass("is-valid").popover("dispose");
      }

      if (!valid_thisFlag) {
        $(_this)
          .popover({
            title: _this.attr("title"),
            content: popover_Content,
            placement: "top",
          })
          .addClass("is-invalid")
          .popover("show");
        setTimeout(function () {
          _this.popover("hide");
        }, 4000);
      }
    });

  return valid_Count > 0 ? false : true;
};

function uploadFile(file, el, pathInfo) {
  var form_data = new FormData();
  form_data.append("sn_editor", file);
  form_data.append("upload_path", pathInfo.upPath);
  $.ajax({
    data: form_data,
    type: "POST",
    url: pathInfo.method,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (data) {
      var result = JSON.parse(data);
      if (result.flag) {
        $(el).summernote("editor.insertImage", result.file_virtual_path);
      } else {
        $modal_alert("Error", "관리자에게 문의해 주십시오.", function () {
          //alert(result.message);
          $modal_hide();
        });
      }
    },
    error: function (xhr, ajaxSettings, thrownError) {
      $modal_alert("Error", "관리자에게 문의해 주십시오.", function () {
        $modal_hide();
      });
    },
  });
}

function enableLoading(targetObj) {
  $(targetObj).html($("#obj-loading").html());
}

function disableLoading(targetObj) {
  $(targetObj).html("");
}

function replaceCustomerType(customertype) {
  if (customertype == "0") {
    return "법인 고객";
  } else if (customertype == "1") {
    return "개인 고객";
  } else if (customertype == "2") {
    return "관공서";
  } else {
    return "-";
  }
}
