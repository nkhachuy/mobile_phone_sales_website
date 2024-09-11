const images = [
    './Images_Logo/titan-xanh.jpg',
    './Images_Logo/titan-xanh-1.jpg',
    './Images_Logo/titan-xanh-2.jpg',
    './Images_Logo/titan-xanh-3.jpg',
    './Images_Logo/thong-tin-san-pham.jpeg'
];

let currentIndex = 0;

function changeImage(imageSrc) {
    document.getElementById('mainImage').src = imageSrc;
    currentIndex = images.indexOf(imageSrc);
}

function prevImage() {
    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
    document.getElementById('mainImage').src = images[currentIndex];
}

function nextImage() {
    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
    document.getElementById('mainImage').src = images[currentIndex];
}