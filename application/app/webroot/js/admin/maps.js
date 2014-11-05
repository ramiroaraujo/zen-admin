var map;
var marker;


function initialize()
{
  var styles = [
    {
      "featureType": "poi",
      "stylers"    : [
        { "visibility": "off" }
      ]
    }
  ];
  var styledMap = new google.maps.StyledMapType( styles, {name: "Positivo"} );

  var options = {
    zoom                 : 2,
    center               : new google.maps.LatLng( 0, 0 ),
    streetViewControl    : false,
    mapTypeId            : google.maps.MapTypeId.ROADMAP,
    mapTypeControl       : false,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    },
    scrollwheel          : false
  };

  //sin ui para edición en views
  if ( mapType == 'viewMap' || mapType == 'viewMarker' )
  {
    options.disableDefaultUI = true;
    options.disableDoubleClickZoom = true;
    options.draggable = false;
    options.scrollwheel = false;
    options.panControl = false;
  }

  map = new google.maps.Map( document.getElementById( 'map' ), options );

  map.mapTypes.set( 'map_style', styledMap );
  map.setMapTypeId( 'map_style' );


  switch ( mapType )
  {
    //edición de mapa (pan y zoom), ajuste 2-vias de coordenadas y zoom contra inputs.
    case 'editMap':
      //escucha change event en mapa y actualiza inputs
      google.maps.event.addListener( map, 'center_changed', function ()
      {
        var center = map.getCenter();
        $( '#lat' ).val( center.lat() );
        $( '#lng' ).val( center.lng() );
      } );
      google.maps.event.addListener( map, 'zoom_changed', function ()
      {
        var zoom = map.getZoom();
        $( '#zoom' ).val( zoom );
      } );

      //escucha eventos de inputs y actualiza mapa
      $( '#lat, #lng' ).change( function ()
      {
        map.setCenter( new google.maps.LatLng( $( '#lat' ).val(), $( '#lng' ).val() ) );
      } )
      $( '#zoom' ).change( function ()
      {
        map.setZoom( parseInt( $( '#zoom' ).val() ) );
      } );

      //pone valores iniciales
      map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );
      map.setZoom( mapZoom );

      break;

    //ver mapa estático, a partir de pan y zoom
    case 'viewMap':
      //lee mapLat, mapLng y mapZoom
      map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );
      map.setZoom( mapZoom );
      break;

    //edición/posición de 1 marker en mapa estático, cambio de mapa estático a partir de cambio de combo, ajuste 2-vias de coordenadas contra inputs.
    case 'editMarker':

      //escucha cambios en select y actualiza mapa
      $( '#mapFilter' ).change( function ()
      {
        var data = mapsData[$( '#mapFilter' ).val()];
        map.setZoom( parseInt( data.zoom ) );
        map.setCenter( new google.maps.LatLng( data.lat, data.lng ) );
      } );

      //inicializa mapa con la seleccion actual
      map.setZoom( mapZoom );
      map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );

      //escucha eventos de click en mapa, y actualiza marker y coordenadas en inputs
      google.maps.event.addListener( map, 'click', function ( event )
      {
        //quita marker anterior si existe
        if ( marker ) marker.setMap( null );

        marker = new google.maps.Marker( {
          position: new google.maps.LatLng( event.latLng.lat(), event.latLng.lng() ),
          map     : map
        } );

        $( '#lat' ).val( event.latLng.lat() );
        $( '#lng' ).val( event.latLng.lng() );
      } );

      //escucha cambios en lat o lng de inputs, y cambia mapa
      $( '#lat, #lng' ).change( function ()
      {
        marker.setPosition( new google.maps.LatLng( $( '#lat' ).val(), $( '#lng' ).val() ) );
      } )

      //inicializa marker si existen coordenadas
      if ( markerLat && markerLng )
      {
        marker = new google.maps.Marker( {
          position: new google.maps.LatLng( markerLat, markerLng ),
          map     : map
        } );
      }

      break;

    //ver mapa estático a partir de pan y zoom de padre, y ver marker a partir de coordenadas de record.
    case 'viewMarker':
      //lee mapLat, mapLng y mapZoom
      map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );
      map.setZoom( mapZoom );

      //markerLat, y markerLng
      marker = new google.maps.Marker( {
        position: new google.maps.LatLng( markerLat, markerLng ),
        map     : map
      } );
      break;

    case 'mapSuport':

      var markers = [];
      var infoWindow;

    function placeMarkers()
    {
      for ( var i in markers )
      {
        markers[i].setMap( null );
      }
      var markersData = suportsData[parentId];
      for ( var i in markersData )
      {
        var markerData = markersData[i];
        var marker = new google.maps.Marker( {
          position: new google.maps.LatLng( markerData.lat, markerData.lng ),
          map     : map,
          title   : markerData.name
        } );
        marker['info'] = new google.maps.InfoWindow( {
          content: "<p><strong>" + markerData.name + "</strong></p><p>" + markerData.description + "</p>"
        } );
        google.maps.event.addListener( marker, 'click', function ()
        {
          if ( infoWindow ) infoWindow.close();
          infoWindow = this.info;
          this.info.open( map, this );
        } );

        markers.push( marker );
      }
    }

      //escucha cambios en select y actualiza mapa
      $( '#mapFilter' ).change( function ()
      {
        parentId = $( '#mapFilter' ).val();
        var data = mapsData[parentId];
        map.setZoom( parseInt( data.zoom ) );
        map.setCenter( new google.maps.LatLng( data.lat, data.lng ) );

        placeMarkers();
      } );

      //inicializa mapa con la seleccion actual
      map.setZoom( mapZoom );
      map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );

      //inicializa markers
      placeMarkers();

      break;

    case 'mapShop':

      //mapa inicial de Argentina
      map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );
      map.setZoom( mapZoom );

      var markers = [];
      var infoWindow;

      //configMap
      var config = {
        province: {next: 'city', prev: null, clean: ['city', 'brand'], coords: coordsByProvince, shops: shopsByProvince},
        city    : {next: 'brand', prev: 'province', clean: ['brand'], coords: coordsByCity, shops: shopsByCity},
        brand   : {next: null, prev: 'city', clean: [], coords: null, shops: shopsByBrand}
      }


      //evento de provincias
      $( '#filter_province > select' ).change( function ()
      {
        setMapSelectAndMarkers( this );

      } );

    function setMapSelectAndMarkers( select )
    {
      //quita markers anteriores
      for ( var i in markers ) markers[i].setMap( null );


      select = $( select );
      var type = select.attr( 'data-type' );

      var value = select.val();

      //clean hacia abajo
      //limpia selects proximos
      for ( var i = 0; i < config[type].clean.length; i++ )
      {
        var next = config[type].clean[i];
        $( "#filter_" + next ).empty();
        $( "#filter_" + next ).append( $( '#empty_' + next ).clone() );
      }

      //si no selecciona nada
      if ( !value )
      {
        //emula select de padre o reset total
        if ( config[type].prev )
        {
          setMapSelectAndMarkers( $( '#filter_' + config[type].prev + ' select' ).get( 0 ) )
        }
        else
        {
          map.setCenter( new google.maps.LatLng( mapLat, mapLng ) );
          map.setZoom( mapZoom );
        }

        return;
      }

      //habilita proximo select
      if ( config[type].next )
      {
        var next = config[type].next;
        $( "#filter_" + next ).empty();
        var filterSelect = $( '#' + next + value ).clone();
        filterSelect.change( function () {setMapSelectAndMarkers( this )} );
        $( "#filter_" + next ).append( filterSelect );
      }

      //ubica el mapa
      var coords = type == 'brand' ? null : config[type]['coords'][value];
      if ( coords )
      {
        map.setCenter( new google.maps.LatLng( coords.lat, coords.lng ) );
        map.setZoom( parseInt( coords.zoom ) );
      }
      //agrega markers
      var shops = config[type]['shops'][value];
      for ( var i in shops )
      {
        var shop = shops[i];

        var marker = new google.maps.Marker( {
          position: new google.maps.LatLng( shop.lat, shop.lng ),
          map     : map,
          title   : shop.name
        } );
        marker['info'] = new google.maps.InfoWindow( {
          content: "<p><strong>" + shop.name + "</strong></p><p>" + shop.description + "</p>"
        } );
        google.maps.event.addListener( marker, 'click', function ()
        {
          if ( infoWindow ) infoWindow.close();
          infoWindow = this.info;
          this.info.open( map, this );
        } );

        markers.push( marker );
      }
    }

      break;
  }
}

google.maps.event.addDomListener( window, 'load', initialize );