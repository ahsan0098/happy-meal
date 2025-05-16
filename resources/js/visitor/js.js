import Swiper from "swiper";
import "swiper/css"; // Import Swiper styles

// add sticky-class to header
document.addEventListener("livewire:init", function () {
  document.addEventListener("livewire:navigated", () => {
    if (document.querySelector(".mySwiper")) {
      var swiper = new Swiper(".mySwiper", {
        autoplay: true,
        loop: true,
      });
    }
    const header = document.querySelector("header");
    const stickyOffset = header?.offsetTop;

    window.onscroll = function () {
      if (window.pageYOffset > stickyOffset) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    };

    const modelswippers = document.querySelectorAll('.imges');

    modelswippers.forEach((m_swipper) => {
      m_swipper.addEventListener('click', () => {
        const images = m_swipper.getAttribute('data-gallery');
        const swiperContainer = document.querySelector('.myImages');
        const swiperWrapper = swiperContainer.querySelector('.swiper-wrapper');
        swiperWrapper.innerHTML = ''; // Clear previous images
        const imageArray = JSON.parse(images)
        imageArray.forEach((image) => {
          const slide = document.createElement('div');
          slide.classList.add('swiper-slide');
          slide.innerHTML = `<img src="uploads/${image}" alt="Image">`;
          swiperWrapper.appendChild(slide);
        });

      })
    });

    // slider
    var swiper = new Swiper(".myfleet", {
      spaceBetween: 30,
      grabCursor: true,
      autoplay: true,
      loop: true,
      navigation: {
        nextEl: ".service-next-one",
        prevEl: ".service-prev-one",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 50,
        },
        1280: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
      },
    });
    // slider
    // mytestmonial
    var swiper = new Swiper(".mytestmonial", {
      slidesPerView: 2,
      spaceBetween: 50,
      grabCursor: true,
      autoplay: true,
      loop: true,
      navigation: {
        nextEl: ".service-next-one",
        prevEl: ".service-prev-one",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 50,
        },
        1280: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      },
    });
    // mytestmonial

    var swiper = new Swiper(".myImages", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });


    let currentTab = 0;
    const tabs = document.querySelectorAll('.tab');
    const navLinks = document.querySelectorAll('.nav-pills .nav-link');

    function showTab(index) {
      tabs.forEach((tab, i) => {
        tab.classList.toggle('active', i === index);
      });

      navLinks.forEach((link, i) => {
        link.classList.toggle('active', i === index);
        if (i <= index) {
          link.classList.remove('disabled');
        }
      });

      currentTab = index;
    }

    // Handle navigation button clicks inside tabs

    const nextBtn = document.querySelectorAll('.nextBtn');
    const prevBtn = document.querySelectorAll('.prevBtn');
    const form = document.querySelector('#form');

    nextBtn.forEach((btn) => {
      btn.addEventListener('click', function () {
        if (currentTab <= 0) {
          // Validate the current tab's form fields
          if (!form.checkValidity()) {
            form.reportValidity();
            return;
          }
        }
        // If the current tab is valid, proceed to the next tab
        showTab(currentTab + 1);

      });
    });

    prevBtn.forEach((btn) => {
      btn.addEventListener('click', function () {
        if (currentTab > 0) {
          showTab(currentTab - 1);
        }

      });
    });

    // Allow clicking nav pills
    navLinks.forEach(link => {
      link.addEventListener('click', function () {
        const index = parseInt(this.getAttribute('data-index'));
        if (index <= currentTab) {
          showTab(index);
        }
      });
    });

    showTab(currentTab);
  });
});


// wizard-form