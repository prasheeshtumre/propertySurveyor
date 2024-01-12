// This file include all the add pricing and other details scripts

$(document).ready(function() {
  $("#ForSale").on("click", function() {    
    $('#newResaleUnit').removeClass('d-none');
    $("#NewUnit , #ResaleUnit").attr('disabled', false);
    $("#RentDetailsClone").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#AgreementTypeClone").hide();
     $("#RemarksOnPropertyClone").hide();    
  });

  $('#NewUnit,#ResaleUnit').on('click', function(){
    $("#OwnnershipClone").show();
    $("#PriceDetailsClone").show();
    $("#AdditionalPrcingDetailsClone").show();
    $("#RemarksOnPropertyClone").show();

    $("#RentDetailsClone").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#AgreementTypeClone").hide();
  })

  $("#ForRent").on("click", function() {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $('#newResaleUnit').addClass('d-none');
    $("#NewUnit , #ResaleUnit").attr('disabled', true);

    $("#AgreementTypeClone").show();
    $("#RentDetailsClone").show();
    $("#AdditionalrentDetailClone").show();
    $("#SecurityDepositClone").show();
    $("#AggrementDurationClone").show();
    $("#NoticeMonthClone").show();    
    $("#RemarksOnPropertyClone").show();
  });
});
