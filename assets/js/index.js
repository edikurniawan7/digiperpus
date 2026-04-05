// ==============================
// NAVBAR SCROLL EFFECT
// ==============================
const navbar = document.getElementById("navbar");

window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        navbar.classList.add("shadow-md", "bg-white");
    } else {
        navbar.classList.remove("shadow-md");
    }
});

// ==============================
// MOBILE MENU (simple toggle)
// ==============================
const menuBtn = document.getElementById("mobile-menu-btn");

menuBtn.addEventListener("click", () => {
    alert("Menu mobile belum dibuat 😄"); // nanti kita bikin dropdown kalau mau
});

// ==============================
// SMOOTH SCROLL NAV LINK
// ==============================
document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("click", function(e) {
        if (this.getAttribute("href").startsWith("#")) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            target.scrollIntoView({
                behavior: "smooth"
            });
        }
    });
});

// ==============================
// TESTIMONIAL SLIDER
// ==============================
const slider = document.getElementById("testimonialSlider");
const dots = document.querySelectorAll(".dot");

let currentSlide = 0;

function showSlide(index) {
    slider.style.transform = `translateX(-${index * 100}%)`;

    dots.forEach(dot => dot.classList.remove("bg-blue-secondary"));
    dots.forEach(dot => dot.classList.add("bg-gray-300"));

    dots[index].classList.remove("bg-gray-300");
    dots[index].classList.add("bg-blue-secondary");

    currentSlide = index;
}

dots.forEach(dot => {
    dot.addEventListener("click", () => {
        const slideIndex = dot.getAttribute("data-slide");
        showSlide(slideIndex);
    });
});

// auto slide
setInterval(() => {
    let next = (currentSlide + 1) % dots.length;
    showSlide(next);
}, 4000);

// ==============================
// CONTACT FORM (dummy submit)
// ==============================
const form = document.getElementById("contactForm");

form.addEventListener("submit", function(e) {
    e.preventDefault();
    alert("Pesan berhasil dikirim!");
    form.reset();
});