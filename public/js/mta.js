$(document).ready(function() {

    $('.currentTime').text(moment(parseInt($('.currentTime').attr('data-time'))).format('h:mm:ssa'));

});