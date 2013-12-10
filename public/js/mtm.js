var MTM = {
    queue: [],
    loading: false,

    init: function() {
        setInterval(function() {
            if (!this.loading && this.queue.length > 0) {
                var callback = this.queue.shift();
                callback();
            }
        }.bind(this), 100);
    }
};

$(MTM.init.bind(MTM));

$('form').on('change', '.array-input', function() {
    var input = $('#' + $(this).data('input')),
        inputData = [];
    $(this).find('option:selected').each(function() {
        inputData.push(this.value);
    });
    input.val(inputData.join(','));
});
