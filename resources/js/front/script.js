document.addEventListener('DOMContentLoaded', function () {
  const navbarToggle = document.querySelector('[data-collapse-toggle="navbar-default"]');
  const navbarMenu = document.getElementById('navbar-default');
  
  navbarToggle.addEventListener('click', function () {
    navbarMenu.classList.toggle('hidden');
    navbarToggle.setAttribute('aria-expanded', navbarMenu.classList.contains('hidden'));
  });
});

window.addEventListener('DOMContentLoaded', function() {
  var swiper = new Swiper('.categories-slider', {
    slidesPerView: 6,
    slidesPerColumn: 2,
    spaceBetween: 80,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
   
    breakpoints: {
        767: {
            slidesPerView: 3,
            slidesPerColumn: 2,
            spaceBetween: 25,
            pagination: {
              el: '.swiper-pagination', 
              clickable: true, 
          },
          1140: {
            slidesPerView: 4,
            slidesPerColumn: 2,
            spaceBetween: 50,
        },
        }
      }
  });
});

window.addEventListener('DOMContentLoaded', function() {
  var swiper = new Swiper('.high-rated-prod ', {
    slidesPerView: 5,
    spaceBetween: 20,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      567: {
        slidesPerView: 2,
        spaceBetween: 10,
        centeredSlides: true,
        loop: true,
        pagination: {
          el: '.swiper-pagination', 
          clickable: true, 
        }
      },
      767: {
          slidesPerView: 3,
          spaceBetween: 10,
          centeredSlides: false,
          loop: false,
          pagination: {
            el: '.swiper-pagination', 
            clickable: true, 
        },
        1140: {
          slidesPerView: 4,
      },
      }
    }
  });
});

window.addEventListener('DOMContentLoaded', function() {
  var swiper = new Swiper('.high-rated-seller', {
    slidesPerView: 4,
    spaceBetween: 20,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      567: {
        slidesPerView: 1,
        spaceBetween: 10,
        centeredSlides: true,
        loop: true,
        pagination: {
          el: '.swiper-pagination', 
          clickable: true, 
        }
      },
      767: {
          slidesPerView: 2,
          spaceBetween: 10,
          centeredSlides: false,
          loop: false,
          pagination: {
            el: '.swiper-pagination', 
            clickable: true, 
        },
        1140: {
          slidesPerView: 3,
      },
      }
    }
  });
});