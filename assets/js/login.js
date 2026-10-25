document.getElementById('togglePassword').addEventListener('click', function () {
    const password = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
        this.setAttribute('aria-label', 'Hide password');
    } else {
        password.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
        this.setAttribute('aria-label', 'Show password');
    }
});