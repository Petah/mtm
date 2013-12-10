<div class="row">
    <div class="col-lg-12">
        <h1>Property <small>Statistics Overview</small></h1>
        <ol class="breadcrumb">
            <li><a href="@todo"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-wrench"></i> Property</li>
        </ol>
    </div>
</div>
<form id="properties" class="form-inline clearfix" role="form" method="post">
    <input id="page" type="hidden" name="page" value="<?= $data->propertyAPI->getPage()->i(); ?>" />
    <input id="page-size" type="hidden" name="page-size" value="<?= $data->propertyAPI->getPageSize()->i(); ?>" />

    <div class="col-sm-2">
        <h3>Districts</h3>
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
            <input class="form-control" name="price-desired" value="<?= $data->propertyAPI->getPriceDesired()->m(); ?>" />
            <p class="help-block">Your ideal price for the house you are looking for.</p>
        </div>
        <div>
            <label>Maximum Price</label>
            <input class="form-control" name="price-max" value="<?= $data->propertyAPI->getPriceMax()->m(); ?>">
            <p class="help-block">Your maximum price you can afford.</p>
        </div>
    </div>

    <div class="col-sm-3">
        <h3>Bedrooms</h3>
        <div>
            <label>Desired Bedrooms</label>
            <input class="form-control" name="rooms-desired" value="<?= $data->propertyAPI->getRoomsDesired()->n(); ?>">
            <p class="help-block">Your ideal amount of bedrooms.</p>
        </div>
        <div>
            <label>Minimum Bedrooms</label>
            <input class="form-control" name="rooms-min" value="<?= $data->propertyAPI->getRoomsMin()->n(); ?>">
            <p class="help-block">The minimum amount of bedrooms required.</p>
        </div>
    </div>


    <div class="col-sm-3">
        <h3>Backyard</h3>
        <div>
            <label>Desired Size</label>
            <input class="form-control" name="size-desired" value="<?= $data->propertyAPI->getSizeDesired()->n(); ?>">
            <p class="help-block">Your ideal backyard size (in square meters).</p>
        </div>
        <div>
            <label>Minimum Size</label>
            <input class="form-control" name="size-min" value="<?= $data->propertyAPI->getSizeMin()->n(); ?>">
            <p class="help-block">The minimum backyard size.</p>
        </div>
    </div>
</form>
<div class="progress progress-striped active">
    <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
        <span class="sr-only">0% Complete</span>
    </div>
</div>
<div id="map-canvas"></div>
