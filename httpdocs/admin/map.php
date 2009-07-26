<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<style type="text/css" media="all">@import "/css/website.css";</style>
	<style media="all" type="text/css">
		html,body{ text-align: center; margin: auto; padding: 10px; font-family:"Trebuchet MS", verdana, arial; }
		#map{ width: 800px; height: 600px; }
		#mapPopup{ width: 200px; height: 200px;  }
		#MapListings{ float: right; background-color: #DEE3FA; border: 1px dashed #0000FF; width: 300px; font-size: 80%; font-weight: bold; }
	</style>
    <title>Cambridge Just Living Map</title>

 <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAAx318I-0IdMwWPU03dTSJPxQkEh_EwjoIWpcUCzprmsMXDsvezhRx3NhMyM-YmE4F895m7ZL8WqnwgA" type="text/javascript"></script>   
    <script type="text/javascript">
    //<![CDATA[

    var browser;
	
<?php
// Always connect to DB
$db = mysql_pconnect("localhost", "justliving", "f98v83bnu2cw");
mysql_select_db("justliving",$db);

$sql = "SELECT * FROM listings WHERE latitude != 0 AND longitude != 0";
	
// Run the SQL:
$result = mysql_query($sql);
$lats = "var lats = [";
$longs = "var longs = [";
$names = "var names = [";
//$addresses = "var addresses = [";
$urls = "var urls = [";
$emails = "var emails = [";

if ( $myrow = mysql_fetch_array($result) ) 
{
do 
	{
		if ( $myrow["latitude"] && $myrow["longitude"] )
		{
			$lats .= $myrow["latitude"] .",";
			$longs .= $myrow["longitude"] .",";
			$names .= "'" .$myrow["org_name"] ."',";
			//$addresses .= "'" .str_replace( "\n", "", ( $myrow["address"] ) ) ."'";
			$urls .= "'" .$myrow["website"] ."',";
			$emails .= "'" .$myrow["email"] ."',";
		}
		
	} while ($myrow = mysql_fetch_array($result));
}

print( chop( $lats,",") ."];" );
print( chop( $longs,",") ."];" );
print( chop($names,",") ."];" );
//print( $addresses ."];" );
print( chop($urls,",") ."];" );
print( chop($emails,",") ."];" );

?>
var markers = new Array();

function handleData()
{
	// now need to get all points and find average for the map center:
	var avgLat = 0;	var avgLong = 0; 
	// Create a bounds objects
	var bounds = new GLatLngBounds();
	
	for ( var i = 0; i < lats.length; i ++ )
	{
		avgLat += lats[ i ];

		avgLong += longs[ i ];

		// output the name as a link to the page:
		
		// Extend it to cover all your points
		bounds.extend(new GLatLng( lats[ i ], longs[ i ] ) );
	}
	
	if (GBrowserIsCompatible()) 
	{
		var map = new GMap2( document.getElementById("map") );

		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		
		// work out the center based on all the hotels:
		
		avgLat /= lats.length;
		avgLong /= longs.length;
		
		//map.setCenter(new GLatLng(avgLat, avgLong), 13);

		// Position map at centre of bounds and set zoom to include include
		map.setCenter( new GLatLng( avgLat, avgLong ), map.getBoundsZoomLevel(bounds) );
	   
	    var resultsDiv = document.getElementById( "MapListings" );
		
		var baseIcon = new GIcon();
		baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
		baseIcon.iconSize = new GSize( 20, 34 );
		baseIcon.shadowSize = new GSize( 37, 34 );
		baseIcon.iconAnchor = new GPoint( 9, 34 );
		baseIcon.infoWindowAnchor = new GPoint( 9, 2 );
		baseIcon.infoShadowAnchor = new GPoint( 18, 25 );
			
		// now add the points:
		for ( var i = 0; i < lats.length; i ++ )
		{
			var letter = String.fromCharCode("A".charCodeAt(0) + i);
		
			var icon = new GIcon( baseIcon );
			icon.image = "http://www.google.com/mapfiles/marker" +letter +".png";

			var point = new GLatLng( lats[ i ], longs[ i ] );
			
			var marker = new GMarker( point, icon );

			markers[ i ] = createMarker( marker, i );

			map.addOverlay( marker, i );
			 
			var pNameNode = document.createElement( "span" );
			var nameNodeText = document.createTextNode( letter +". " +names[ i ] ); 
			pNameNode.appendChild( nameNodeText );
			resultsDiv.appendChild( pNameNode );
			resultsDiv.appendChild( document.createElement( "br" ) );
			
			//var pAddressNode = document.createElement( "p" );
			//var addressNodeText = document.createTextNode( addresses[ i ] ); 
			//pAddressNode.appendChild( addressNodeText );
			//resultsDiv.appendChild( pAddressNode );
			
			var pUrlNode = document.createElement( "span" );
			pUrlNode.innerHTML = "<a href='" +urls[i] +"')>" +urls[i] +"</a>";
			
			resultsDiv.appendChild( pUrlNode );
			resultsDiv.appendChild( document.createElement( "br" ) );
			
			var pMapUrlNode = document.createElement( "span" );
			pMapUrlNode.innerHTML = "<a href='JAVASCRIPT:focusMarker(" +i +")'>Map it</a>";
			
			resultsDiv.appendChild( pMapUrlNode );
			resultsDiv.appendChild( document.createElement( "br" ) );
			
			var pEmailNode = document.createElement( "span" );
			var emailNodeText = document.createTextNode( emails[ i ] ); 
			pEmailNode.appendChild( emailNodeText );
			resultsDiv.appendChild( pEmailNode );
			resultsDiv.appendChild( document.createElement( "hr" ) );
		}
	}
}

function createMarker( marker, index) 
{
	  GEvent.addListener( marker, "click", function() 
		{
			marker.openInfoWindowHtml( names[ index ] );
		});
	  return marker;
}

function focusMarker( index )
{
	markers[ index ].openInfoWindowHtml( "<div id='mapPopup'>" +names[ index ] +"</div>" );
} 

        //]]>
    </script>
	</head>
	<body onload="handleData();" onunload="GUnload()">
		<div id="container">
		<h1><a href="/"><img src="/imgs/happyface.gif" alt="Just Living - An Ethical Guide to Cambridge" width="316" height="87" /></a></h1>
		<div id="MapListings">&nbsp;</div>
		<div id="page">
			<div id="map"></div>
		</div>
	</div>
</body>