
document.addEventListener('DOMContentLoaded', () => {
    const title = document.getElementById('error-title');
    const message = document.getElementById('error-message');
    const backHome = document.getElementById('back-home');
    
    // Přidávání viditelnosti
    title.style.opacity = 0;
    message.style.opacity = 0;
    backHome.style.opacity = 0;

    setTimeout(() => {
        title.style.transition = "opacity 1s ease-in-out";
        title.style.opacity = 1;
    }, 300);

    setTimeout(() => {
        message.style.transition = "opacity 1s ease-in-out";
        message.style.opacity = 1;
    }, 1000);

    setTimeout(() => {
        backHome.style.transition = "opacity 1s ease-in-out, transform 0.5s ease-in-out";
        backHome.style.opacity = 1;
        backHome.classList.add('pulse'); // Přidání animace pulzování
    }, 1500);
});
