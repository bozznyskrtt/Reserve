// Get buttons and table containers
const usersBtn = document.getElementById("users-btn");
const propertiesBtn = document.getElementById("properties-btn");
const usersTable = document.getElementById("users-table");
const propertiesTable = document.getElementById("properties-table");

// Add event listeners
usersBtn.addEventListener("click", () => {
    usersTable.classList.remove("hidden");
    propertiesTable.classList.add("hidden");
    usersBtn.classList.add("active");
    propertiesBtn.classList.remove("active");
});

propertiesBtn.addEventListener("click", () => {
    propertiesTable.classList.remove("hidden");
    usersTable.classList.add("hidden");
    propertiesBtn.classList.add("active");
    usersBtn.classList.remove("active");
});

// Default view
usersBtn.click();