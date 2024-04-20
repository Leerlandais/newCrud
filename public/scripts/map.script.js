const message = document.getElementById("message");

const map = L.map('mapCard').setView([51.505, -0.09], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


const liste = {
    /*
    "Studios Abbey Road" : {"lat":51.531988,"lng":-0.178226},
    "Palais de Buckingham" : {"lat":51.500835,"lng":-0.143004},
    "Trafalgar Square" : {"lat":51.508037,"lng":-0.128049},
    "British Museum" : {"lat":51.519294,"lng":-0.128018},
    "Test" : {"lat":48.519294,"lng":-0.128018}
    */
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
