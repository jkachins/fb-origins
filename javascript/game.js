function submitXp() {
    var $inputs = $('#form :input');

    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
    });
}

