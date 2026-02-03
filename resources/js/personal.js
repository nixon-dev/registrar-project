const faqItems = document.querySelectorAll(".faq-item");

faqItems.forEach(item => {
    const btn = item.querySelector(".faq-question");

    btn.addEventListener("click", () => {
        faqItems.forEach(i => {
            if (i !== item) {
                i.classList.remove("active");
                i.querySelector(".icon").textContent = "+";
            }
        });
        item.classList.toggle("active");
        const icon = item.querySelector(".icon");
        icon.textContent = item.classList.contains("active") ? "-" : "+";
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const logoElement = document.getElementById('qsulogo');
    const redirectUrl = '/registrar-admin';
    const requiredClicks = 3;
    const clickTimeoutMs = 500;
    let clickCounter = 0;
    let timer = 100;
    if (logoElement) {
        logoElement.addEventListener('click', function() {
            clickCounter++;
            if (clickCounter === requiredClicks) {
                clearTimeout(timer);
                clickCounter = 0;
                window.location.href = redirectUrl;
                return;
            }
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(() => {
                clickCounter = 0;
                timer = null;
            }, clickTimeoutMs);
        });
    }
});