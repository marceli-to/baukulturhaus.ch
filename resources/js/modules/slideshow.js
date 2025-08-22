import { Swiper } from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Initialize Swipers
document.addEventListener('DOMContentLoaded', function() {

  // Galleries
  const galleries = document.querySelectorAll('[data-gallery]');
  galleries.forEach(slideshowElement => {
    new Swiper(slideshowElement, {
      modules: [Navigation, Pagination, Autoplay],
      loop: true,
      navigation: {
        nextEl: '.swiper-btn-next',
        prevEl: '.swiper-btn-prev',
      },
      speed: 600,
      effect: 'slide',
    });
  });

  // Supporter Sliders
  const supporters = document.querySelectorAll('[data-supporter-slider]');
  supporters.forEach(slideshowElement => {
    new Swiper(slideshowElement, {
      modules: [Navigation, Pagination, Autoplay],
      loop: true,
      slidesPerView: 1,
      spaceBetween: 16,
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
      navigation: {
        nextEl: '.swiper-btn-supporter-next',
        prevEl: '.swiper-btn-supporter-prev',
      },
      speed: 600,
      effect: 'slide',
    });
  });

    // Team Sliders
    const teams = document.querySelectorAll('[data-team-slider]');
    teams.forEach(slideshowElement => {
      new Swiper(slideshowElement, {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        breakpoints: {
          768: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 3,
          },
        },
        navigation: {
          nextEl: '.swiper-btn-team-next',
          prevEl: '.swiper-btn-team-prev',
        },
        speed: 600,
        effect: 'slide',
      });
    });

});