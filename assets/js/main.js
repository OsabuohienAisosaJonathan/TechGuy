// assets/js/main.js

document.addEventListener('DOMContentLoaded', () => {
    // Handle flash messages if they exist
    const flashMessage = document.querySelector('.flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 3000); // Hide message after 3 seconds
    }
});
