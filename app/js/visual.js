function show_sub(event) {
    var div_id = event.target.id;
    var value = $('#'+div_id).prop('checked');
    var follow_div_id = div_id + "-follow";

    if (value) {
        $('#'+follow_div_id).show();
    } else {
        $('#'+follow_div_id).hide();
    }
    return true;
}