document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('facultyPassword');
    const generateButton = document.getElementById('generateFacultyPassword');
    const toggleButton = document.getElementById('toggleFacultyPassword');

    if (!passwordInput || !generateButton || !toggleButton) return;

    generateButton.addEventListener('click', function () {
        const array = new Uint32Array(6);
        crypto.getRandomValues(array);

        let password = '';

        for (let i = 0; i < 6; i++) {
            password += array[i] % 10;
        }

        passwordInput.value = password;
        passwordInput.type = 'text';
        toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
        passwordInput.focus();
    });

    toggleButton.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';
        toggleButton.innerHTML = isHidden
            ? '<i class="bi bi-eye-slash"></i>'
            : '<i class="bi bi-eye"></i>';
    });
});