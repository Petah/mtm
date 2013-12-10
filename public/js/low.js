var Low = {
    queue: [],
    loading: false,
    update: function() {
        MTM.queue.push(this.load);
    },
    load: function() {
        $.ajax({
            url: '',
            method: 'post',
            data: $('#low').serialize(),
            dataType: 'json'
        }).done(function(data) {
            var template = twig({
                data: $('#low-template').html()
            });
            var html = '';
            for (var i = 0, l = data.length; i < l; i++) {
                html += template.render(data[i]);
            }
            $('#listings').html(html);
        }.bind(this)).error(function(xhr) {
            $('#listings').html(xhr.responseText);
        }.bind(this)).always(function() {
            this.loading = false;
        }.bind(this));
    }
};

$('#low :input').on('input change', Low.update.bind(Low));
