$('.faqAnswer').hide();

$('.faqItem').click(function(){
    var id = $(this).data('id');

    $('.faqAnswer').hide();
    $('#faqAnswer_'+id).fadeToggle();
});