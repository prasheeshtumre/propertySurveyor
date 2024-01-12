$(document).ready(function(){


$(document).on('change','#survey_option',function(){
var survey_option = $(this).val();
getSuveryFilters(survey_option);
});

function getSuveryFilters(survey_option){
// alert(survey_option);
}

$(document).on('change','#category_property',function(){
$('.filter-data').hide();
var cat_id = $(this).val();
if(cat_id == '1'){
$("#construction_state").show();
$('#furnishing_status').show();
$('#ameneties').show();
$('#category_status').show();
$('#brand_sub_categories').show();
$('#brand_categories').show();
$('#age_of_property').show();
$('#property_facing').show();
$('#no_of_price').show();
$('#sub_categories').show();

}
else if(cat_id == '2'){
$("#construction_state").show();
$('#furnishing_status').show();
$('#ameneties').show();
$('#no_of_bedrooms').show();
$('#no_of_bathrooms').show();
$('#age_of_property').show();
$('#property_facing').show();
$('#gated_community').show();
$('#no_of_price').show();

}
else if(cat_id == '3'){
$("#construction_state").show();
$('#furnishing_status').show();
$('#ameneties').show();
$('#no_of_bedrooms').show();
$('#no_of_bathrooms').show();
$('#age_of_property').show();
$('#property_facing').show();
$('#no_of_price').show();

}else if(cat_id == '4'){
$('#plot_land_types').show();
$("#no_of_open_sides").show();
$('#no_of_price').show();

}else if(cat_id == '5'){
$('.filter-data').hide();
}else{
$('#no_of_price').show();
}

if(cat_id == ''){
$('#searchFilter')[0].reset();
}
});

});


$(document).ready(function(){
$('[name=dateFilter]').click(function(){
var dateValue = $(this).val();
if(dateValue == 'customDate'){
$('.custom-date-filter').show();
}else{
$('.custom-date-filter').hide();
}
});

$(document).on('change','#from_date',function(){
let from_date = $(this).val();
$('#to_date').attr('min',from_date);
})

});
