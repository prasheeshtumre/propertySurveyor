// This file include all the edit pricing and other details scripts

$(document).ready(function() {
  var val = $("input[name='pricing_details_for']:checked").val();
  if (val == 1) {
    $("#OwnnershipClone").show();
    $("#PriceDetailsClone").show();
    $("#AdditionalPrcingDetailsClone").show();
    $("#RemarksOnPropertyClone").show();
    $("#newResaleUnit").removeClass("d-none");

    $("#RentDetailsClone").hide();
    $("#excludePrice").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#AgreementTypeClone").hide();
    $("#SoldPriceDetails").hide();
  } else if (val == 2) {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $("#SoldPriceDetails").hide();
    $("#newResaleUnit").addClass("d-none");

    $("#RemarksOnPropertyClone").show();
    $("#AgreementTypeClone").show();
    $("#RentDetailsClone").show();
    $("#excludePrice").show();
    $("#AdditionalrentDetailClone").show();
    $("#SecurityDepositClone").show();
    $("#AggrementDurationClone").show();
    $("#NoticeMonthClone").show();
  } else if (val == 3) {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $("#excludePrice").hide();
    $("#AgreementTypeClone").hide();
    $("#RentDetailsClone").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#SoldPriceDetails").hide();
    $("#newResaleUnit").addClass("d-none");

    $("#RentedDetails").show();
    $("#RemarksOnPropertyClone").show();
  } else if (val == 4) {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $("#excludePrice").hide();
    $("#AgreementTypeClone").hide();
    $("#RentDetailsClone").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#RentedDetails").hide();

    $("#SoldPriceDetails").show();
    $("#RemarksOnPropertyClone").show();
    $("#newResaleUnit").removeClass("d-none");
  }

  $("#ForSale").on("click", function() {
    $("#OwnnershipClone").show();
    $("#PriceDetailsClone").show();
    $("#AdditionalPrcingDetailsClone").show();
    $("#RemarksOnPropertyClone").show();
    $("#newResaleUnit").removeClass("d-none");
    $("#NewUnit , #ResaleUnit").attr('disabled', false);

    $("#RentDetailsClone").hide();
    $("#excludePrice").hide();
    $("#RentedDetails").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#AgreementTypeClone").hide();
    $("#SoldPriceDetails").hide();
  });

  $("#ForSold").on("click", function() {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $("#RentDetailsClone").hide();
    $("#excludePrice").hide();
    $("#RentedDetails").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#AgreementTypeClone").hide();

    $("#SoldPriceDetails").show();
    $("#RemarksOnPropertyClone").show();
    $("#newResaleUnit").removeClass("d-none");
    $("#NewUnit , #ResaleUnit").attr('disabled', false);
  });

  $("#ForRent").on("click", function() {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $("#RentedDetails").hide();
    $("#SoldPriceDetails").hide();
    $('#newResaleUnit').addClass('d-none');
    $("#NewUnit , #ResaleUnit").attr('disabled', true);

    $("#AgreementTypeClone").show();
    $("#RentDetailsClone").show();
    $("#excludePrice").show();
    $("#AdditionalrentDetailClone").show();
    $("#SecurityDepositClone").show();
    $("#AggrementDurationClone").show();
    $("#NoticeMonthClone").show();
    $("#RemarksOnPropertyClone").show();
  });

  $("#ForRented").on("click", function() {
    $("#OwnnershipClone").hide();
    $("#PriceDetailsClone").hide();
    $("#AdditionalPrcingDetailsClone").hide();
    $("#RentDetailsClone").hide();
    $("#excludePrice").hide();
    $("#AdditionalrentDetailClone").hide();
    $("#SecurityDepositClone").hide();
    $("#AggrementDurationClone").hide();
    $("#NoticeMonthClone").hide();
    $("#AgreementTypeClone").hide();
    $("#SoldPriceDetails").hide();
    $('#newResaleUnit').addClass('d-none');
    $("#NewUnit , #ResaleUnit").attr('disabled', true);

    $("#RentedDetails").show();
    $("#RemarksOnPropertyClone").show();
  });
 
});
