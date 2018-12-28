(function PreventDoubleSubmittingForms() {
    let btn = document.getElementById('submit-button')
    let form = document.getElementById('prevent-double-submitting')

    if (form) {
        form.addEventListener('submit', () => btn.disabled = true)
    }
})();

(function PreventSubmittingIfNotConfirmed() {
    let buttons = document.querySelectorAll('.confirm');

    if (buttons) {
        buttons.forEach(btn => {
            btn.addEventListener('click', e => {
                if (!confirm(btn.getAttribute('data-confirm'))) {
                    e.preventDefault();
                }
            });
        });
    }
})();