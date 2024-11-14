// Array of image URLs (replace with actual URLs or paths to your images)
const images = [
    'Haus.jpg',
    'image2.jpg',
    'image3.jpg',
    'image4.jpg',
    'image5.jpg',
    'image6.jpg',
    'image7.jpg'
];

let currentIndex = 0;

const propertyImage = document.getElementById('property-image');
const imageCounter = document.getElementById('image-counter');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');

// Function to update the displayed image and counter
function updateImage() {
    propertyImage.src = images[currentIndex];
    imageCounter.textContent = `${currentIndex + 1}/${images.length}`;
}

// Event listeners for navigation buttons
prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
    updateImage();
});

nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
    updateImage();
});

// Initialize the carousel
updateImage();