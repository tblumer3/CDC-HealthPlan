$(function () {
    $('#prior').change(function(){
        var value = this.checked;
        console.log(value);
        if (value === true) {
            $('#prior-medical').show();
            console.log("true!");
        } else {
            $('#prior-medical').hide(100);
            console.log("false!");
        }
    });
});