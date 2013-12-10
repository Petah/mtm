var Properties = {
    map: null,
    infoWindow: null,
    markers: {},
    queue: [],
    loading: false,
    init: function() {
        this.map = new google.maps.Map(document.getElementById("map-canvas"), {
            center: new google.maps.LatLng(-37.790252,175.300598),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 8
        });
        this.infoWindow = new google.maps.InfoWindow();

        this.queue.push(this.load.bind(this));
        setInterval(function() {
            console.log(this.loading, this.queue.length);
            if (!this.loading && this.queue.length > 0) {
                var callback = this.queue.shift();
                callback();
            }
        }.bind(this), 100);

        $('#properties :input').change(function() {
            for (var id in this.markers) {
                this.markers[id].setMap(null);
            }
            this.markers = {};
            $('#page').val(1);
            this.queue = [];
            this.queue.push(this.load.bind(this));
        }.bind(this));
    },
    load: function() {
        this.loading = true;

        $.ajax({
            url: '',
            method: 'post',
            data: $('#properties').serialize(),
            dataType: 'json'
        }).done(function(data) {
            var properties = data.properties;
            for (var i = 0, l = properties.length; i < l; i++) {
                this.markers[properties[i].id] = new google.maps.Marker({
                    position: new google.maps.LatLng(properties[i].lat, properties[i].lng),
                    map: this.map,
                    icon: 'property/icon?type=' + properties[i].icon,
                    title: properties[i].title,
                    labelContent: properties[i].price,
                    labelAnchor: new google.maps.Point(22, 0),
                    labelClass: 'labels',
                    labelStyle: {
                        opacity: 0.75
                    }
                });
            }
            $('#page').val(data.page + 1);
            $('.progress-bar').css('width', (100 / data.totalCount * (data.page * data.pageSize)) + '%')

            if (Object.keys(this.markers).length < 100) {
                this.queue.push(this.load.bind(this));
            }
        }.bind(this)).always(function() {
            this.loading = false;
        }.bind(this));
    }
};

$(Properties.init.bind(Properties));
