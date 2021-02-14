"use strict"

window.addEventListener("DOMContentLoaded", function () {
  //Globals variables
  const $bodyHtml = $("body, html")
  const $header = $("header")
  const $ourWindow = $(window)

  // Show Legales
  const $buttonLegales = $("#btn-legales")
  const $sectionLegales = $(".Legales")
  const $sectionCopy = $(".Copy-legal")

  $buttonLegales.on("click", function (e) {
    e.preventDefault()
    $sectionLegales.addClass("show")
    $sectionCopy.css({
      paddingBottom: `0px`,
    })
    const target = $(this).attr("id")
    const $targetOffset = $(`#${target}`).offset().top
    $bodyHtml.animate({ scrollTop: $targetOffset }, 400, "swing")
  })

  // Show Fixed Phone && Fixed Form && Padding Legales
  const $fixedCta = $("#fixed-cta")
  const $fixedForm = $("#fixed-form")
  const $fixedFormHeight = $fixedForm.outerHeight()

  let mediaQuery768 = window.matchMedia("(max-width: 767.98px)")
  mediaQuery768.addListener(evalMatches)

  const showFixedPhone = () => {
    $ourWindow.scrollTop() > 250
      ? $fixedCta.addClass("show")
      : $fixedCta.removeClass("show")
  }

  const showFixedForm = () => {
    $ourWindow.scrollTop() > 500
      ? $fixedForm.addClass("show")
      : $fixedForm.removeClass("show")
  }

  function evalMatches() {
    if (!mediaQuery768.matches) {
      // Fixed Phone
      window.addEventListener("scroll", showFixedPhone)

      // Fixed Form
      $fixedForm.removeClass("show")
      window.removeEventListener("scroll", showFixedForm)

      // Add/Remove Padding
      $sectionCopy.css({
        paddingBottom: `0px`,
      })
    } else {
      // Fixed Phone
      $fixedCta.removeClass("show")
      window.removeEventListener("scroll", showFixedPhone)

      // Fixed Form
      window.addEventListener("scroll", showFixedForm)

      // Add/Remove Padding
      if ($sectionLegales.hasClass("show")) {
        $sectionCopy.css({
          paddingBottom: `0px`,
        })
      } else {
        $sectionCopy.css({
          paddingBottom: `${$fixedFormHeight}px`,
        })

        $sectionLegales.css({
          paddingBottom: `${$fixedFormHeight}px`,
        })
      }
    }
  }
  evalMatches()

  // Scroll To Section
  class ScrollToSection {
    constructor(headerHeight, body, duration, ease) {
      this._headerHeight = headerHeight
      this._body = body
      this._duration = duration
      this._ease = ease
      this._to
    }
    get to() {
      return this._to
    }
    set to(href) {
      this._to = href
    }
  }

  ScrollToSection.prototype.scroll = function () {
    let $targetOffset = $(this._to).offset().top - this._headerHeight
    this._body.animate({ scrollTop: $targetOffset }, this._duration, this._ease)
  }

  const $goToButton = $(".go-to")
  const headerHeight = $header.outerHeight()

  const SCROLL = new ScrollToSection(headerHeight, $bodyHtml, 400, "swing")

  $goToButton.on({
    click: function (e) {
      e.preventDefault()
      let $link = $(this).attr("href")
      SCROLL.to = $link
      SCROLL.scroll()
    },
  })

  // Add class ROJO a form del footer
  $("footer").find("form").addClass("rojo")

  $("#fixed-form .bar-form").addClass("fixed-bottom-form")

  // Carousel Packs
  $("#packs-owl-carousel").owlCarousel({
    loop: true,
    center: true,
    margin: 30,
    nav: true,
    dots: true,
    items: 1,
  })

  // Preload
  let $preload = $("#preload")
  let $body = $("body#body")
  setTimeout(() => {
    $preload.addClass("hide")
    $body.addClass("show")
    AOS.init({
      duration: 800,
    })
  }, 800)

  // Set ID Forms
  const formularios = document.querySelectorAll("form")
  formularios.forEach((el, i) => {
    el.setAttribute("id", `form-${i + 1}`)
  })

  // Animation Hover Cards
  const cards = $(".cards-packs")

  cards.on({
    mouseenter: function () {
      cards.addClass("un-selected")
      $(this).removeClass("un-selected")
      $(this).addClass("selected")
    },
    mouseleave: function () {
      cards.removeClass("un-selected")
      $(this).removeClass("selected")
    },
  })
})
