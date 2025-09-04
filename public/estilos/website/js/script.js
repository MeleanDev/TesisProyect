// // Import jQuery and Bootstrap
// const $ = require("jquery")
// const bootstrap = require("bootstrap") // Declare the bootstrap variable

// $(document).ready(() => {
//   // Navbar scroll effect
//   $(window).scroll(function () {
//     if ($(this).scrollTop() > 50) {
//       $(".custom-navbar").addClass("scrolled")
//     } else {
//       $(".custom-navbar").removeClass("scrolled")
//     }
//   })

//   // Mobile menu toggle
//   $(".custom-toggler").click(function () {
//     $(this).toggleClass("active")
//     $(".navbar-collapse").toggleClass("show")
//   })

//   // Smooth scrolling for anchor links
//   $('a[href^="#"]').click(function (e) {
//     e.preventDefault()
//     const target = $(this.getAttribute("href"))
//     if (target.length) {
//       $("html, body").animate(
//         {
//           scrollTop: target.offset().top - 100,
//         },
//         1000,
//       )
//     }
//   })

//   // Counter animation
//   function animateCounters() {
//     $(".counter").each(function () {
//       const $this = $(this)
//       const target = Number.parseInt($this.data("target"))

//       if (target) {
//         $({ countNum: 0 }).animate(
//           {
//             countNum: target,
//           },
//           {
//             duration: 2000,
//             easing: "swing",
//             step: function () {
//               $this.text(Math.floor(this.countNum) + "+")
//             },
//             complete: () => {
//               $this.text(target + "+")
//             },
//           },
//         )
//       }
//     })
//   }

//   // Trigger counter animation when stats section is visible
//   $(window).scroll(() => {
//     const statsSection = $(".counter").first().closest("section")
//     if (statsSection.length) {
//       const scrollTop = $(window).scrollTop()
//       const sectionTop = statsSection.offset().top
//       const windowHeight = $(window).height()

//       if (scrollTop + windowHeight > sectionTop && !statsSection.hasClass("animated")) {
//         statsSection.addClass("animated")
//         animateCounters()
//       }
//     }
//   })

//   // Form handling
//   $("#loginForm").submit(function (e) {
//     e.preventDefault()
//     const email = $("#email").val()
//     const password = $("#password").val()

//     if (email && password) {
//       showAlert("Funcionalidad de login en desarrollo. Email: " + email, "info")
//       $("#loginModal").modal("hide")
//       $(this)[0].reset()
//     }
//   })

//   $("#contactFormHome").submit(function (e) {
//     e.preventDefault()

//     const formData = {
//       nombre: $("#nombreHome").val(),
//       apellido: $("#apellidoHome").val(),
//       correo: $("#correoHome").val(),
//       telefono: $("#telefonoHome").val(),
//       asunto: $("#asuntoHome").val(),
//       mensaje: $("#mensajeHome").val(),
//     }

//     console.log("Datos del formulario de contacto (Home):", formData)
//     showAlert("¡Mensaje enviado exitosamente! Te contactaremos pronto.", "success")
//     $(this)[0].reset()
//   })

//   $("#contactForm").submit(function (e) {
//     e.preventDefault()

//     const formData = {
//       nombre: $("#nombre").val(),
//       apellido: $("#apellido").val(),
//       correo: $("#correo").val(),
//       telefono: $("#telefono").val(),
//       asunto: $("#asunto").val(),
//       mensaje: $("#mensaje").val(),
//     }

//     console.log("Datos del formulario de contacto:", formData)
//     showAlert("¡Mensaje enviado exitosamente! Te contactaremos pronto.", "success")
//     $(this)[0].reset()
//   })

//   $("#contactCourseForm").submit(function (e) {
//     e.preventDefault()

//     const formData = {
//       nombre: $("#nombreCourse").val(),
//       email: $("#emailCourse").val(),
//       telefono: $("#telefonoCourse").val(),
//       mensaje: $("#mensajeCourse").val(),
//     }

//     console.log("Solicitud de información del curso:", formData)
//     showAlert("¡Solicitud enviada! Te contactaremos pronto con la información del curso.", "success")
//     $("#contactModal").modal("hide")
//     $(this)[0].reset()
//   })

//   $("#preinscriptionForm").submit(function (e) {
//     e.preventDefault()

//     const nombre = $("#nombre").val()
//     const apellido = $("#apellido").val()
//     const cedula = $("#cedula").val()
//     const correo = $("#correo").val()
//     const fechaNacimiento = $("#fechaNacimiento").val()
//     const tipoCurso = $("#tipoCurso").val()
//     const terminos = $("#terminos").is(":checked")

//     if (!nombre || !apellido || !cedula || !correo || !fechaNacimiento || !tipoCurso || !terminos) {
//       showAlert("Por favor, completa todos los campos obligatorios y acepta los términos y condiciones.", "warning")
//       return
//     }

//     if (!isValidEmail(correo)) {
//       showAlert("Por favor, ingresa un correo electrónico válido.", "warning")
//       return
//     }

//     if (!isValidAge(fechaNacimiento)) {
//       showAlert("La edad mínima para inscribirse es de 5 años.", "warning")
//       return
//     }

//     const formData = {
//       nombre: nombre,
//       apellido: apellido,
//       cedula: cedula,
//       correo: correo,
//       fechaNacimiento: fechaNacimiento,
//       telefono: $("#telefono").val(),
//       tipoCurso: tipoCurso,
//       comentarios: $("#comentarios").val(),
//       newsletter: $("#newsletter").is(":checked"),
//     }

//     console.log("Datos de preinscripción:", formData)
//     showSuccessModal()
//     $(this)[0].reset()
//   })

//   // Form validation helpers
//   function isValidEmail(email) {
//     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
//     return emailRegex.test(email)
//   }

//   function isValidAge(birthDate) {
//     const birth = new Date(birthDate)
//     const today = new Date()
//     let age = today.getFullYear() - birth.getFullYear()
//     const monthDiff = today.getMonth() - birth.getMonth()

//     if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
//       age--
//     }

//     return age >= 5
//   }

//   // Input formatting
//   $("#cedula").on("input", function () {
//     let value = $(this).val().replace(/\D/g, "")
//     if (value.length > 10) {
//       value = value.substring(0, 10)
//     }
//     $(this).val(value)
//   })

//   $("#telefono, #telefonoHome, #telefonoCourse").on("input", function () {
//     let value = $(this).val().replace(/\D/g, "")
//     if (value.length > 10) {
//       value = value.substring(0, 10)
//     }
//     $(this).val(value)
//   })

//   // Email validation on blur
//   $('input[type="email"]').blur(function () {
//     const email = $(this).val()
//     if (email && !isValidEmail(email)) {
//       $(this).addClass("is-invalid")
//     } else {
//       $(this).removeClass("is-invalid")
//     }
//   })

//   // Form submission loading state
//   $("form").submit(function () {
//     const submitBtn = $(this).find('button[type="submit"]')
//     const originalHtml = submitBtn.html()

//     submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Enviando...')
//     submitBtn.prop("disabled", true)

//     setTimeout(() => {
//       submitBtn.html(originalHtml)
//       submitBtn.prop("disabled", false)
//     }, 2000)
//   })

//   // Scroll animations
//   function checkScroll() {
//     $(".fade-in, .slide-in-left, .slide-in-right").each(function () {
//       const elementTop = $(this).offset().top
//       const elementBottom = elementTop + $(this).outerHeight()
//       const viewportTop = $(window).scrollTop()
//       const viewportBottom = viewportTop + $(window).height()

//       if (elementBottom > viewportTop && elementTop < viewportBottom) {
//         $(this).addClass("visible")
//       }
//     })
//   }

//   $(window).scroll(checkScroll)
//   checkScroll() // Check on page load

//   // WhatsApp button tracking
//   $(".whatsapp-btn").click(() => {
//     console.log("WhatsApp button clicked")
//   })

//   // Alert function
//   function showAlert(message, type = "info") {
//     const alertClass = `alert-${type}`
//     const alertHtml = `
//       <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
//            style="top: 100px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
//           ${message}
//           <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
//       </div>
//     `

//     $("body").append(alertHtml)

//     setTimeout(() => {
//       $(".alert").alert("close")
//     }, 5000)
//   }

//   // Success modal
//   function showSuccessModal() {
//     const modalHtml = `
//       <div class="modal fade" id="successModal" tabindex="-1">
//           <div class="modal-dialog modal-dialog-centered">
//               <div class="modal-content custom-modal">
//                   <div class="modal-body text-center p-5">
//                       <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
//                       <h3 class="mb-3" style="color: var(--gray-800);">¡Preinscripción Exitosa!</h3>
//                       <p class="lead">Hemos recibido tu solicitud. Te contactaremos pronto con más información.</p>
//                       <button type="button" class="btn custom-btn-primary" data-bs-dismiss="modal">Cerrar</button>
//                   </div>
//               </div>
//           </div>
//       </div>
//     `

//     $("body").append(modalHtml)
//     $("#successModal").modal("show")

//     $("#successModal").on("hidden.bs.modal", function () {
//       $(this).remove()
//     })
//   }

//   // Curriculum toggle (for course detail page)
//   $(".curriculum-header").click(function () {
//     const content = $(this).next(".curriculum-content")
//     content.slideToggle()
//     $(this).find("i").toggleClass("fa-chevron-down fa-chevron-up")
//   })

//   // Related course hover effects
//   $(".related-course-item").hover(
//     function () {
//       $(this).addClass("hovered")
//     },
//     function () {
//       $(this).removeClass("hovered")
//     },
//   )

//   // Initialize tooltips if Bootstrap is available
//   if (typeof bootstrap !== "undefined") {
//     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
//     var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl))
//   }

//   // Course card hover effects
//   $(".course-card, .course-category-card").hover(
//     function () {
//       $(this).addClass("hovered")
//     },
//     function () {
//       $(this).removeClass("hovered")
//     },
//   )

//   // Lazy loading for images
//   if ("IntersectionObserver" in window) {
//     const imageObserver = new IntersectionObserver((entries, observer) => {
//       entries.forEach((entry) => {
//         if (entry.isIntersecting) {
//           const img = entry.target
//           img.src = img.dataset.src
//           img.classList.remove("lazy")
//           imageObserver.unobserve(img)
//         }
//       })
//     })

//     document.querySelectorAll("img[data-src]").forEach((img) => {
//       imageObserver.observe(img)
//     })
//   }
// })

// // Global functions
// window.closeSuccessMessage = () => {
//   $("#successMessage").hide()
// }

// // Utility functions
// function debounce(func, wait, immediate) {
//   var timeout
//   return function executedFunction() {
    
//     var args = arguments
//     var later = () => {
//       timeout = null
//       if (!immediate) func.apply(this, args)
//     }
//     var callNow = immediate && !timeout
//     clearTimeout(timeout)
//     timeout = setTimeout(later, wait)
//     if (callNow) func.apply(this, args)
//   }
// }

// // Performance optimization for scroll events
// const debouncedScroll = debounce(() => {
//   // Scroll-based animations and effects
// }, 10)

// window.addEventListener("scroll", debouncedScroll)
