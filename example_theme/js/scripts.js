jQuery.noConflict();
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
let currentPage = 1;
let currentSearchPage = 1;
let allPages = 0;
let allSearchPages = 0;
let currentCategory = 0;
let searchVal = "";

(function ($) {
  $(function () {
    $(document).ready(function () {
      $(".tabs .tab_titles li").click(function () {
        $(".tabs .tab_titles li").removeClass("active");
        $(this).addClass("active");
        $(this)
          .closest(".tabs")
          .find(".tabs_content")
          .find(".tab_item")
          .removeClass("active");
        $(this)
          .closest(".tabs")
          .find(".tabs_content")
          .find(".tab_item")
          .eq($(this).index())
          .addClass("active");
      });
      $(".tabs .select-items div").click(function () {
        $(".tabs .tab_titles li").eq($(this).index()).click();
      });
      $(".running_wrapper .select-items div").click(function () {
        $(".running_wrapper .categories a").eq($(this).index()).click();
      });
      $('#mobile_menu li.menu-item-has-children').each(function(){
        $(this).append('<a href="#" class="menu_opener"><span></span></a>');
      });
      $('#mobile_menu li.menu-item-has-children > a.menu_opener').on('click', function(){
        if($(this).closest('li').hasClass('active'))
          $(this).closest('li').removeClass('active');  
        else
          $(this).closest('li').addClass('active');
        return false;
      });
      $(".hidden_text_btn").click(function () {
        $(this)
          .hide()
          .closest(".content_wrapper")
          .find(".text_wrapper")
          .find(".hidden_text")
          .addClass("active");
        return false;
      });
      $(".accordion .item .title").click(function () {
        if ($(this).closest(".item").hasClass("active"))
          $(this).closest(".item").removeClass("active");
        else {
          $(this).closest(".accordion").find(".item").removeClass("active");
          $(this).closest(".item").addClass("active");
          $(this)
            .closest(".block-image_accordion")
            .find(".image_wrapper")
            .find("img")
            .removeClass("active");
          $(this)
            .closest(".block-image_accordion")
            .find(".image_wrapper")
            .find("img.img-index-" + $(this).closest(".item").data("index"))
            .addClass("active");
        }
      });
      $(".burger").click(function () {
        if ($(this).closest("#header").hasClass("opened"))
          $(this).closest("#header").removeClass("opened");
        else {
          $(this).closest("#header").addClass("opened");
          $("header").removeClass("active").removeClass("search_opened");
          $(".search_popup").removeClass("active");
        }
        return false;
      });

      $(".form_wrapper .form-group input").each(function () {
        // $(this).val('');
        $(this).focus(function () {
          $(this).closest("label").addClass("focused");
        });
        $(this).blur(function () {
          if ($(this).val() == "")
            $(this).closest("label").removeClass("focused");
        });
      });

      $(".form_wrapper .form-group textarea").each(function () {
        $(this).val("");
        $(this).focus(function () {
          $(this).closest("label").addClass("focused");
        });
        $(this).blur(function () {
          if ($(this).val() == "")
            $(this).closest("label").removeClass("focused");
        });
      });
      $(".resume_form .labels label").on("DOMSubtreeModified", function () {
        let id = $(this).find("input").attr("id");
        if (
          $(this).find(".wpcf7-not-valid-tip").length &&
          $(this).find("input").val() != ""
        ) {
          if (
            $("#for-" + id + ".file_val").find(".wpcf7-not-valid-tip").length
          ) {
            $("#for-" + id + ".file_val")
              .find(".wpcf7-not-valid-tip")
              .remove();
          }
          $("#for-" + id + ".file_val").append(
            '<span class="wpcf7-not-valid-tip">' +
              $(this).find(".wpcf7-not-valid-tip").html() +
              "</span>"
          );
        } else {
          $("#for-" + id + ".file_val").remove(".wpcf7-not-valid-tip");
        }
      });
      $('.resume_form input[type="file"]').val("");

      $('.resume_form input[type="file"]').change(function () {
        if ($(this).val() != "") {
          let file = $(this)[0].files[0];
          let id = $(this).attr("id");
          $(this)
            .closest("label")
            .removeClass("active")
            .addClass("not-empty")
            .next("label")
            .addClass("active");
          $("#for-" + id + ".file_val").prepend(
            '<span class="file_value">' +
              file.name +
              '<a href="#" data-label="' +
              $(this).attr("id") +
              '"></a></span>'
          );
        }
      });

      $("body").on("click", ".file_value a", function () {
        $(".labels label").removeClass("active");
        $("#" + $(this).data("label"))
          .val("")
          .closest("label")
          .removeClass("not-empty")
          .addClass("empty");
        $(".labels label.empty").first().addClass("active");
        $(this).closest(".file_val").html("");
        return false;
      });

      $(".search_marker").click(function () {
        if ($(".search_popup").hasClass("active")) {
          $(".search_popup").removeClass("active");
          $("header").removeClass("active").removeClass("search_opened");
          $(".search_popup_wrap h2.def").addClass("active");
          $(".search_popup_wrap h2.search_res").removeClass("active");
          $(".search_popup_wrap h2.search_none").removeClass("active");
          $(".search-field").val("");
          searchVal = "";
        } else {
          $(".search_popup").addClass("active");
          $("header")
            .addClass("active")
            .removeClass("opened")
            .addClass("search_opened");
          $(window).scrollTop(0);
        }
        return false;
      });
      $(".search_close").click(function () {
        $(".search_popup").removeClass("active");
        $("header").removeClass("active").removeClass("search_opened");
        $(".search_popup_wrap h2.def").addClass("active");
        $(".search_popup_wrap h2.search_res").removeClass("active");
        $(".search_popup_wrap h2.search_none").removeClass("active");
        $(".search-field").val("");
        searchVal = "";
        return false;
      });
      $(".form_scroller .scroller_wrap").css(
        "height",
        $(".form_scroller .scroller_wrap .item").eq(0).height() + "px"
      );
      let formScrollerPage = 1;
      $(".form_scroller .pager a").click(function () {
        var page = $(this).data("page");
        formScrollerPage = page;
        var w = $(".form_scroller").width();
        $(".form_scroller .scroller_wrap").css(
          "transform",
          "translateX(-" + w * (page - 1) + "px)"
        );
        $(".form_scroller .scroller_wrap").css(
          "height",
          $(".form_scroller .scroller_wrap .item")
            .eq(page - 1)
            .height() + "px"
        );
        return false;
      });
      $(".form_scroller .btn_wrap .btn_next").click(function () {
        var page = $(this).data("page");
        formScrollerPage = page;
        var w = $(".form_scroller").width();
        $(".form_scroller .scroller_wrap").css(
          "transform",
          "translateX(-" + w * (page - 1) + "px)"
        );
        $(".form_scroller .scroller_wrap").css(
          "height",
          $(".form_scroller .scroller_wrap .item")
            .eq(page - 1)
            .height() + "px"
        );
        return false;
      });
      $(".form_scroller .btn_wrap .btn_prev").click(function () {
        var page = $(this).data("page");
        formScrollerPage = page;
        var w = $(".form_scroller").width();
        $(".form_scroller .scroller_wrap").css(
          "transform",
          "translateX(-" + w * (page - 1) + "px)"
        );
        $(".form_scroller .scroller_wrap").css(
          "height",
          $(".form_scroller .scroller_wrap .item")
            .eq(page - 1)
            .height() + "px"
        );
        return false;
      });

      $(".form_scroller .scroller_wrap").on("DOMSubtreeModified", function () {
        $(".form_scroller .scroller_wrap").css(
          "height",
          $(".form_scroller .scroller_wrap .item")
            .eq(formScrollerPage - 1)
            .height() + "px"
        );
      });

      $(window).scroll(function (event) {
        var st = $(this).scrollTop();
        $(".running_header .running_text .ticker").css(
          "transform",
          "translateX(-" + (500 + st * 3) + "px)"
        );
        if ($(".flexible_block").length) {
          checkNavFlexblock();
        }

        didScroll = true;
      });

      setInterval(function () {
        if (didScroll) {
          hasScrolled();
          didScroll = false;
        }
      }, 250);

      var st = $(this).scrollTop();
      if(st > 20)
        $("header").addClass('light');
      else
        $("header").removeClass('light');

      checkPages();
      checkSearchPages();

      $(".gallery-button-prev,.gallery-button-next").click(function () {
        $(this).addClass("hovered");
        setTimeout(function () {
          $(".gallery-button-prev,.gallery-button-next").removeClass("hovered");
        }, 200);
      });

      $(".blog").on("click", ".nav-links a", function () {
        if ($(this).hasClass("prev")) {
          if (!$(this).hasClass("inactive")) {
            currentPage--;
            get_posts(currentPage, currentCategory);
          }
        } else if ($(this).hasClass("next")) {
          if (!$(this).hasClass("inactive")) {
            currentPage++;
            get_posts(currentPage, currentCategory);
          }
        } else {
          currentPage = $(this).data("page");
          get_posts($(this).data("page"), currentCategory);
        }
        return false;
      });

      $("#search_nav").on("click", ".nav-links a", function () {
        if ($(this).hasClass("prev")) {
          if (!$(this).hasClass("inactive")) {
            currentSearchPage--;
            get_search_posts(currentSearchPage, searchVal);
          }
        } else if ($(this).hasClass("next")) {
          if (!$(this).hasClass("inactive")) {
            currentSearchPage++;
            get_search_posts(currentSearchPage, searchVal);
          }
        } else {
          currentSearchPage = $(this).data("page");
          get_search_posts($(this).data("page"), searchVal);
        }
        return false;
      });

      $(".blog .categories a").click(function () {
        currentPage = 1;
        currentCategory = $(this).data("cat");
        get_posts(currentPage, $(this).data("cat"));
        get_navigation(currentCategory);
        $(".blog .categories a").removeClass("active");
        $(this).addClass("active");
        return false;
      });
      if ($("body").hasClass("single-post")) addNavToFlexblock();

      $(".wpcf7-submit").on("click", function (e) {
        if ($(this).hasClass("disabled")) {
          e.preventDefault();
          return false;
        }
        $(this).addClass("disabled");
        setTimeout(function () {
          $(".wpcf7-submit").removeClass("disabled");
        }, 2000);

        $(".resume_form .file_val .file_value").remove();
      });

      $(".search-submit").click(function () {
        searchVal = $(".search-field").val();
        get_search_posts(1, searchVal);
        get_search_navigation(searchVal);
        return false;
      });

      $(".form_scroller .wpcf7-submit").click(function () {
        var w = $(".form_scroller").width();
        if (
          $(".form_scroller .item").eq(0).find("input[type=checkbox]:checked")
            .length > 0
        ) {
          $(".form_scroller .item").eq(0).find(".chb_error").hide();
        } else {
          $(".form_scroller .item").eq(0).find(".chb_error").show();
          $(".form_scroller .scroller_wrap").css(
            "transform",
            "translateX(0px)"
          );
          $(".form_scroller .scroller_wrap").css(
            "height",
            $(".form_scroller .scroller_wrap .item").eq(0).height() + "px"
          );
          return false;
        }
        if (
          $(".form_scroller .item").eq(1).find("input[type=checkbox]:checked")
            .length > 0
        ) {
          $(".form_scroller .item").eq(1).find(".chb_error").hide();
        } else {
          $(".form_scroller .item").eq(1).find(".chb_error").show();
          $(".form_scroller .scroller_wrap").css(
            "transform",
            "translateX(-" + w + "px)"
          );
          $(".form_scroller .scroller_wrap").css(
            "height",
            $(".form_scroller .scroller_wrap .item").eq(1).height() + "px"
          );
          return false;
        }
      });
      var space = 141;
      if ($(window).width() < 768) space = 24;

      var slider = new Swiper(".gallery-slider", {
        slidesPerView: 1,
        loop: true,
        spaceBetween: space,
        navigation: {
          nextEl: ".gallery-button-next",
          prevEl: ".gallery-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    });
    function hasScrolled() {
      var navbarHeight = $("header").outerHeight();
      var st = $(this).scrollTop();

      if (st > navbarHeight) {
        $(".kama_breadcrumbs").hide();
      } else {
        $(".kama_breadcrumbs").show();
      }

      // Make sure they scroll more than delta
      if (Math.abs(lastScrollTop - st) <= delta) return;

      // If they scrolled down and are past the navbar, add class .nav-up.
      // This is necessary so you never see what is "behind" the navbar.
      if (st > lastScrollTop && st > navbarHeight) {
        // Scroll Down
        $("header").removeClass("nav-down").addClass("nav-up");
      } else {
        // Scroll Up
        if (st + $(window).height() < $(document).height()) {
          $("header").removeClass("nav-up").addClass("nav-down");
        }
      }
      if(st > 20)
        $("header").addClass('light');
      else
        $("header").removeClass('light');
      lastScrollTop = st;
    }
    function checkPages() {
      allPages = $(".blog .nav-links a").length - 2;
      currentCategory = $(".blog .categories a.active").data("cat");
      if (currentPage == 1) {
        $(".blog .nav-links a.prev").addClass("inactive");
      } else {
        $(".blog .nav-links a.prev").removeClass("inactive");
      }
      if (currentPage >= allPages) {
        $(".blog .nav-links a.next").addClass("inactive");
      } else {
        $(".blog .nav-links a.next").removeClass("inactive");
      }
    }
    function get_posts(page, category) {
      $(".posts_wrapper").addClass("inactive");
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "html",
        data: {
          action: "change_nav",
          paged: page,
          cat: category,
        },
        success: function (res) {
          $(".posts_wrapper").html(res);
          $(".posts_wrapper").removeClass("inactive");
          $(window).scrollTop(200);
          $(".blog .nav-links a").removeClass("current");
          $(".blog .nav-links a.page-number-" + currentPage).addClass(
            "current"
          );
          checkPages();
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
    function checkSearchPages() {
      allSearchPages = $("#search_nav .nav-links a").length - 2;
      if (currentSearchPage == 1) {
        $("#search_nav .nav-links a.prev").addClass("inactive");
      } else {
        $("#search_nav .nav-links a.prev").removeClass("inactive");
      }
      if (currentSearchPage >= allSearchPages) {
        $("#search_nav .nav-links a.next").addClass("inactive");
      } else {
        $("#search_nav .nav-links a.next").removeClass("inactive");
      }
    }
    function get_search_posts(page, s) {
      console.log("aaa");
      console.log(s);
      $(".posts_wrapper").addClass("inactive");
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "html",
        data: {
          action: "change_search_nav",
          paged: page,
          s: s,
        },
        success: function (res) {
          if (res != "0") {
            $(".search_wrap").html(res);
            $(".search_wrap").removeClass("inactive");
            $(".search_wrapper").addClass("active");
            $(window).scrollTop(200);
            $("#search_nav .nav-links a").removeClass("current");
            $(
              "#search_nav .nav-links a.page-number-" + currentSearchPage
            ).addClass("current");
            $(".search_popup_wrap h2.def").removeClass("active");
            $(".search_popup_wrap h2.search_none").removeClass("active");
            $(".search_popup_wrap h2.search_res").addClass("active");
            $(".search_popup_wrap h2.search_res span.s_query").text(searchVal);
            checkSearchPages();
          } else {
            $(".search_wrap").removeClass("inactive");
            $(".search_wrapper").removeClass("active");
            $(".search_wrap").html("");
            $(".search_popup_wrap h2.def").removeClass("active");
            $(".search_popup_wrap h2.search_res").removeClass("active");
            $(".search_popup_wrap h2.search_none").addClass("active");
            $(".search_popup_wrap .search_none span.s_query").text(searchVal);
            console.log("bbb");
            console.log(searchVal);
          }
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
    function get_navigation(category) {
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "html",
        data: {
          action: "load_nav",
          cat: category,
        },
        success: function (res) {
          $("#posts_nav").html(res);
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
    function get_search_navigation(s) {
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "html",
        data: {
          action: "load_search_nav",
          s: s,
        },
        success: function (res) {
          $("#search_nav").html(res);
          $(".search_popup_wrap h2.search_res span.s_count").html(
            $("#search_nav nav").data("count")
          );
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
    function addNavToFlexblock() {
      var cnt = $(".flexible_block > div.text_wrap").length;
      var str = '<div class="f_nav">';
      for (i = 0; i < cnt; i++) {
        if (i == 0) str += '<span class="el active"></span>';
        else str += '<span class="el"></span>';
      }
      str += "</div>";
      $(".flexible_block").append(str);
      checkNavFlexblock();
    }
    function checkNavFlexblock() {
      let st = $(window).scrollTop();
      if (st - $(window).height() / 2 > 50) {
        if (
          st - $(window).height() / 2 <
          $(".flexible_block").offset().top +
            $(".flexible_block").height() -
            $(window).height() -
            50
        )
          $(".f_nav").css("top", st - $(window).height() / 2 + "px");
      } else {
        $(".f_nav").css("top", "50px");
      }
      $(".flexible_block > div.text_wrap").each(function () {
        if (st >= $(this).offset().top) {
          $(".f_nav span").removeClass("active");
          $(".f_nav span").eq($(this).index()).addClass("active");
        }
      });
    }
  });
})(jQuery);
let loop = true;
if (jQuery(".slider .swiper-slide").length < 3) loop = false;
var slider = new Swiper(".slider", {
  slidesPerView: 2.1,
  loop: loop,
  spaceBetween: 32,
  navigation: {
    nextEl: ".slider-button-next",
    prevEl: ".slider-button-prev",
  },
  breakpoints: {
    320: {
      slidesPerView: 1.2,
    },
    767: {
      slidesPerView: 1.2,
    },
    1024: {
      slidesPerView: 2.1,
    },
  },
});
var slider = new Swiper(".slider-3", {
  slidesPerView: 3,
  loop: true,
  spaceBetween: 32,
  navigation: {
    nextEl: ".slider-button-next",
    prevEl: ".slider-button-prev",
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
    },
    767: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});
document.addEventListener('wpcf7mailsent',function(event){
  //console.log(event.detail)
  thank_lnk='/danke';
    if(event.detail.contactFormId=="295"||event.detail.contactFormId=="283"||event.detail.contactFormId=="261"){
      location = thank_lnk;
    }
},false);