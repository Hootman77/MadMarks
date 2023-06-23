// Jason Milne - 27239398 - 10/06/2023 - Version 1.1 
//  Mad Marks gaming empiriom 

// Creating constants and attaching to the specific part in the HTML file
// by using document.query selector and referencing the tag used in
// the html

const searchInput = document.querySelector("[data-search]")
const outPut = document.querySelector("[output-container]")
const dataMovieTemplate = document.querySelector("[card-container]")

//Creating empty constants to be used later on
const data = ""
const desc = ""
const char = ""
const rating = ""



//Creating an input function to be called
function Input() {
    //inputVal will be set to the value of the data entered into the input field
    const inputVal = document.getElementById("search").value;
    //The data will then be set to lowercase to ensure no issues
    const inputVal2 = inputVal.toLowerCase()
   
    //creating a variable called url with the value of the api link
    var url = "http://madmark.altervista.org/index.php";
    //Creating a variable called headers with the value of the headers
    var headers = {
        "Accept": "application/json",
        "Content-Type": "application/json"
    };
    //Creating a variable called data, which will store the values
    //In this case setting the data that will be sent to php to
    //the variable NAME
    var Data = {
        NAME: inputVal2

    }
    //Calling the fetch function send a GET request to the url with the data mentioned above
    fetch(url, {
        //Using the POST method to send the input data
        method: "POST",
        headers: headers,
        //Stringing the data in json format
        body: JSON.stringify(Data)
        //Taking the result and stinging into json format
    }).then((res) => res.json())
    //Taking that new result and using the built in map function 
    //To display the results of said data on the page
    .then(res => {
        //Creating a variable ids and equallign it to the results from the map function
        //by referencing the ids from the result data
        ids = res.map(id => {
            //Creating a card constant while will clone the html template to populate
            //as many results as the result returns
            const card = dataMovieTemplate.content.cloneNode(true).children[0]
            //Inputing the data from each result into each template
            const output1 = card.querySelector("[output-1]")
            //Including the text which will be adding to the output on the page
            output1.textContent = id.NAME + " on the " + id.Platform + " with the main character " + id.Main_Char + " and a rating of " + id.Rating
            //Appending the card with the new information
            outPut.append(card)
            //Returning the values that were recieved
            return { NAME: id.NAME, Platform: id.Platform, Main_Char: id.Main_Char, Rating: id.Rating, element: card}

        })
        //Catching any errors and printing them in the console
}).catch(console.error);
}
