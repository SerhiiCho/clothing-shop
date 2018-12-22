(function ShowSidebarAfterClickHamburger() {
    let navMenu = document.getElementById('nav-menu')
    let hamburger = document.getElementById('hamburger')
    let closeNav = document.getElementById('close-nav-menu')

    hamburger.addEventListener('click', () => {
        navMenu.style.top = 0
        hamburger.style.opacity = 0
    })

    closeNav.addEventListener('click', () => {
        navMenu.style.top = '-25em'
        hamburger.style.opacity = 0.9
    })
})();

(function HideNavbarAfterScrollDown() {
    window.onscroll = () => {
        let logo = document.getElementById('logo-clothing')
        let hamburger = document.getElementById('hamburger-container')

        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            logo.style.opacity = 0
            logo.style.display = 'none'
            hamburger.classList.add('hamburger-down')
        } else {
            logo.style.opacity = 1
            hamburger.classList.remove('hamburger-down')
            setTimeout(() => logo.style.display = 'block', 250)
        }
    }
})();