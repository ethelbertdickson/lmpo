function isTouchEnabled() {
  return (("ontouchstart" in window)
    || (navigator.MaxTouchPoints > 0)
    || (navigator.msMaxTouchPoints > 0));
}
jQuery(function () {
  jQuery("path[id^=ngjs]").each(function (i, e) {
    ngaddEvent( jQuery(e).attr("id"));
  });
});
function ngaddEvent(id,relationId) {
  var _obj = jQuery("#" + id);
  var arr = id.split("");
  var _Textobj = jQuery("#" + id + "," + "#ngjsvn" + arr.slice(4).join(""));
  jQuery("#" + ["visnames"]).attr({"fill":ngjsconfig.general.visibleNames});
  _obj.attr({"fill":ngjsconfig[id].upColor, "stroke":ngjsconfig.general.borderColor});
  _Textobj.attr({"cursor": "default"});
  if (ngjsconfig[id].active === true) {
    _Textobj.attr({"cursor": "pointer"});
    _Textobj.hover(function () {
      jQuery("#ngjstip").show().html(ngjsconfig[id].hover);
      _obj.css({"fill":ngjsconfig[id].overColor});
    }, function () {
      jQuery("#ngjstip").hide();
      jQuery("#" + id).css({"fill":ngjsconfig[id].upColor});
    });
    if (ngjsconfig[id].target !== "none") {
      _Textobj.mousedown(function () {
        jQuery("#" + id).css({"fill":ngjsconfig[id].downColor});
      });
    }
    _Textobj.mouseup(function () {
      jQuery("#" + id).css({"fill":ngjsconfig[id].overColor});
      if (ngjsconfig[id].target === "new_window") {
        window.open(ngjsconfig[id].url);	
      } else if (ngjsconfig[id].target === "same_window") {
        window.parent.location.href = ngjsconfig[id].url;
      } else if (ngjsconfig[id].target === "modal") {
        jQuery(ngjsconfig[id].url).modal("show");
      }
    });
    _Textobj.mousemove(function (e) {
      var x = e.pageX + 10, y = e.pageY + 15;
      var tipw =jQuery("#ngjstip").outerWidth(), tiph =jQuery("#ngjstip").outerHeight(),
      x = (x + tipw >jQuery(document).scrollLeft() +jQuery(window).width())? x - tipw - (20 * 2) : x ;
      y = (y + tiph >jQuery(document).scrollTop() +jQuery(window).height())? jQuery(document).scrollTop() +jQuery(window).height() - tiph - 10 : y ;
      jQuery("#ngjstip").css({left: x, top: y});
    });
    if (isTouchEnabled()) {
      _Textobj.on("touchstart", function (e) {
        var touch = e.originalEvent.touches[0];
        var x = touch.pageX + 10, y = touch.pageY + 15;
        var tipw =jQuery("#ngjstip").outerWidth(), tiph =jQuery("#ngjstip").outerHeight(),
        x = (x + tipw >jQuery(document).scrollLeft() +jQuery(window).width())? x - tipw -(20 * 2) : x ;
        y =(y + tiph >jQuery(document).scrollTop() +jQuery(window).height())? jQuery(document).scrollTop() +jQuery(window).height() -tiph - 10 : y ;
        jQuery("#" + id).css({"fill":ngjsconfig[id].downColor});
        jQuery("#ngjstip").show().html(ngjsconfig[id].hover);
        jQuery("#ngjstip").css({left: x, top: y});
      });
      _Textobj.on("touchend", function () {
        jQuery("#" + id).css({"fill":ngjsconfig[id].upColor});
        if (ngjsconfig[id].target === "new_window") {
          window.open(ngjsconfig[id].url);
        } else if (ngjsconfig[id].target === "same_window") {
          window.parent.location.href = ngjsconfig[id].url;
        } else if (ngjsconfig[id].target === "modal") {
          jQuery(ngjsconfig[id].url).modal("show");
        }
      });
    }
	}
}