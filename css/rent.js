// Array of image URLs (replace with actual URLs or paths to your images)
const params = new URLSearchParams(window.location.search);
const propertyId = params.get('property_id');
console.log(propertyId);
let currentIndex = 0;
const propertyImage = document.getElementById('property-image');
const imageCounter = document.getElementById('image-counter');
let Count = document.getElementById('count').value;
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');

console.log("image count = "+Count);
function getImageUrl(index) {
    return `http://localhost/Reserve/backend/get_image.php?property_id=${propertyId}&index=${index}`;
}

// Function to update the displayed image and counter
function updateImage() {
    propertyImage.src = getImageUrl(currentIndex);
    imageCounter.textContent = `${currentIndex + 1}/${Count}`;
    console.log(getImageUrl(currentIndex))
}

// Event listeners for navigation buttons
prevBtn.addEventListener('click', () => {
    if (currentIndex>0){
        currentIndex =  currentIndex - 1;
        console.log("currentIndex: "+currentIndex);
    }
    updateImage();
});

nextBtn.addEventListener('click', () => {
    if (currentIndex<Count-1){
        currentIndex =  currentIndex + 1;
        console.log("currentIndex: "+currentIndex)
    }
    updateImage();
});

// Initialize the carousel
updateImage();