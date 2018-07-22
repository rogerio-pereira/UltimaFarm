$('.product_category_id').change(function (){
    id = $(this).val();

    getSubcategories(id);
});

function getSubcategories(id)
{
    $('.product_subcategory_id').html('');

    var optionList = '';

    $.get( "/product_categories/getSubcategoriesCombo/"+id, function( data ) {
        for (var key in data) {
            optionList = optionList + "<option value='"+key+"'>"+data[key]+"</option>";
        }
        
        $('.product_subcategory_id').html(optionList);
    });
}