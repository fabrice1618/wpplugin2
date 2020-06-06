
//1d81e23c-a6af-11ea-954a-0242ac130002-1d81e368-a6af-11ea-954a-0242ac130002

// 1: Object { lat: 43.4, lng: -1.68, name: "st jean de luz (socoa)", … }
// 0: Object { lat: 43.52, lng: 4.13, name: "port camargue", … }

// Fonction executee au moment du chargement de la page
window.onload = function(){
//    alert("Hello World");
//    getStation();
    getNiveau();
  }
  

  function getNiveau()
  {

    const lat = 43.4;
    const lng = -1.68;
    
    fetch(`https://api.stormglass.io/v2/tide/sea-level/point?lat=${lat}&lng=${lng}&start=2020-06-06&end=2020-06-07`, {
      headers: {
        'Authorization': '1d81e23c-a6af-11ea-954a-0242ac130002-1d81e368-a6af-11ea-954a-0242ac130002'
      }
    }).then((response) => response.json()).then((tideData) => {
//        console.log(tideData['data']);

        tideData['data'].forEach(function (item, index) {

            console.log(index);
            console.log(item);

            cellule = document.getElementById('niv'+index);
            cellule.textContent = item['sg'] + ' m';

        });


    });
  }

  function getStation()
  {

    fetch(`https://api.stormglass.io/v2/tide/stations/area?box=43.76,3.91:43.26,4.98`, {
        headers: {
          'Authorization': '1d81e23c-a6af-11ea-954a-0242ac130002-1d81e368-a6af-11ea-954a-0242ac130002'
        }
      }).then((response) => response.json()).then((jsonData) => {
        console.log(jsonData);
      });

  }