// Get buttons and table containers
const usersBtn = document.getElementById("users-btn");
const propertiesBtn = document.getElementById("properties-btn");
const usersTable = document.getElementById("users-table");
const propertiesTable = document.getElementById("properties-table");
let currentState = "user";

// Add event listeners
usersBtn.addEventListener("click", () => {
    usersTable.classList.remove("hidden");
    propertiesTable.classList.add("hidden");
    usersBtn.classList.add("active");
    propertiesBtn.classList.remove("active");
    currentState = "user";
});

propertiesBtn.addEventListener("click", () => {
    propertiesTable.classList.remove("hidden");
    usersTable.classList.add("hidden");
    propertiesBtn.classList.add("active");
    usersBtn.classList.remove("active");
    currentState = "property";
});

// Default view
usersBtn.click();

document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr');
        const isEditing = row.classList.contains('editing');

        if (!isEditing) {
            // Switch to edit mode
            row.classList.add('editing');
            this.textContent = 'Save';
            this.style.backgroundColor = "green";
            row.querySelectorAll('[data-editable="true"]').forEach(cell => {
                const currentValue = cell.textContent.trim();
                cell.innerHTML = `<input type="text" value="${currentValue}" />`;
            });
        } else {
            // Save changes
            row.classList.remove('editing');
            this.textContent = 'Edit';
            this.style.backgroundColor = "#FFBF0C";

            // Collect updated values
            const updatedData = {};
            row.querySelectorAll('[data-editable="true"]').forEach(cell => {
                const input = cell.querySelector('input');
                const newValue = input.value.trim();
                const columnName = input.closest('td').dataset.column; // Set a data-column attribute to cells for mapping
                updatedData[columnName] = newValue;
                console.log(columnName+newValue);
                // Replace input with plain text
                cell.textContent = newValue;
            }); 

            // Send updated data to backend
            const userId = row.querySelector('td:first-child').textContent.trim(); // Assuming the first column is User_ID
            const propertyId = row.querySelector('td:first-child').textContent.trim(); 

            let info = {};
            if (currentState === "user") {
                info = { User_ID: userId, ...updatedData, editType: 'user' };
            } else {
                info = { Property_ID: propertyId, ...updatedData, editType: 'property' };
            }
            fetch('http://localhost/Reserve/backend/adminupdate.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(info),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User updated successfully!');
                    console.log(data.type);
                } else {
                    alert(`Error updating ${currentState} 1`);
                    console.error('Error data:', data);
                    // console.log(data.success);
                    // console.log(data.error);
                    // console.log(data.debug);
                    // console.log({ User_ID: userId, ...updatedData });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(`Error updating ${currentState} 2`);
                console.log('Sending data to backend:', JSON.stringify(info));
            });
        }
    });
});

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr');
        const userId = row.querySelector('td:first-child').textContent.trim(); // Assuming the first column is User_ID
        const propertyId = row.querySelector('td:first-child').textContent.trim(); 

        let idtype = "";
        let id = "";
        if (currentState === "user") {
            idtype = "User_ID";
            id = userId;
        } else {
            idtype = "Property_ID";
            id = propertyId;
        }
        fetch('http://localhost/Reserve/backend/adminupdate.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({editType: 'delete', Table: currentState, IDType: idtype, ID: id}),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User delete successfully!');
                console.log(data.type);
            } else {
                alert(`Error deleting ${currentState} 1`);
                console.error('Error data:', data);
                // console.log(data.success);
                // console.log(data.error);
                // console.log(data.debug);
                // console.log({ User_ID: userId, ...updatedData });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(`Error deleting ${currentState} 2`);
            console.log('Sending data to backend:', JSON.stringify({editType: 'delete', Table: currentState, IDType: idtype, ID: id}));
        });
    });
});