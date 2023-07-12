<h2>Alternatives:</h2>
<ul id="alternatives-list">
    <!-- Existing alternatives will be dynamically added here -->
</ul>

<!-- Add New Alternative button -->
<select name="alternatives-selector" id="alternatives-selector" class="w-full mr-2" onchange="toggleNewAlternative(this)">
    <option value="" disabled selected>Select an alternative or create a new one</option>
    <option value="NewItem">Add New Item</option>
    <option value="Alt1">Alt A</option>
</select>

<!-- New alternative input (hidden by default) -->
<div id="new-alternative-container" style="display: none;">
    <input type="text" id="alternative-name-input" placeholder="Alternative Name">
    <input type="number" id="alternative-criteria-salary" placeholder="Bayaran (Per Bulan)">
    <input type="number" id="alternative-criteria-distance" placeholder="Perkiraan Jarak">
    <input type="number" id="alternative-criteria-workhour" placeholder="Jam Kerja per Hari">
    <input type="number" id="alternative-criteria-transportfee" placeholder="Perkiraan ongkos transportasi">
</div>
<button id="add-alternative-button">Add Alternative</button>

<!-- Submit button -->
<button id="submit-button">Submit</button>

<!-- JavaScript code -->
<script>
    // Get DOM elements
    const newAlternativeContainer = document.getElementById('new-alternative-container');
    const alternativeNameInput = document.getElementById('alternative-name-input');
    const alternativeCriteriaSalary = document.getElementById('alternative-criteria-salary');
    const alternativeCriteriaDistance = document.getElementById('alternative-criteria-distance');
    const alternativeCriteriaWorkhour = document.getElementById('alternative-criteria-workhour');
    const alternativeCriteriaTransport= document.getElementById('alternative-criteria-transportfee');
    const alternativesList = document.getElementById('alternatives-list');
    const selectElem = document.getElementById('alternatives-selector');

    function toggleNewAlternative(selectElement) {
        if(selectElement.value == 'NewItem'){
            newAlternativeContainer.style.display = 'block';
        }else{
            newAlternativeContainer.style.display = 'none';
        }
    }

    const altDatas = {
        newAlts: [
        ],
        existingAlts:[

        ]
    }

    // Add new alternative to the list
    document.getElementById('add-alternative-button').addEventListener('click', () => {
        if(selectElem.value == 'NewItem'){
            const altName = alternativeNameInput.value;
            const altSalary = alternativeCriteriaSalary.value;
            const altDistance = alternativeCriteriaDistance.value;
            const altWorkhour = alternativeCriteriaWorkhour.value;
            const altTransport = alternativeCriteriaTransport.value;
            altDatas.newAlts.push({name: altName, salary: altSalary, distance: altDistance, workhour:altWorkhour, transport:altTransport})



            // Add the new alternative to the list
            const newAlt = document.createElement('li');
            newAlt.innerText = 
            `~${altName}~
            Pendapatan: Rp${altSalary}
            Jarak: ${altDistance} km
            Jam Kerja: ${altWorkhour} jam per hari
            Ongkos Transportasi: Rp${altSalary}
            `;
            alternativesList.appendChild(newAlt);

            // Clear the input fields
            alternativeNameInput.value = "";
            alternativeCriteriaSalary.value = "";
            alternativeCriteriaDistance.value = "";
            alternativeCriteriaWorkhour.value = "";
            alternativeCriteriaTransport.value = "";

        }

        
    });
    document.getElementById('submit-button').addEventListener('click', () => {
        alert(JSON.stringify(altDatas));
        fetch('/spk/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(altDatas)
            })
            .then(response => {
                // Handle the response from the server
                if (response.ok) {
                    alert("Server Received Data!");
                    response.json().then(
                        data=>{
                            alert(data.data)
                            window.location.href = "spk/result/"+data.calcID;
                        }
                        
                    );
                    
                } else {
                throw new Error('Error: ' + response.statusText);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error)
            });
    });
</script>