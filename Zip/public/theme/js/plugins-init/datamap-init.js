(function ($) {
    "use strict"


/*******************
Datamap
*******************/

    const map = new Datamap( {
        scope: "world", 
        element: document.getElementById("world-datamap"), 
        responsive: !0, 
        geographyConfig: {
            popupOnHover: !1, 
            highlightOnHover: !1, 
            borderColor: "transparent", 
            borderWidth: 1, 
            highlightBorderWidth: 3, 
            highlightFillColor: "rgba(0,123,255,0.5)", 
            highlightBorderColor: "rgba(255,255,255,0.1)", 
            borderWidth: 1
        }
        , bubblesConfig: {
            popupTemplate: function (e, i) {
                return '<div class="datamap-sales-hover-tooltip">' + i.country + '<span class="m-l-5"></span> ' + i.sold + "</div>"
            }, 
            borderWidth: 0, 
            highlightBorderWidth: 0, 
            highlightFillColor: "rgb(255, 255, 255)", 
            highlightBorderColor: "rgb(255, 255, 255)", 
            fillOpacity: .75
        }
        , fills: {
            Visited: "#f5f5f5", 
            neato: "rgba(0,123,255,1)", 
            white: "rgb(255, 255, 255)", 
            defaultFill: "#EBEFF2"
        }
    });
    
    map.bubbles([ {
        centered: "USA", fillKey: "white", radius: 5, sold: "$500", country: "United States"
    }
    , {
        centered: "SAU", fillKey: "white", radius: 5, sold: "$900", country: "Saudia Arabia"
    }
    , {
        centered: "RUS", fillKey: "white", radius: 5, sold: "$250", country: "Russia"
    }
    , {
        centered: "CAN", fillKey: "white", radius: 5, sold: "$1000", country: "Canada"
    }
    , {
        centered: "IND", fillKey: "white", radius: 5, sold: "$50", country: "India"
    }
    , {
        centered: "AUS", fillKey: "white", radius: 5, sold: "$700", country: "Australia"
    }
    , {
        centered: "BGD", fillKey: "white", radius: 5, sold: "$1500", country: "Bangladesh"
    }
    ]),

    window.addEventListener("resize", function (e) {
        map.resize();
    });
    


})(jQuery);