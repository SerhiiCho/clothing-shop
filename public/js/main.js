// Shortcut functions
function id(el) {
	return document.getElementById(el);
}

var openedNav = false;

// After page has been loaded, it will
// remove the loading animation
window.onload = function () {
	id('loading').classList.remove("loading");
	id('loading-title').innerHTML = '';
};

id('hamburger').addEventListener('click', function () {
	id('nav-menu').style.top = 0;
	id('hamburger-container').style.opacity = 0;
	openedNav = true;
});

id('close-nav-menu').addEventListener('click', function () {
	id('nav-menu').style.top = '-25em';
	id('hamburger-container').style.opacity = 0.9;
	openedNav = false;
});

window.onscroll = function () {
	if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		id('logo-clothing').style.opacity = 0;
		id('logo-clothing').style.display = 'none';
		id('hamburger-container').classList.add('hamburger-down');
	} else {
		id('logo-clothing').style.opacity = 1;
		id('hamburger-container').classList.remove('hamburger-down');
		setTimeout(function () {
			return id('logo-clothing').style.display = 'block';
		}, 250);
	}
};

// This function auto updates pictures after
// selecting them via file input
if (id("multiple-src-image")) {
	(function showImages() {

		// For every image, we create FileReader object
		var src = id("multiple-src-image");
		var readers = [new FileReader(), new FileReader(), new FileReader(), new FileReader(), new FileReader()];

		// Listen to file input
		src.addEventListener("change", function () {
			if (src.files.length !== 0) {
				var _loop = function _loop(i, num) {
					if (src.files[i]) {
						readers[i].readAsDataURL(src.files[i]);
						readers[i].onload = function (e) {
							id("target-image" + num).src = this.result;
						};
					} else {
						id("target-image" + num).src = '/storage/img/clothes/default.jpg';
					}
				};

				// For every image on the page we set fake url of the choosen photo
				// Otherwice we will set the photo with default pic
				for (var i = 0, num = 1; i < readers.length; i++, num++) {
					_loop(i, num);
				}
			} else {
				for (var i = 1; i <= 5; i++) {
					id("target-image" + i).src = '/storage/img/clothes/default.jpg';
				}
			}
		});
	})();
}

// This object auto updates pictures after
// selecting them via file input
var imageUploader = {
	target: id("target-image"),
	src: id("src-image"),
	fr: new FileReader(),
	showImage: function showImage() {
		var _this = this;

		this.src.addEventListener("change", function () {
			if (_this.src.files.length !== 0) {
				var that = _this;
				_this.fr.readAsDataURL(_this.src.files[0]);
				_this.fr.onload = function (e) {
					that.target.src = this.result;
				};
			} else {
				_this.target.src = '/storage/img/clothes/default.jpg';
			}
		});
	}

	// Run showImage function
};if (imageUploader.src && imageUploader.target) {
	imageUploader.showImage();
}

if (id('prevent-double-submitting')) {
	id('prevent-double-submitting').addEventListener('submit', function () {
		id('submit-button').disabled = true;
	});
}