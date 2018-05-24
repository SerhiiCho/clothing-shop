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

/**
 * This function auto updates pictures after selecting them via
 * file input
 * @param {string} src
 */
function showImages(src) {
	let readers = [
		new FileReader(),
		new FileReader(),
		new FileReader(),
		new FileReader(),
		new FileReader()
	]

	src.addEventListener("click", () => {
		for (let i = 1; i <= 5; i++) {
			id("target-image" + i).src = '/storage/img/clothes/default.jpg'
		}
	})

	src.addEventListener("change", ()=> {
		if (src.files.length !== 0) {
			for (let i = 0, num = 1; i < readers.length; i++, num++) {
				if (src.files[i]) {
					readers[i].readAsDataURL(src.files[i])
					readers[i].onload = function(e) { id("target-image" + num).src = this.result }
				} else {
					id("target-image" + num).src = '/storage/img/clothes/default.jpg'
				}
			}
			// if (src.files[0]) {
			// 	fr1.readAsDataURL(src.files[0])
			// 	fr1.onload = function(e) { id("target-image1").src = this.result }
			// } else {
			// 	id("target-image1").src = '/storage/img/clothes/default.jpg'
			// }
			// if (src.files[1]) {
			// 	fr2.readAsDataURL(src.files[1])
			// 	fr2.onload = function(e) { id("target-image2").src = this.result }
			// } else {
			// 	id("target-image2").src = '/storage/img/clothes/default.jpg'
			// }
			// if (src.files[2]) {
			// 	fr3.readAsDataURL(src.files[2])
			// 	fr3.onload = function(e) { id("target-image3").src = this.result }
			// } else {
			// 	id("target-image3").src = '/storage/img/clothes/default.jpg'
			// }
			// if (src.files[3]) {
			// 	fr4.readAsDataURL(src.files[3])
			// 	fr4.onload = function(e) { id("target-image4").src = this.result }
			// } else {
			// 	id("target-image4").src = '/storage/img/clothes/default.jpg'
			// }
			// if (src.files[4]) {
			// 	fr5.readAsDataURL(src.files[4])
			// 	fr5.onload = function(e) { id("target-image5").src = this.result }
			// } else {
			// 	id("target-image5").src = '/storage/img/clothes/default.jpg'
			// }
		}
	})
}

// User on page where variables:
// src and target exist, run function
if (id("src-image")) showImages(id("src-image"))

if (id('prevent-double-submitting')) {
	id('prevent-double-submitting').addEventListener('submit', function () {
		id('submit-button').disabled = true
	})
}