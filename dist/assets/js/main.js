"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var o=0;o<t.length;o++){var s=t[o];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(e,s.key,s)}}function _createClass(e,t,o){return t&&_defineProperties(e.prototype,t),o&&_defineProperties(e,o),e}window.addEventListener("DOMContentLoaded",function(){var s=$("body, html"),e=$("header"),t=$(window),o=$("#btn-legales"),a=$(".Legales"),n=$(".Copy-legal");o.on("click",function(e){e.preventDefault(),a.addClass("show"),n.css({paddingBottom:"0px"});var t=$(this).attr("id"),o=$("#".concat(t)).offset().top;s.animate({scrollTop:o},400,"swing")});var r=$("#fixed-cta"),i=$("#fixed-form"),d=i.outerHeight(),l=window.matchMedia("(max-width: 767.98px)");l.addListener(h);var c=function(){250<t.scrollTop()?r.addClass("show"):r.removeClass("show")},f=function(){500<t.scrollTop()?i.addClass("show"):i.removeClass("show")};function h(){l.matches?(r.removeClass("show"),window.removeEventListener("scroll",c),window.addEventListener("scroll",f),a.hasClass("show")?n.css({paddingBottom:"0px"}):(n.css({paddingBottom:"".concat(d,"px")}),a.css({paddingBottom:"".concat(d,"px")}))):(window.addEventListener("scroll",c),i.removeClass("show"),window.removeEventListener("scroll",f),n.css({paddingBottom:"0px"}))}h();var u=function(){function a(e,t,o,s){_classCallCheck(this,a),this._headerHeight=e,this._body=t,this._duration=o,this._ease=s,this._to}return _createClass(a,[{key:"to",get:function(){return this._to},set:function(e){this._to=e}}]),a}();u.prototype.scroll=function(){var e=$(this._to).offset().top-this._headerHeight;this._body.animate({scrollTop:e},this._duration,this._ease)};var m=$(".go-to"),p=new u(e.outerHeight(),s,400,"swing");m.on({click:function(e){e.preventDefault();var t=$(this).attr("href");p.to=t,p.scroll()}}),$("footer").find("form").addClass("rojo"),$("#fixed-form .bar-form").addClass("fixed-bottom-form"),$("#packs-owl-carousel").owlCarousel({loop:!0,center:!0,margin:30,nav:!0,dots:!0,items:1});var w=$("#preload"),v=$("body#body");setTimeout(function(){w.addClass("hide"),v.addClass("show"),AOS.init({duration:800})},800),document.querySelectorAll("form").forEach(function(e,t){e.setAttribute("id","form-".concat(t+1))});var C=$(".cards-packs");C.on({mouseenter:function(){C.addClass("un-selected"),$(this).removeClass("un-selected"),$(this).addClass("selected")},mouseleave:function(){C.removeClass("un-selected"),$(this).removeClass("selected")}})});