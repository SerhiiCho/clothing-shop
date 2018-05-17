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

var src = id("src-image")
var target = id("target-image")
/**
 * This function auto updates pictures after selecting them via
 * file input
 * @param {string} src 
 * @param {string} target 
 */
function showImage(src, target) {
	var fr = new FileReader()
	
	src.addEventListener("change", ()=> {
		if (src.files.length !== 0) {
			fr.readAsDataURL(src.files[0])
			fr.onload = function(e) { target.src = this.result }
		} else {
			target.src = '/storage/img/clothes/default.jpg'
		}
	})
}

// User on page where variables:
// src and target exist, run function
if (src && target) showImage(src, target)

if (id('prevent-double-submitting')) {
	id('prevent-double-submitting').addEventListener('submit', function () {
		id('submit-button').disabled = true
	})
}