<h2>Alternatives:</h2>
<ul id="alternatives-list">
    <!-- Existing alternatives will be dynamically added here -->
</ul>

<!-- Add New Alternative button -->
<button id="add-new-button">Add New Alternative</button>

<!-- New alternative input (hidden by default) -->
<div id="new-alternative-container" style="display: none;">
    <input type="text" id="alternative-name-input" placeholder="Alternative Name">
    <input type="number" id="alternative-criteria-input" placeholder="Criteria Score">
    <button id="add-alternative-button">Add Alternative</button>
</div>

<!-- Submit button -->
<button id="submit-button">Submit</button>

<!-- JavaScript code -->
<script>
    // Get DOM elements
    const addNewButton = document.getElementById('add-new-button');
    const newAlternativeContainer = document.getElementById('new-alternative-container');
    const alternativeNameInput = document.getElementById('alternative-name-input');
    const alternativeCriteriaInput = document.getElementById('alternative-criteria-input');
    const alternativesList = document.getElementById('alternatives-list');

    // Show/hide new alternative container
    addNewButton.addEventListener('click', () => {
        newAlternativeContainer.style.display = 'block';
    });

    // Add new alternative to the list
    document.getElementById('add-alternative-button').addEventListener('click', () => {
        const alternativeName = alternativeNameInput.value;
        const alternativeCriteria = alternativeCriteriaInput.value;

        // Perform validation here if needed

        // Add the new alternative to the list
        const newAlternative = document.createElement('li');
        newAlternative.innerText = `${alternativeName} - ${alternativeCriteria}`;
        alternativesList.appendChild(newAlternative);

        // Clear the input fields
        alternativeNameInput.value = '';
        alternativeCriteriaInput.value = '';

        // Hide the new alternative container
        newAlternativeContainer.style.display = 'none';

        
    });
    document.getElementById('submit-button').addEventListener('click', () => {
        const alternatives = [];

        // Collect alternatives from the list
        const alternativeItems = document.querySelectorAll('#alternatives-list li');
        alternativeItems.forEach(item => {
            const [name, criteria] = item.innerText.split(' - ');
            alternatives.push({ name, criteria });
        });

        // Send the data to the server-side for further processing
        fetch('/alternatives/submit', {
            method: 'POST',
            body: JSON.stringify({ alternatives }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Redirect to the next page with the submitted data
            window.location.href = '/inputspk?data=' + encodeURIComponent(JSON.stringify(data));
        });
    });
</script>