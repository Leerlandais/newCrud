const message = document.getElementById("message");
const markerHop = document.querySelectorAll("markerHop")
const URL_SearchParams = new URLSearchParams(window.location.search);
searchLat = URL_SearchParams.get("lat");
searchLong = URL_SearchParams.get("long");

const map = L.map('mapCard').setView([51.505, -0.09], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


var responseClone; // 1
fetch("../control/json.control.php")
.then(function (response) {
    responseClone = response.clone(); // 2
    return response.json();
})
.then(function (data) {
    // Do something with data
}, function (rejectionReason) { // 3
    console.log('Error parsing JSON from response:', rejectionReason, responseClone); // 4
    responseClone.text() // 5
    .then(function (bodyText) {
        console.log('Received the following instead of valid JSON:', bodyText); // 6
    });
});
/*

fetch("../control/json.control.php")
    .then(function(response){
        
        response.json().then(function(data){
            console.log(data);
           afficheMarqueurs(data);
            afficheListe(data);
        });
    })
    .catch(function(error){
        console.log(error.message);
    });

    /*
for (let i = 0; i = markerHop.length; i++) {
    markerHop[i].addEventListener('click', function (){
        map.flyTo([searchLat,searchLong],7);
    });
}
const liste = {
    // HERE YOU NEED TO DO SOME JSON AND GET THE MARKER FOR EACH USER
    "House" :{"lat":searchLat,"lng":searchLong}
};
const liste = {
    "Studios Abbey Road" : {"lat":51.531988,"lng":-0.178226},
    "Palais de Buckingham" : {"lat":51.500835,"lng":-0.143004},
    "Trafalgar Square" : {"lat":51.508037,"lng":-0.128049},
    "British Museum" : {"lat":51.519294,"lng":-0.128018},
    "Test" : {"lat":48.519294,"lng":-0.128018}
};
*/

const markerTable = [];

function afficheMarqueurs(liste){
    /* Boucle pour créer les marqueurs de la liste */
    for (let item in liste){
        /* créer un marqueur pour chaque élément de la liste */
        let unMarqueur = L.marker([liste[item].map_lat, liste[item].map_long]).addTo(map);
        /* mettre le nom de l'item dans un popup */
        unMarqueur.bindPopup(`<h3>${liste[item].map_name}</h3>`);

        /* ajouter ce marqueur au tableau */
        markerTable.push(unMarqueur);
    }

/* placer le tableau de marqueurs dans le featureGroup */
const groupe = new L.featureGroup(markerTable);

/* adapter l'affichage de ma carte en fonction de la position des marqueurs */
map.fitBounds(groupe.getBounds(),{padding:[10,10]});
}

function afficheListe(liste){
    const divliste = document.getElementById("liste");

    const UL = document.createElement("ul");

    liste.forEach(function(item,index){
        // créer l'élément de type <li>
        let LI = document.createElement("li");
        // remplir le <li>
        LI.innerHTML = `${item.map_name}`;
        // ajouter un eventListener sur le clic
        LI.addEventListener('click', itemClick);
        // ajouter un attribut à cet item LI pour l'identifier
        LI.setAttribute("id",`${item.map_id}`);
        // ajouter des attributs à cet item LI pour stocker les coordonnées
        LI.setAttribute("latitude",`${item.map_lat}`);
        LI.setAttribute("longitude",`${item.map_long}`);
        // attacher ce <li> au <ul>
        UL.appendChild(LI);
    });

    // attacher la liste <ul> au DIV
    divliste.appendChild(UL);
}

function itemClick(){
    let id = this.getAttribute("id");
    let latitude = this.getAttribute("latitude");
    let longitude = this.getAttribute("longitude");

    console.log('item cliqué : ' + id);

    let marqueur = markerTable[id-1];
    marqueur.togglePopup();
    map.flyTo([latitude,longitude],17);
}
