document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('shadow-lg', 'bg-white/95');
    } else {
        navbar.classList.remove('shadow-lg', 'bg-white/95');
    }
});

const mobileMenuBtn = document.getElementById('mobile-menu-btn');
let mobileMenuOpen = false;

mobileMenuBtn.addEventListener('click', () => {
    mobileMenuOpen = !mobileMenuOpen;
    if (mobileMenuOpen) {
        const menu = document.createElement('div');
        menu.id = 'mobile-nav-menu';
        menu.className = 'md:hidden absolute top-18 left-0 right-0 bg-white shadow-lg';
        menu.innerHTML = `
            <div class="flex flex-col space-y-2 p-4">
                <a href="#beranda" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Beranda</a>
                <a href="#tentang" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Tentang</a>
                <a href="#fitur" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Fitur</a>
                <a href="#kontak" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Kontak</a>
                <a href="auth/login.php" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Login</a>
            </div>
        `;
        navbar.appendChild(menu);
    } else {
        const menu = document.getElementById('mobile-nav-menu');
        if (menu) menu.remove();
    }
});

const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in-visible');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.fade-in, section').forEach(el => {
    observer.observe(el);
});

function animateCounter(element, target, duration = 2000) {
    let current = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const statsSection = entry.target;
            statsSection.querySelectorAll('.text-4xl').forEach(stat => {
                const value = parseInt(stat.textContent);
                if (!isNaN(value)) animateCounter(stat, value);
            });
            statsObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

const statsSection = document.querySelector('[class*="bg-blue-secondary"]');
if (statsSection) statsObserver.observe(statsSection);

let currentSlide = 0;
const slides = document.querySelectorAll('#testimonialSlider > div');
const dots = document.querySelectorAll('.dot');

function goToSlide(n) {
    if (slides.length === 0) return;
    currentSlide = (n + slides.length) % slides.length;
    const slider = document.getElementById('testimonialSlider');
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    
    dots.forEach(dot => {
        dot.classList.remove('bg-blue-secondary');
        dot.classList.add('bg-gray-300');
    });
    if (dots[currentSlide]) {
        dots[currentSlide].classList.remove('bg-gray-300');
        dots[currentSlide].classList.add('bg-blue-secondary');
    }
}

let sliderInterval = setInterval(() => goToSlide(currentSlide + 1), 5000);

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        clearInterval(sliderInterval);
        goToSlide(index);
        sliderInterval = setInterval(() => goToSlide(currentSlide + 1), 5000);
    });
});

const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const messageBox = document.getElementById('formMessage');

        fetch('../aksi/aksi_kirim_pesan.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                messageBox.innerText = "Pesan berhasil dikirim!";
                messageBox.className = "text-green-600 text-sm text-center mt-2";
                this.reset();
            } else {
                messageBox.innerText = data.message;
                messageBox.className = "text-red-600 text-sm text-center mt-2";
            }
        })
        .catch(() => {
            messageBox.innerText = "Terjadi kesalahan.";
            messageBox.className = "text-red-600 text-sm text-center mt-2";
        });
    });
}

const style = document.createElement('style');
style.textContent = `
    .fade-in { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .fade-in-visible { opacity: 1; transform: translateY(0); }
    #testimonialSlider { display: flex; transition: transform 0.5s ease; }
`;
document.head.appendChild(style);