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


for (let i = 0; i = markerHop.length; i++) {
    markerHop[i].addEventListener('click', function (){
        map.flyTo([searchLat,searchLong],7);
    });
}

const liste = {
// HERE YOU NEED TO DO SOME JSON AND GET THE MARKER FOR EACH USER
    "House" :{"lat":searchLat,"lng":searchLong}
};



const markers = L.markerClusterGroup();

const markerTable = [];


for (let item in liste) {
let unMarqueur = L.marker([liste[item].lat, liste[item].lng]).addTo(map);

unMarqueur.bindPopup(item);
markers.addLayer(unMarqueur);
markerTable.push(unMarqueur);
}

map.addLayer(markers);

const groupe = new L.featureGroup(markerTable);

map.fitBounds(groupe.getBounds(), {padding:[10,10]});
