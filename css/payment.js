// Get references to the tabs and content sections
const creditTab = document.querySelector('.tab-container button:nth-child(1)');
const qrTab = document.querySelector('.tab-container button:nth-child(2)');
const creditFields = document.getElementById('credit-fields');
const qrImage = document.getElementById('qr-image');

// Function to show the Credit card fields
function showCredit() {
    creditTab.classList.add('active');
    qrTab.classList.remove('active');
    creditFields.style.display = 'block';
    qrImage.style.display = 'none';
    document.getElementById("selectedType").value = button.value;
}

// Function to show the QR code image
function showQR() {
    qrTab.classList.add('active');
    creditTab.classList.remove('active');
    creditFields.style.display = 'none';
    qrImage.style.display = 'block';
    document.getElementById("selectedType").value = button.value;
}
