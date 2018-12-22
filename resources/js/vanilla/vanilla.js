(function SubmitLogoutFormAfterCliking() {
    let btn = document.getElementById('logout-btn')
    let form = document.getElementById('logout-form')

    if (btn) {
        btn.addEventListener('click', (e) => {
            e.preventDefault()
            form.submit()
        })
    }
})();

var openedNav = false;

(function ShowSidebarAfterClickHamburger() {
    let navMenu = document.getElementById('nav-menu')
    let hamburger = document.getElementById('hamburger-container')
    let closeNav = document.getElementById('close-nav-menu')

    hamburger.addEventListener('click', () => {
        navMenu.style.top = 0
        hamburger.style.opacity = 0
        openedNav = true
    })

    closeNav.addEventListener('click', () => {
        navMenu.style.top = '-25em'
        hamburger.style.opacity = 0.9
        openedNav = false
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

let imagesObj = {
    fileInput: document.getElementById("multiple-src-image"),
    defaultImgPath: '/storage/img/clothes/default.jpg',
    readers: [
        new FileReader(),
        new FileReader(),
        new FileReader(),
        new FileReader(),
        new FileReader()
    ],
    imgWithNumber: (num) => document.getElementById("target-image" + num),
    filesNotEqualNull: () => document.getElementById("multiple-src-image").files.length <= 0 ? false : true,
};

(function WatchInputChangeFromUpdatingImagePreview() {
    if (document.getElementById("multiple-src-image")) {
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
})();

/**
 * This object auto updates pictures after
 * selecting them via file input
 */
(function RunShowImageFunction() {
    let imageUploader = {
        target: document.getElementById("target-image"),
        src: document.getElementById("src-image"),
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
    };
    if (imageUploader.src && imageUploader.target) {
        imageUploader.showImage()
    }
})();

(function PreventDoubleSubmittingForms() {
    let btn = document.getElementById('submit-button')
    let form = document.getElementById('prevent-double-submitting')

    if (form) {
        form.addEventListener('submit', () => btn.disabled = true)
    }
})();