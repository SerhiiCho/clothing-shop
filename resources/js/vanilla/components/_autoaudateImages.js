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
    let sources = document.getElementById("multiple-src-image");

    if (sources) {
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