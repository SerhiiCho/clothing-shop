(function SubmitLogoutFormAfterCliking() {
    let btn = document.getElementById('logout-btn')
    let form = document.getElementById('logout-form')

    if (btn) {
        btn.addEventListener('click', (e) => {
            e.preventDefault()
            form.submit()
        })
    }
})();