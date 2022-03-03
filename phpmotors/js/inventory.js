//tells the JavaScript parser to follow all rules strictly.
'use strict'

// Get a list of vehicles in inventory based on the classificationId 

//Finds the classification select element in the vehicle management page based on its ID and stores its reference into a local JavaScript variable.
let classificationList = document.querySelector("#classificationList");
//Attaches the eventListener to the variable representing the classification select element and listens for any "change". When a change occurs an anonymous function is executed.
classificationList.addEventListener("change", function () {
    // Captures the new value from the classification select element and stores it into a JavaScript variable.
    let classificationId = classificationList.value;
    //Writes the value as part of a string to the console log for testing purposes. Note that the text is surrounded by "ticks", not single quotes. The "tick" key is to the left of the 1 on your keyboard. Text that is surrounded by ticks is known as a JavaScript template literal. 
    console.log(`classificationId is: ${classificationId}`);
    //URL used to request inventory data from the vehicles controller
    let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;
    //Fetch (initiating an AJAX request)
    fetch(classIdURL)
    //"then" method that waits for data to be returned from the fetch
        .then(function (response) {
            //"if" test to see if the response was retuned successfully. 
            if (response.ok) {
                //If the response was successful, then the JSON object that was returned is converted to a JavaScript object and passed on
                return response.json();
            }
            //If not, this error occurs.
            throw Error("Network response was not OK");
        })
        //Accepts the JavaScript object and passes it as a parameter
        .then(function (data) {
            //send the JavaScript object to the console log for testing purposes
            console.log(data);
            //Sends the JavaScript object to a new function that will parse the data into HTML table elements and inject them into the vehicle management view
            buildInventoryList(data);
        })
        //"catch" which captures any errors and sends them into an anonymous function.
        .catch(function (error) {
            // Writes the caught error to the console log for us to see for troubleshooting
            console.log('There was a problem: ', error.message)
        })
})

// Build inventory items into HTML table components and inject into DOM 
function buildInventoryList(data) { 
    let inventoryDisplay = document.getElementById("inventoryDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
     console.log(element.invId + ", " + element.invModel); 
     dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable; 
   }