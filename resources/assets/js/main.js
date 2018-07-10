// Shortcut functions
function id(el) {
	return document.getElementById(el)
}

var openedNav = false

// After page has been loaded, it will
// remove the loading animation
window.onload = () => {
	id('loading').classList.remove("loading")
	id('loading-title').innerHTML = ''
}

// Submit logout form after clicking #logout-btn
id('logout-btn').addEventListener('click', (e) => {
	e.preventDefault()
	id('logout-form').submit()
})

id('hamburger').addEventListener('click', () => {
	id('nav-menu').style.top = 0
	id('hamburger-container').style.opacity = 0
    openedNav = true
})

id('close-nav-menu').addEventListener('click', () => {
	id('nav-menu').style.top = '-25em'
	id('hamburger-container').style.opacity = 0.9
    openedNav = false
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

let imagesObj = {
	fileInput: id("multiple-src-image"),
	defaultImgPath: '/storage/img/clothes/default.jpg',
	readers: [
		new FileReader(),
		new FileReader(),
		new FileReader(),
		new FileReader(),
		new FileReader()
	],
	imgWithNumber: (num) => id("target-image" + num),
	filesNotEqualNull: () => id("multiple-src-image").files.length <= 0 ? false : true,
}

if (id("multiple-src-image")) {
	imagesObj.fileInput.addEventListener('change', () => {
		if (imagesObj.filesNotEqualNull()) {
			for (let i = 0, num = 1; i <= 5; i++, num++) {
				if (imagesObj.fileInput.files[i]) {
					imagesObj.readers[i].readAsDataURL(imagesObj.fileInput.files[i])
					imagesObj.readers[i].onload = function (e) {
						imagesObj.imgWithNumber(num).src = this.result
					}
				} else {
					imagesObj.imgWithNumber(i).src = imagesObj.defaultImgPath
				}
			}
		} else {
			for (let i = 1; i <= 5; i++) {
				imagesObj.imgWithNumber(i).src = imagesObj.defaultImgPath
			}
		}
	})
}

// This object auto updates pictures after
// selecting them via file input
let imageUploader = {
	target: id("target-image"),
	src: id("src-image"),
	fr: new FileReader(),
	showImage: function () {
		this.src.addEventListener("change", ()=> {
			if (this.src.files.length !== 0) {
				var that = this
				this.fr.readAsDataURL(this.src.files[0])
				this.fr.onload = function(e) {
					that.target.src = this.result
				}
			} else {
				this.target.src = '/storage/img/clothes/default.jpg'
			}
		})
	}
}

// Run showImage function
if (imageUploader.src && imageUploader.target) {
	imageUploader.showImage()
}

if (id('prevent-double-submitting')) {
	id('prevent-double-submitting').addEventListener('submit', function () {
		id('submit-button').disabled = true
	})
}