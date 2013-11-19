<div class="row">
    <div class="col-lg-12">
        <h1>Property <small>Statistics Overview</small></h1>
        <ol class="breadcrumb">
            <li><a href="@todo"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-wrench"></i> Property</li>
        </ol>
    </div>
</div>
<form class="form-inline" role="form" style="display: none">
    <div class="col-sm-4">
        <h3>Price</h3>
        <div class="form-group">
            <label>Desired Price</label>
            <input class="form-control">
            <p class="help-block">Your ideal price for the house you are looking for.</p>
        </div>
        <div class="form-group">
            <label>Maximum Price</label>
            <input class="form-control">
            <p class="help-block">Your maximum price you can afford.</p>
        </div>
    </div>

    <div class="col-sm-4">
        <h3>Bedrooms</h3>
        <div class="form-group">
            <label>Minimum Price</label>
            <input class="form-control">
            <p class="help-block">The minimum amount of bedrooms required.</p>
        </div>
        <div class="form-group">
            <label>Desired Price</label>
            <input class="form-control">
            <p class="help-block">Your ideal amount of bedrooms.</p>
        </div>
    </div>


    <div class="col-sm-4">
        <h3>Backyard</h3>
        <div class="form-group">
            <label>Minimum Size</label>
            <input class="form-control">
            <p class="help-block">The maximum price you can afford.</p>
        </div>
        <div class="form-group">
            <label>Desired Size</label>
            <input class="form-control">
            <p class="help-block">Your ideal backyard size (@todo in sqmt).</p>
        </div>
    </div>
</form>
<div id="map-canvas"></div>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-37.790252,175.300598),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var infowindow = new google.maps.InfoWindow();
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style type="text/css">
    #map-canvas {
        width: 100%;
        height: 500px;
    }
</style>