// Shortcut functions
function $(el) {
	return document.getElementById(el)
}

var openedNav = false

// After page has been loaded, it will
// remove the loading animation
window.onload = () => {
	$('loading').classList.remove("loading")
	$('loading-title').innerHTML = ''
}

// Submit logout form after clicking #logout-btn
if ($('logout-btn')) {
	$('logout-btn').addEventListener('click', (e) => {
		e.preventDefault()
		$('logout-form').submit()
	})
}

$('hamburger').addEventListener('click', () => {
	$('nav-menu').style.top = 0
	$('hamburger-container').style.opacity = 0
    openedNav = true
})

$('close-nav-menu').addEventListener('click', () => {
	$('nav-menu').style.top = '-25em'
	$('hamburger-container').style.opacity = 0.9
    openedNav = false
})

window.onscroll = () => {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		$('logo-clothing').style.opacity = 0
		$('logo-clothing').style.display = 'none'
		$('hamburger-container').classList.add('hamburger-down')
    } else {
		$('logo-clothing').style.opacity = 1
		$('hamburger-container').classList.remove('hamburger-down')
		setTimeout(() => $('logo-clothing').style.display = 'block', 250)
    }
}

let imagesObj = {
	fileInput: $("multiple-src-image"),
	defaultImgPath: '/storage/img/clothes/default.jpg',
	readers: [
		new FileReader(),
		new FileReader(),
		new FileReader(),
		new FileReader(),
		new FileReader()
	],
	imgWithNumber: (num) => $("target-image" + num),
	filesNotEqualNull: () => $("multiple-src-image").files.length <= 0 ? false : true,
}

if ($("multiple-src-image")) {
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
	target: $("target-image"),
	src: $("src-image"),
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

if ($('prevent-double-submitting')) {
	$('prevent-double-submitting').addEventListener('submit', function () {
		$('submit-button').disabled = true
	})
}