<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8">Alternatives:</h1>
        <table id="alternatives-list" class="mb-4 table-auto w-full bg-white shadow rounded-lg hidden">
            <thead class="border border-gray-300">
                <th class="px-4 py-2 bg-indigo-600 text-white">Nama</th>
                <th class="px-4 py-2 bg-indigo-600 text-white">Bayaran</th>
                <th class="px-4 py-2 bg-indigo-600 text-white">Jarak</th>
                <th class="px-4 py-2 bg-indigo-600 text-white">Durasi Kerja (per hari)</th>
                <th class="px-4 py-2 bg-indigo-600 text-white">Biaya Transport</th>
            </thead>
        </table>

        <!-- Add New Alternative button -->
        <select name="alternatives-selector" id="alternatives-selector" class="w-full mr-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" onchange="toggleNewAlternative(this)">
            <option value="none" disabled selected>Select an alternative or create a new one</option>
            <option value="NewItem">Add New Item</option>
            <?php foreach($internships as $internship):?>
                <option value=<?=$internship['inter_id']?>><?= $internship['internship_name']?></option>
                
                <?php endforeach;?>
        </select>

        <!-- New alternative input (hidden by default) -->
        <div id="new-alternative-container" class="hidden">

            <div class="mt-2">
                <input type="text" id="alternative-name-input" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Alternative Name">
            </div>

            <div class="mt-1">
                <input type="number" id="alternative-criteria-salary" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Bayaran (Per Bulan)">
            </div>
            <div class="mt-1">
                <input type="number" id="alternative-criteria-distance" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Perkiraan Jarak">
            </div>
            <div class="mt-1">
                <input type="number" id="alternative-criteria-workhour" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Jam Kerja per Hari">
            </div>
            <div class="mt-1">
                <input type="number" id="alternative-criteria-transportfee" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Perkiraan ongkos transportasi">
            </div>

        </div>
        <div class="mt-4">
            <button id="add-alternative-button" class="justify-center rounded-md bg-violet-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Alternative</button>

            <!-- Submit button -->
            <button id="submit-button" class="justify-center rounded-md bg-violet-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </div>
    </div>
</body>

</html>
<!-- JavaScript code -->
<script>
    // Get DOM elements
    var inputted = false;
    const newAlternativeContainer = document.getElementById('new-alternative-container');
    const alternativeNameInput = document.getElementById('alternative-name-input');
    const alternativeCriteriaSalary = document.getElementById('alternative-criteria-salary');
    const alternativeCriteriaDistance = document.getElementById('alternative-criteria-distance');
    const alternativeCriteriaWorkhour = document.getElementById('alternative-criteria-workhour');
    const alternativeCriteriaTransport = document.getElementById('alternative-criteria-transportfee');
    const alternativesList = document.getElementById('alternatives-list');
    const selectElem = document.getElementById('alternatives-selector');

    function toggleNewAlternative(selectElement) {
        if (selectElement.value == 'NewItem') {
            newAlternativeContainer.classList.remove('hidden');
        } else {
            newAlternativeContainer.classList.add('hidden');
        }
    }

    const altDatas = {
        newAlts: [],
        existingAlts: [

        ]
    }

    // Add new alternative to the list
    document.getElementById('add-alternative-button').addEventListener('click', () => {
        if (inputted == false) {
            alternativesList.classList.remove('hidden');
            inputted = true;
        }
        if (selectElem.value == 'NewItem') {
            const altName = alternativeNameInput.value;
            const altSalary = alternativeCriteriaSalary.value == "" || null ? 0 : alternativeCriteriaSalary.value;
            const altDistance = alternativeCriteriaDistance.value == "" || null ? 0 : alternativeCriteriaDistance.value;
            const altWorkhour = alternativeCriteriaWorkhour.value == "" || null ? 0 : alternativeCriteriaWorkhour.value;
            const altTransport = alternativeCriteriaTransport.value == "" || null ? 0 : alternativeCriteriaTransport.value;
            altDatas.newAlts.push({
                name: altName,
                salary: altSalary,
                distance: altDistance,
                workhour: altWorkhour,
                transport: altTransport
            })



            // Add the new alternative to the list
            const newAlt = document.createElement('tr');
            newAlt.innerHTML =
                `<td>${altName}</td>
            <td>Rp${altSalary}</td>
            <td>${altDistance} km</td>
            <td>${altWorkhour} jam per hari</td>
            <td>Rp${altTransport}</td>
            `;
            alternativesList.appendChild(newAlt);

            // Clear the input fields
            alternativeNameInput.value = "";
            alternativeCriteriaSalary.value = "";
            alternativeCriteriaDistance.value = "";
            alternativeCriteriaWorkhour.value = "";
            alternativeCriteriaTransport.value = "";

        }
        else{
            var id = selectElem.value;
            altDatas.existingAlts.push(id);

            var data = "";

            var altName = "";
            var altSalary = 0;
            var altDistance = 0;
            var altWorkHour = 0;
            var altTransport = 0;
            fetch(`/internship/getInternshipById/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Use the fetched data to populate the table
                    altName = data.name;
                    altSalary = data.salary;
                    altDistance = data.distance;
                    altWorkHour = data.work_hour;
                    altTransport = data.transport_fee;
                    const newAlt = document.createElement('tr');
                    newAlt.innerHTML =
                        `<td>${altName}</td>
                    <td>Rp${altSalary}</td>
                    <td>${altDistance} km</td>
                    <td>${altWorkHour} jam per hari</td>
                    <td>Rp${altTransport}</td>
                    `;
                    alternativesList.appendChild(newAlt);
                })
                .catch(error => {
                    console.error('Error fetching internship data:', error);
                    alert("failed to get the data");
                });


        }


    });
    document.getElementById('submit-button').addEventListener('click', () => {
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
                    response.json().then(
                        data => {
                            window.location.href = "spk/result/" + data.data;
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
