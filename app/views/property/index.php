<div class="row">
    <div class="col-lg-12">
        <h1>Property <small>Statistics Overview</small></h1>
        <ol class="breadcrumb">
            <li><a href="@todo"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-wrench"></i> Property</li>
        </ol>
    </div>
</div>
<form id="properties" class="form-inline" role="form" method="post">
    <div class="col-sm-2">
        <h3>Districts</h3>
        <?php /*
        <input id="suburbs" type="hidden" name="suburbs" />
        <select id="suburb-select" multiple="multiple" data-input="suburbs" class="array-input">
            <?php foreach ($data->localities as $locality): ?>
                <?php foreach ($locality->districts as $district): ?>
                    <optgroup label="<?= $locality->name->ha(); ?> - <?= $district->name->ha(); ?>">
                        <?php foreach ($district->suburbs as $suburb): ?>
                            <option value="<?= $suburb->suburbID->ha(); ?>"><?= $suburb->name->h(); ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
         */ ?>

        <input id="districts" type="hidden" name="districts" />
        <select id="district-select" multiple="multiple" data-input="districts" class="form-control array-input">
            <?php foreach ($data->localities as $locality): ?>
                <optgroup label="<?= $locality->name->ha(); ?>">
                    <?php foreach ($locality->districts as $district): ?>
                        <option value="<?= $district->id->i(); ?>" <?= $district->selected->b() ? 'selected="selected"' : null; ?>><?= $district->name->h(); ?></option>
                    <?php endforeach; ?>
                </optgroup>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-sm-3">
        <h3>Price</h3>
        <div>
            <label>Desired Price</label>
            <input class="form-control" value="<?= $data->propertyAPI->getPriceDesired()->m(); ?>" />
            <p class="help-block">Your ideal price for the house you are looking for.</p>
        </div>
        <div>
            <label>Maximum Price</label>
            <input class="form-control" value="<?= $data->propertyAPI->getPriceMax()->m(); ?>">
            <p class="help-block">Your maximum price you can afford.</p>
        </div>
    </div>

    <div class="col-sm-3">
        <h3>Bedrooms</h3>
        <div>
            <label>Desired Bedrooms</label>
            <input class="form-control" value="<?= $data->propertyAPI->getRoomsDesired()->n(); ?>">
            <p class="help-block">Your ideal amount of bedrooms.</p>
        </div>
        <div>
            <label>Minimum Bedrooms</label>
            <input class="form-control" value="<?= $data->propertyAPI->getRoomsMin()->n(); ?>">
            <p class="help-block">The minimum amount of bedrooms required.</p>
        </div>
    </div>


    <div class="col-sm-3">
        <h3>Backyard</h3>
        <div>
            <label>Desired Size</label>
            <input class="form-control" value="<?= $data->propertyAPI->getSizeDesired()->n(); ?>">
            <p class="help-block">Your ideal backyard size (in square meters).</p>
        </div>
        <div>
            <label>Minimum Size</label>
            <input class="form-control" value="<?= $data->propertyAPI->getSizeMin()->n(); ?>">
            <p class="help-block">The minimum backyard size.</p>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="map-canvas"></div>
<?php ob_start(); ?>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    (function($) {
        $('#properties').submit(function(event) {
            $(this).find('.array-input').each(function() {
                var input = $('#' + $(this).data('input')),
                    inputData = [];
                $(this).find('option:selected').each(function() {
                    inputData.push(this.value);
                });
                input.val(inputData.join(','));
            });
        });
    })(jQuery);
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-37.790252,175.300598),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var infowindow = new google.maps.InfoWindow();
        var properties = <?= $data->properties->j(); ?>;
        for (var i = 0, l = properties.length; i < l; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(properties[i].lat, properties[i].lng),
                map: map,
                icon: 'property/icon?type=' + properties[i].icon,
                title: properties[i].title,
                labelContent: properties[i].price,
                labelAnchor: new google.maps.Point(22, 0),
                labelClass: 'labels',
                labelStyle: {opacity: 0.75}
            });
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style type="text/css">
    #map-canvas {
        width: 100%;
        height: 500px;
    }
    select[multiple] {
        height: 180px;
    }
</style>
<?php $footer = ob_get_clean(); ?>
