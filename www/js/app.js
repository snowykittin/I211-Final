//for account details page
function openTab(tabName) {
    var i;
    var x = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(tabName).style.display = "block";
}

//transaction search AJAX
var xmlHttp;  //xmlhttprequest object
var base_url = "http://localhost:8080/I211-Final";
var numResults;
var transactionSuggestionDiv, transactionSearchBox;

//this function creates a XMLHttpRequest object. It should work with most types of browsers.
function createXmlHttpRequestObject() {
    // create a XMLHttpRequest object compatible to most browsers
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        alert("Error creating the XMLHttpRequest object.");
        return false;
    }
}

//initial actions to take when the page load
window.onload = function () {
    //create an XMLHttpRequest object by calling the createXmlHttpRequestObject function
    xmlHttp = createXmlHttpRequestObject();

    transactionSuggestionDiv = document.getElementById('transactionSuggestionDiv');
    transactionSearchBox = document.getElementById('transactionsearchbox');
    transactionSuggestionDiv.style.display = 'none';
};

//autosuggest transaction descriptions
function suggest_transactions(query, id){
    //if the search term is empty, clear the suggestion box.
    if (query === "") {
        transactionSuggestionDiv.innerHTML = "";
        return;
    }

    //proceed only if the search term isn't empty
    // open an asynchronous request to the server.
    xmlHttp.open("GET", base_url + "/account/suggest_transactions/?terms=" + query + "&id=" + id, true);

    //handle server's responses
    xmlHttp.onreadystatechange = function () {
        // proceed only if the transaction has completed and the transaction completed successfully
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            // extract the JSON received from the server
            var descriptions = JSON.parse(xmlHttp.responseText);

            // display suggested titles in a div block
            console.log(descriptions);
            displayDescriptions(descriptions);
        }
    };

    // make the request
    xmlHttp.send(null);
}

//this function populates the suggestion box
function displayDescriptions(description){
    numResults = description.length;

    if(numResults === 0){
        //hide all suggestions
        transactionSuggestionDiv.style.display = 'none';
        return false;
    }

    var divContent = ""
    //retrieve contents and create new span for each
    for (let i = 0; i < description.length; i++) {
        divContent += "<p id=s_" + i + " onclick='clickDescription(this)'>" + description[i] + "</p>";
        //display the spans in the div block
        transactionSuggestionDiv.innerHTML = divContent;
        transactionSuggestionDiv.style.display = 'block';
        transactionSuggestionDiv.style.backgroundColor = 'white';
    }
}

//This function handles keyup event. The function is called for every keystroke.
function transactionsKeyUp(e, id){
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    suggest_transactions(e.target.value, id);
}

//when a suggestion is clicked, fill the search box with the description and then hide the suggestion list
function clickDescription(description) {
    //display the title in the search box
    transactionSearchBox.value = description.innerHTML;

    //hide all suggestions
    transactionSuggestionDiv.style.display = 'none';
}


/*
REGISTER PAGE AJAX
 */
var citiesSuggestionDiv, cityInputBox;

//function for autosuggest on the register page
function registerCityKeyUp(e){
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    suggest_city(e.target.value);

}

//autosuggest transaction descriptions
function suggest_city(query){
    //if the search term is empty, clear the suggestion box.
    if (query === "") {
        citiesSuggestionDiv.innerHTML = "";
        return;
    }

    //proceed only if the search term isn't empty
    // open an asynchronous request to the server.
    xmlHttp.open("GET", base_url + "/user/suggest_cities/" + query, true);

    //handle server's responses
    xmlHttp.onreadystatechange = function () {
        // proceed only if the transaction has completed and the transaction completed successfully
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            // extract the JSON received from the server
            var cities = JSON.parse(xmlHttp.responseText);

            // display suggested titles in a div block
            displayCities(cities);
        }
    };

    // make the request
    xmlHttp.send(null);
}

//this function populates the suggestion box
function displayCities(cities){
    numResults = cities.length;

    if(numResults === 0){
        //hide all suggestions
        citiesSuggestionDiv.style.display = 'none';
        return false;
    }

    var divContent = ""
    //retrieve contents and create new span for each
    for (let i = 0; i < cities.length; i++) {
        divContent += "<p id=s_" + i + " onclick='clickCity(this)'>" + cities[i] + "</p>";
        //display the spans in the div block
        citiesSuggestionDiv.innerHTML = divContent;
        citiesSuggestionDiv.style.display = 'block';
        citiesSuggestionDiv.style.backgroundColor = 'white';
    }
}

function clickCity(city) {
    //display the city in the input box
    cityInputBox.value = city.innerHTML;

    //hide all suggestions
    citiesSuggestionDiv.style.display = 'none';
}