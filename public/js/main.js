// Shortcut function
function id(el) {
	return document.getElementById(el)
}

let loadingTitle = document.getElementById('loading-title')
let loading      = document.getElementById('loading')
var opened 		 = false

/**
 * After page has been loaded, it will
 * remove the loading animation
 * 
 * @name preloader
 */
window.onload = () => {
	loading.classList.remove("loading")
	loadingTitle.innerHTML = ''
}

id('hamburger').addEventListener('click', () => {
	id('nav-menu').style.top = 0
	id('hamburger-container').style.opacity = 0
    opened = true
})

id('close-nav-menu').addEventListener('click', () => {
	id('nav-menu').style.top = '-25em'
	id('hamburger-container').style.opacity = 0.9
    opened = false
})

window.onscroll = () => {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		id('logo-clothing').style.opacity = 0
		id('logo-clothing').style.display = 'none'
		id('hamburger-container').classList.add('hamburger-down')
    } else {
		id('logo-clothing').style.opacity = 1
		id('hamburger-container').classList.remove('hamburger-down')
		setTimeout(() => id('logo-clothing').style.display = 'block', 250)
    }
}