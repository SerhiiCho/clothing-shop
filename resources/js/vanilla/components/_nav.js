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

