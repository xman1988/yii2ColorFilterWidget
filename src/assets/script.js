(async () => {
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    let originalImage = await loadImage(settings.location);
    const mouse = getMouse(canvas);
    let image = originalImage;

    canvas.width = settings.width;
    canvas.height = settings.height;


    const imageParams = {
        offsetX: 0,
        offsetY: 0,
        scale: 1
    };

    const filters = {
        gray: false,
        red: false,
        green: false,
        blue: false,
        white: false
    };

    canvasUpdate();


    function canvasUpdate(time) {
        requestAnimationFrame(canvasUpdate);

        if (mouse.left) {
            imageParams.offsetX = mouse.dx + imageParams.offsetX;
            imageParams.offsetY = mouse.dy + imageParams.offsetY;
        }

        if (mouse.wheel) {
            if (imageParams.scale >= 0.01) {
                imageParams.scale += mouse.wheel * 0.025;
            } else {
                imageParams.scale = 1;
            }
        }

        imageParams.offsetX = Math.max(Math.min(0, imageParams.offsetX), canvas.width - image.width * Math.abs(imageParams.scale));
        imageParams.offsetY = Math.max(Math.min(0, imageParams.offsetY), canvas.height - image.height * Math.abs(imageParams.scale));
        clearCanvas();

        context.drawImage(
            image,
            0, 0, image.width, image.height,
            imageParams.offsetX, imageParams.offsetY, image.width * imageParams.scale, image.height * imageParams.scale
        );


        mouse.update();
    }

    function clearCanvas() {
        canvas.width = canvas.width;
    }

    if (settings.filterGrey) {
        const filterGrayElement = document.getElementById('filterGray');
        filterGrayElement.addEventListener('change', () => {
            filters.gray = filterGrayElement.checked;
            filterChangeHandler()
        });
    }

    if (settings.filterRed) {
        const filterRedElement = document.getElementById('filterRed');
        filterRedElement.addEventListener('change', () => {
            filters.red = filterRedElement.checked;
            filterChangeHandler()
        });
    }
    if (settings.filterGreen) {
        const filterGreenElement = document.getElementById('filterGreen');
        filterGreenElement.addEventListener('change', () => {
            filters.green = filterGreenElement.checked;
            filterChangeHandler()
        });
    }
    if (settings.filterBlue) {
        const filterBlueElement = document.getElementById('filterBlue');
        filterBlueElement.addEventListener('change', () => {
            filters.blue = filterBlueElement.checked;
            filterChangeHandler()
        });
    }

    function filterChangeHandler() {
        if (!filters.gray && !filters.blue && !filters.red && !filters.green) {
            return image = originalImage
        }

        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = originalImage.width;
        canvas.height = originalImage.height;
        context.drawImage(
            originalImage,
            0, 0, originalImage.width, originalImage.height,
            0, 0, canvas.width, canvas.height
        );
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

        if (filters.gray) {
            for (let i = 0; i < imageData.data.length; i += 4) {
                const average = (imageData.data[i] + imageData.data[i + 1] + imageData.data[i + 2]) / 3;
                imageData.data[i] = average;
                imageData.data[i + 1] = average;
                imageData.data[i + 2] = average;
            }
        } else {
            for (let i = 0; i < imageData.data.length; i += 4) {
                imageData.data[i] = filters.red ? 0 : imageData.data[i];
                imageData.data[i + 1] = filters.green ? 0 : imageData.data[i + 1];
                imageData.data[i + 2] = filters.blue ? 0 : imageData.data[i + 2];
            }
        }

        context.putImageData(imageData, 0, 0, 0, 0, imageData.width, imageData.height);
        image = canvas;
    }

    const loadImageElement = document.getElementById('loadImage');
    loadImageElement.addEventListener('change', async event => {
        const file = loadImageElement.files[0];
        const base64 = await getBase64(file);
        const image = new Image();
        image.onload = () => {
            originalImage = image;
            filterChangeHandler();
        };
        image.src = base64
    });

    document.getElementById('download').addEventListener('click', () => {
        const aElement = document.createElement('a');
        aElement.setAttribute('download', "myImage.jpg");
        aElement.href = canvas.toDataURL("image/jpg");
        aElement.click();
    });

    function getBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    }
})();
