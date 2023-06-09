/* slectionné ajouter */
const ajouter = document.querySelectorAll(".ajouter");

/* fonctions pour creer l'element */
function createElement(text, index) {
    const container = document.createElement("div");
    container.classList.add("resturantContainer");

    const deleteButton = document.createElement("div");
    deleteButton.innerText = "X";
    deleteButton.classList.add("deleteButton");
    deleteButton.id = index;


    const ele = document.createElement("p");
    ele.innerText = text;
    ele.classList.add("resturantName");

    container.appendChild(ele);
    container.appendChild(deleteButton);

    return container;
}

/* drop down de nouveau */
const nouveau = document.querySelectorAll(".nouveauText");
const continentForm = document.querySelectorAll(".continentForm");

nouveau.forEach((element, index) => {
    element.addEventListener("click", (e) => {
        continentForm[index].classList.toggle("hide");
    });
});

/* ajouter resturant */
let resturants = [];

const resturantInput = document.getElementById("Restaurant");
const resturantsObject = document.querySelector(".resturants");

console.log(ajouter);
ajouter[1].addEventListener("click", () => {
    resturants.push(resturantInput.value);
    resturantsObject.innerHTML = null;
    resturants.forEach((element, index) => {
        resturantsObject.appendChild(createElement(element, index));
    });
});

/* delete un resturant */

resturantsObject.addEventListener("click", (e) => {
    console.log(e.target.id);
    resturants.splice(e.target.id, 1);
    console.log(resturants);
    resturantsObject.innerHTML = null;
    resturants.forEach((element, index) => {
        resturantsObject.appendChild(createElement(element, index));
    });
})
