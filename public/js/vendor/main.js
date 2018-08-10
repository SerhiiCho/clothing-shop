// Shortcut functions
function $(el) {
	return document.getElementById(el);
}

var openedNav = false;

// After page has been loaded, it will
// remove the loading animation
window.onload = function () {
	$('loading').classList.remove("loading");
	$('loading-title').innerHTML = '';
};

// Submit logout form after clicking #logout-btn
if ($('logout-btn')) {
	$('logout-btn').addEventListener('click', function (e) {
		e.preventDefault();
		$('logout-form').submit();
	});
}

$('hamburger').addEventListener('click', function () {
	$('nav-menu').style.top = 0;
	$('hamburger-container').style.opacity = 0;
	openedNav = true;
});

$('close-nav-menu').addEventListener('click', function () {
	$('nav-menu').style.top = '-25em';
	$('hamburger-container').style.opacity = 0.9;
	openedNav = false;
});

window.onscroll = function () {
	if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		$('logo-clothing').style.opacity = 0;
		$('logo-clothing').style.display = 'none';
		$('hamburger-container').classList.add('hamburger-down');
	} else {
		$('logo-clothing').style.opacity = 1;
		$('hamburger-container').classList.remove('hamburger-down');
		setTimeout(function () {
			return $('logo-clothing').style.display = 'block';
		}, 250);
	}
};

var imagesObj = {
	fileInput: $("multiple-src-image"),
	defaultImgPath: '/storage/img/clothes/default.jpg',
	readers: [new FileReader(), new FileReader(), new FileReader(), new FileReader(), new FileReader()],
	imgWithNumber: function imgWithNumber(num) {
		return $("target-image" + num);
	},
	filesNotEqualNull: function filesNotEqualNull() {
		return $("multiple-src-image").files.length <= 0 ? false : true;
	}
};

if ($("multiple-src-image")) {
	imagesObj.fileInput.addEventListener('change', function () {
		if (imagesObj.filesNotEqualNull()) {
			var _loop = function _loop(i, num) {
				if (imagesObj.fileInput.files[i]) {
					imagesObj.readers[i].readAsDataURL(imagesObj.fileInput.files[i]);
					imagesObj.readers[i].onload = function (e) {
						imagesObj.imgWithNumber(num).src = this.result;
					};
				} else {
					imagesObj.imgWithNumber(i).src = imagesObj.defaultImgPath;
				}
			};

			for (var i = 0, num = 1; i <= 5; i++, num++) {
				_loop(i, num);
			}
		} else {
			for (var i = 1; i <= 5; i++) {
				imagesObj.imgWithNumber(i).src = imagesObj.defaultImgPath;
			}
		}
	});
}

// This object auto updates pictures after
// selecting them via file input
var imageUploader = {
	target: $("target-image"),
	src: $("src-image"),
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

if ($('prevent-double-submitting')) {
	$('prevent-double-submitting').addEventListener('submit', function () {
		$('submit-button').disabled = true;
	});
}