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
      // autoplay: {
      //   delay: 5000,
      //   disableOnInteraction: false,
      // },
      navigation: {
        nextEl: '.swiper-btn-next',
        prevEl: '.swiper-btn-prev',
      },
      speed: 600,
      effect: 'slide',
    });
  });

});