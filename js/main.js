// Open Sub Menu
$('.drp_btn').click(function () {
  $(this).siblings('.sub_menu').slideToggle(500);
})

// Preloader JS

function preloader_fade() {
  $("#preloader").fadeOut('slow');
}

$(document).ready(function () {
  window.setTimeout("preloader_fade();", 500); //call fade in .5 seconds
}
)


// All Slider Js
$('#frmae_slider').owlCarousel({
  loop: true,
  margin: 0,
  autoplay: true,
  smartSpeed: 1500,
  nav: false,
  dots: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
})

// Company Slider
$('#company_slider').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  autoplay: true,
  smartSpeed: 1500,
  dots: true,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
})

// Testimonial Slider
$('#testimonial_slider').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  autoplay: true,
  smartSpeed: 2500,
  dots: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
})

// Screen Slider
$('#screen_slider').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: true,
  autoplay: true,
  smartSpeed: 2500,
  center: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
})

// Feature Slider
$('#feature_slider').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  autoplay: true,
  smartSpeed: 2500,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    },
    1400: {
      margin: 60
    }
  }
})

// text List Flow 
$('#text_list_flow').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  center: true,
  autoplay: true,
  slideTransition: 'linear',
  autoplayTimeout: 4000,
  autoplaySpeed: 4000,
  autoWidth: true,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
})

// text List Flow 
$('#text_list_flow_download').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  center: true,
  autoplay: true,
  slideTransition: 'linear',
  autoplayTimeout: 4000,
  autoplaySpeed: 4000,
  autoWidth: true,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
})


// About Client Slider 
$('#client_slider').owlCarousel({
  loop: true,
  margin: 30,
  nav: false,
  dots: false,
  center: true,
  autoplay: true,
  slideTransition: 'linear',
  autoplayTimeout: 4000,
  autoplaySpeed: 4000,
  autoWidth: true,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
})

// text List Flow 
$('#about_slider').owlCarousel({
  loop: true,
  margin: 20,
  nav: false,
  dots: false,
  center: true,
  autoplay: true,
  slideTransition: 'linear',
  autoplayTimeout: 4000,
  autoplaySpeed: 4000,
  autoWidth: true,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
})


// Feature Slider
$('#value_slider').owlCarousel({
  loop: true,
  margin: 15,
  nav: true,
  dots: false,
  autoplay: true,
  smartSpeed: 2500,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    },
    1400: {
      margin: 60
    }
  }
})

// Feature Slider
$('#testimonial_slider').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  autoplay: true,
  smartSpeed: 2500,
  items: 1
})


// Number Count
let counter_find = document.querySelector('#counter');
if (typeof (counter_find) != 'undefined' && counter_find != null) {
  window.addEventListener('scroll', function () {
    var element = document.querySelector('#counter');
    var position = element.getBoundingClientRect();

    // checking whether fully visible
    if (position.top >= 0 && position.bottom <= window.innerHeight) {
      $('.counter-value').each(function () {
        var $this = $(this),
          countTo = $this.attr('data-count');
        $({
          countNum: $this.text()
        }).animate({
          countNum: countTo
        },

          {

            duration: 2000,
            easing: 'swing',
            step: function () {
              $this.text(Math.floor(this.countNum));
            },
            complete: function () {
              $this.text(this.countNum);
              //alert('finished');
            }

          });
      });
    }

    if (position.top < window.innerHeight && position.bottom >= 0) {
      //console.log('Element is partially visible in screen');
    } else {
      //console.log('Element is not visible');
      $('.counter-value').each(function () {
        var $this = $(this),
          countTo = 0;
        $({
          countNum: $this.text()
        }).animate({
          countNum: countTo
        },

          {

            duration: 100,
            easing: 'swing',
            step: function () {
              $this.text(Math.floor(this.countNum));
            },
            complete: function () {
              $this.text(this.countNum);
              //alert('finished');
            }

          });
      });
    }
  });
}




// --------Magnify-popup

// $(function () {
//   $('.popup-youtube').magnificPopup({
//     disableOn: 700,
//     type: 'iframe',
//     mainClass: 'mfp-fade',
//     removalDelay: 160,
//     preloader: false,
//     fixedContentPos: false
//   });
// });


$(document).ready(function () {
  // Add minus icon for collapse element which is open by default
  $(".collapse.show").each(function () {
    $(this)
      .prev(".card-header")
      .find(".icon_faq")
      .addClass("icofont-minus")
      .removeClass("icofont-plus");
  });


  // Toggle plus minus icon on show hide of collapse element
  $(".collapse").on("show.bs.collapse", function () {
    $(this).prev(".card-header").find(".icon_faq").removeClass("icofont-plus").addClass("icofont-minus");
  })
    .on("hide.bs.collapse", function () {
      $(this).prev(".card-header").find(".icon_faq").removeClass("icofont-minus").addClass("icofont-plus");
    });

  $(".collapse").on("show.bs.collapse", function () {
    $(this).prev(".card-header").children('h2').children('.btn').addClass("active");
  })
    .on("hide.bs.collapse", function () {
      $(this).prev(".card-header").children('h2').children('.btn').removeClass("active");
    });
});


// Scrool-top
// Go Top 
$(document).ready(function () {
  $('#Gotop').click(function () {
    let windiowTop = $(window).scrollTop();
    if (windiowTop <= 1000) {
      $('body,html').animate({ scrollTop: 0 }, 1000);
    } else if (windiowTop <= 2000 && windiowTop > 1000) {
      $('body,html').animate({ scrollTop: 0 }, 2000);
    } else {
      $('body,html').animate({ scrollTop: 0 }, 2500);

    }
  })
})

$(window).scroll(function () {
  let windiowTop = $(window).scrollTop();
  // console.log(windiowTop)
  if (windiowTop > 300) {
    $('#Gotop').fadeIn(500);
  } else {
    $('#Gotop').fadeOut(500);

  }
});

// Fix Header Js
$(window).scroll(function(){
  if ($(window).scrollTop() >= 250) {
      $('header').addClass('fix_style');
  }
  else {
      $('header').removeClass('fix_style');
  }
  if ($(window).scrollTop() >= 260) {
      $('header').addClass('fixed');
  }
  else {
      $('header').removeClass('fixed');
  }
});


//YOUTUBE VIDEO
$('.play-button').click(function (e) {
  var iframeEl = $('<iframe>', { src: $(this).data('url') });
  $('#youtubevideo').attr('src', $(this).data('url'));
})

$('#close-video').click(function (e) {
  $('#youtubevideo').attr('src', '');
});

$(document).on('hidden.bs.modal', '#myModal', function () {
  $('#youtubevideo').attr('src', '');
});



// Close btn on click 

$(document).ready(function () {
  $('.navbar-toggler').click(function () {
    if ($(this).children('span').children('.ico_menu').hasClass('icofont-navigation-menu')) {
      $(this).children('span').children('.ico_menu').removeClass('icofont-navigation-menu').addClass('icofont-close');
    } else {
      $(this).children('span').children('.ico_menu').removeClass('icofont-close').addClass('icofont-navigation-menu');
    }
  });
});

(function () {
  $('.toggle-wrap').on('click', function () {
    $(this).toggleClass('active');
    $('aside').animate({ width: 'toggle' }, 200);
  });
})();


// INITIALIZE AOS

AOS.init();




      // Load reCAPTCHA v3
  function loadReCaptcha() {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js?render=YOUR_RECAPTCHA_V3_SITE_KEY';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    loadReCaptcha();
    
    const form = document.getElementById('techSupportForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      
      // Show loading state
      submitBtn.disabled = true;
      submitBtn.querySelector('.submit-text').classList.add('d-none');
      submitBtn.querySelector('.spinner-border').classList.remove('d-none');
      
      try {
        // Execute reCAPTCHA v3
        const token = await grecaptcha.execute('YOUR_RECAPTCHA_V3_SITE_KEY', {action: 'submit'});
        document.getElementById('g-recaptcha-response').value = token;
        
        // Here you would normally submit to your backend
        // For demo, simulate API call
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Success feedback
        showAlert('success', 'Request submitted successfully! Our technical team will contact you shortly.');
        form.reset();
        
      } catch (error) {
        showAlert('danger', 'Error submitting form. Please try again or contact support directly.');
        console.error('Form submission error:', error);
      } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.querySelector('.submit-text').classList.remove('d-none');
        submitBtn.querySelector('.spinner-border').classList.add('d-none');
      }
    });
    
    // Form validation feedback
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value.trim() !== '') {
          this.classList.add('is-valid');
          this.classList.remove('is-invalid');
        }
      });
      
      input.addEventListener('invalid', function() {
        this.classList.add('is-invalid');
      });
    });
  });
  
  function showAlert(type, message) {
    // Remove existing alerts
    const existingAlert = document.querySelector('.alert');
    if (existingAlert) existingAlert.remove();
    
    // Create new alert
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show mt-4`;
    alertDiv.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Insert after form
    form.parentNode.insertBefore(alertDiv, form.nextSibling);
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
      alertDiv.classList.remove('show');
      setTimeout(() => alertDiv.remove(), 150);
    }, 5000);
  }


    // Complete contact form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');
    const formAlert = document.getElementById('formAlert');
    
    // Validation patterns
    const patterns = {
        name: /^[a-zA-Z\s]{2,100}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        phone: /^[\+]?[1-9][\d\s\-\(\)]{8,20}$/,
        message: /^.{10,2000}$/
    };
    
    // Initialize form
    function initForm() {
        // Add input listeners for real-time validation
        setupInputListeners();
        
        // Handle form submission
        contactForm.addEventListener('submit', handleSubmit);
    }
    
    // Setup input listeners
    function setupInputListeners() {
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                clearError(this);
            });
            
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
    }
    
    // Clear error for a field
    function clearError(field) {
        field.classList.remove('is-invalid');
        const errorElement = document.getElementById(field.id + 'Error');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }
    
    // Validate a single field
    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        
        switch(field.id) {
            case 'name':
                isValid = patterns.name.test(value);
                break;
            case 'email':
                isValid = patterns.email.test(value);
                break;
            case 'phone':
                const cleanPhone = value.replace(/[\s\-\(\)]/g, '');
                isValid = patterns.phone.test(cleanPhone);
                break;
            case 'subject':
                isValid = value !== '';
                break;
            case 'message':
                isValid = patterns.message.test(value);
                break;
        }
        
        if (!isValid) {
            field.classList.add('is-invalid');
            const errorElement = document.getElementById(field.id + 'Error');
            if (errorElement) {
                errorElement.style.display = 'block';
            }
        }
        
        return isValid;
    }
    
    // Validate entire form
    function validateForm() {
        let isValid = true;
        const fields = ['name', 'email', 'phone', 'subject', 'message'];
        
        fields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field && !validateField(field)) {
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    // Show alert message
    function showAlert(message, type) {
        const alertTypes = {
            'success': 'alert-success',
            'danger': 'alert-danger',
            'warning': 'alert-warning',
            'info': 'alert-info'
        };
        
        formAlert.textContent = message;
        formAlert.className = `alert ${alertTypes[type] || 'alert-info'}`;
        formAlert.style.display = 'block';
        
        // Auto-hide success messages
        if (type === 'success') {
            setTimeout(() => {
                formAlert.style.display = 'none';
            }, 5000);
        }
    }
    
    // Hide alert
    function hideAlert() {
        formAlert.style.display = 'none';
    }
    
    // Get reCAPTCHA token
    async function getRecaptchaToken() {
        return new Promise((resolve, reject) => {
            // Check if grecaptcha is loaded
            if (typeof grecaptcha === 'undefined') {
                reject(new Error('reCAPTCHA not loaded'));
                return;
            }
            
            grecaptcha.ready(function() {
                grecaptcha.execute('6Ldj4T4sAAAAAIQSee0NEYh8CuJQG6VVw78wo9et', {
                    action: 'contact_submit'
                }).then(function(token) {
                    resolve(token);
                }).catch(function(error) {
                    reject(new Error('reCAPTCHA failed: ' + error));
                });
            });
        });
    }
    
    // Submit form data
    async function submitFormData(formData) {
        try {
            const response = await fetch('contact-form-handler.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });
            
            // Check if response is OK
            if (!response.ok) {
                throw new Error(`Server returned ${response.status}`);
            }
            
            const result = await response.json();
            return result;
            
        } catch (error) {
            console.error('Fetch error:', error);
            throw error;
        }
    }
    
    // Handle form submission
    async function handleSubmit(e) {
        e.preventDefault();
        
        // Hide any previous alerts
        hideAlert();
        
        // Validate form
        if (!validateForm()) {
            showAlert('Please fix the errors in the form before submitting.', 'warning');
            return;
        }
        
        // Start loading state
        startLoading();
        
        try {
            // Get reCAPTCHA token
            const recaptchaToken = await getRecaptchaToken();
            
            // Prepare form data
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value.trim());
            formData.append('email', document.getElementById('email').value.trim());
            formData.append('phone', document.getElementById('phone').value.trim());
            formData.append('subject', document.getElementById('subject').value);
            formData.append('message', document.getElementById('message').value.trim());
            formData.append('g-recaptcha-response', recaptchaToken);
            
            // Submit to server
            const result = await submitFormData(formData);
            
            if (result.success) {
                // Success
                showAlert(result.message, 'success');
                contactForm.reset();
            } else {
                // Server-side error
                showAlert(result.message, 'danger');
            }
            
        } catch (error) {
            // Network or other errors
            console.error('Submission error:', error);
            
            let errorMessage = 'An error occurred. Please try again.';
            if (error.message.includes('Network') || error.message.includes('Failed to fetch')) {
                errorMessage = 'Network error. Please check your internet connection.';
            } else if (error.message.includes('reCAPTCHA')) {
                errorMessage = 'Security verification failed. Please refresh the page and try again.';
            }
            
            showAlert(errorMessage, 'danger');
        } finally {
            // End loading state
            endLoading();
        }
    }
    
    // Start loading state
    function startLoading() {
        submitBtn.disabled = true;
        submitText.textContent = 'Processing...';
        submitSpinner.style.display = 'inline-block';
    }
    
    // End loading state
    function endLoading() {
        submitBtn.disabled = false;
        submitText.textContent = 'Submit';
        submitSpinner.style.display = 'none';
    }
    
    // Initialize the form
    initForm();
    
    // Debug helper: Log form state
    window.debugForm = function() {
        console.log('Form state:', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value
        });
    };
});