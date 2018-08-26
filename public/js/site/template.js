$('.sidebarClose').click(function(){
    if($('.sidebarContent').is(":hidden")) {
        $(this).addClass('active');
        $(this).removeClass('inactive');
        $(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
    }
    else {
        $(this).addClass('active');
        $(this).removeClass('active');
        $(this).html('<i class="fa fa-angle-double-right" aria-hidden="true"></i>');
    }

    $('.sidebarContent').fadeToggle('slow');
});