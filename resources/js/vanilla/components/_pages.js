(function PreventDoubleSubmittingForms() {
    let btn = document.getElementById('submit-button')
    let form = document.getElementById('prevent-double-submitting')

    if (form) {
        form.addEventListener('submit', () => btn.disabled = true)
    }
})();