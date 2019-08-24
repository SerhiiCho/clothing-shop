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

(function ShowEditFormAndHideTextAfterClickingTheButton() {
   let buttons = document.querySelectorAll('.edit-form-btn')
   let formIsHidden = true

   buttons.forEach(btn => {
       let form = document.getElementById(btn.getAttribute('data-form'))
       let section = document.getElementById(btn.getAttribute('data-section'))

        btn.addEventListener('click', () => {
            if (formIsHidden) {
                form.classList.remove('d-none')
                section.style.display = 'none'
                formIsHidden = false

                // Make textarea full height
                let text = form.querySelector('textarea')
                text.style.height = text.scrollHeight + 'px'
            } else if (!formIsHidden) {
                form.classList.add('d-none')
                section.style.display = 'none'
                section.style.display = 'block'
                formIsHidden = true
            }
        })
   })
})();

(function PreventMultipleFormSubmitting() {
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', e => {
                let button = e.target.querySelector('button[type=submit]')
                button.setAttribute('disabled', 'disabled')
                button.classList.add('disabled')
                button.innerHTML =
                    '<i class="fas fa-circle-notch fa-1x fa-spin"></i>'
            }, false,
        );
    });
})();

(function ToggleUserSidebarView() {
    const triggerOpen = document.querySelector('.show-user-sidebar-btn')
    const triggerClose =  document.querySelector('#close-sidebar-button')
    const sidebar =  document.querySelector('.user-sidebar')

    triggerOpen.addEventListener('click', () => sidebar.classList.add('user-sidebar--active'))
    triggerClose.addEventListener('click', () => sidebar.classList.remove('user-sidebar--active'))
})();