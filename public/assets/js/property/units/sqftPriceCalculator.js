
// sqftPriceCalculator.js

// This JavaScript file calculates the price per square foot and handles various error situations.

// Function to calculate and update the price per square foot
function calculatePricePerSquareFoot(expected_price, price_per_sqft, PriceInWordsEle, sqftPriceInWordsEle, areaTypeDD) {
    let CarpetArea = $("#CarpetArea").val();
    let BuildupArea = $("#BuildupArea").val();
    let SuperBuildupArea = $("#SuperBuildupArea").val();
    let price = parseFloat($("#"+ expected_price).val());
    let propertyArea = "";
    propertyArea =
      CarpetArea != ""
        ? parseFloat($("#CarpetArea").val())
        : BuildupArea != ""
        ? parseFloat($("#BuildupArea").val())
        : SuperBuildupArea != ""
        ? parseFloat($("#SuperBuildupArea").val())
        : 0;
    let selectedValue =
        CarpetArea != ""
          ? "1"
          : BuildupArea != ""
          ? "2"
          : SuperBuildupArea != ""
          ? "3"
          : 0;

  if (isNaN(propertyArea) || isNaN(price)) {
    console.log("Price per square foot: N/A");
  } else if (propertyArea === 0) {
    console.log("Price per square foot: Infinity");
  } else {
    let pricePerSqFt = price / propertyArea;
    console.log(pricePerSqFt.toFixed(2))
    $("#" + price_per_sqft).val(pricePerSqFt.toFixed(2));
    pricePerSqFt = (pricePerSqFt > 0) ? Math.round(pricePerSqFt) : 0;
    $('#'+PriceInWordsEle).html(convertNumberToWords(price));
    $("#"+sqftPriceInWordsEle).html(convertNumberToWords(pricePerSqFt));
    $("."+areaTypeDD+" option[value='" + selectedValue + "']").prop(
      "selected",
      true
    );
  }
}

// Function to calculate and update the price per square foot for sale
function calculatePricePerSquareFootBasedOnType(type) {
  const CarpetArea = parseFloat($("#CarpetArea").val());
  const BuildupArea = parseFloat($("#BuildupArea").val());
  const SuperBuildupArea = parseFloat($("#SuperBuildupArea").val());
  const price = parseFloat($("#expected_price").val());
  let propertyArea = 0;
  let propertyAreaStatus = false;
  // console.log(typeof type);
  if (type == "1") {
    propertyArea = CarpetArea;
  } else if (type == "2") {
    propertyArea = BuildupArea;
  } else if (type == "3") {
    propertyArea = SuperBuildupArea;
  }
  propertyArea = (propertyArea > 0 ) ? propertyArea : 0;
  // console.log(propertyArea);
  $("#property-price__in_words").html(convertNumberToWords(price));
  // console.log( numberToWords.toWords(price));
  if (isNaN(propertyArea) || isNaN(price)) {
    $("#result").text("Price per square foot: N/A");
    console.log("Price per square foot: N/A");
  } else if (propertyArea === 0) {
    $("#result").text("Price per square foot: Infinity");
    console.log("Price per square foot: Infinity");
    $("#price_per_sq_ft").val(0.00);
    $("#property-price-psqft__in_words").html('zero')
  } else {
    let pricePerSqFt = (price / propertyArea);
    $("#price_per_sq_ft").val(pricePerSqFt.toFixed(2));
    pricePerSqFt = (pricePerSqFt > 0) ? Math.round(pricePerSqFt) : 0;
    $("#property-price-psqft__in_words").html(convertNumberToWords(pricePerSqFt));
    // $("#result").text(`Price per square foot: Rs ${pricePerSqFt.toFixed(2)}`);
    // console.log(`Price per square foot: Rs ${pricePerSqFt.toFixed(2)}`);
  }
}

// Function to calculate and update the price per square foot for sold
function calculateSoldPricePerSquareFootBasedOnType(type) {
  const CarpetArea = parseFloat($("#CarpetArea").val());
  const BuildupArea = parseFloat($("#BuildupArea").val());
  const SuperBuildupArea = parseFloat($("#SuperBuildupArea").val());
  const price = parseFloat($("#expected_sold_price").val());
  let propertyArea = 0;
  let propertyAreaStatus = false;
  if (type == "1" && CarpetArea != "") {
    propertyArea = CarpetArea;
  } else if (type == "2" && CarpetArea != "") {
    propertyArea = BuildupArea;
  } else if (type == "3" && BuildupArea != "") {
    propertyArea = SuperBuildupArea;
  }
  propertyArea = (propertyArea > 0 ) ? propertyArea : 0;
  $("#sold-property-price__in_words").html(convertNumberToWords(price));
  // console.log( numberToWords.toWords(price));
  if (isNaN(propertyArea) || isNaN(price)) {
    $("#result").text("Price per square foot: N/A");
    console.log("Price per square foot: N/A");
  } else if (propertyArea === 0) {
    $("#result").text("Price per square foot: Infinity");
    console.log("Price per square foot: Infinity");
    $("#sold_price_per_sq_ft").val(0);
    $("#sold-property-price-psqft__in_words").html('zero')
  } else {
    let pricePerSqFt =(price / propertyArea);
    $("#sold_price_per_sq_ft").val(pricePerSqFt.toFixed(2));
    $("#sold-property-price-psqft__in_words").html(convertNumberToWords(pricePerSqFt));
    pricePerSqFt = (pricePerSqFt > 0) ? Math.round(pricePerSqFt) : 0;
    $("#sold-property-price-psqft__in_words").html(convertNumberToWords(Math.round(pricePerSqFt)))
  }
}

//Function to convert numeric value to words in rupees
function convertNumberToWords(number) {
  const words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    function convertLessThanHundred(num) {
        if (num < 20) {
            return words[num];
        } else {
            return tens[Math.floor(num / 10)] + " " + words[num % 10];
        }
    }
    function convertpriceToWords(num) {
        if (num === 0) {
            return "Zero";
        }
        let result = "";
        if (num >= 1e9) {
            result += convertLessThanHundred(Math.floor(num / 1e9)) + " Billion ";
            num %= 1e9;
        }
        if (num >= 1e7) {
            result += convertLessThanHundred(Math.floor(num / 1e7)) + " Crore ";
            num %= 1e7;
        }
        if (num >= 1e5) {
            result += convertLessThanHundred(Math.floor(num / 1e5)) + " Lakh ";
            num %= 1e5;
        }
        if (num >= 1e3) {
            result += convertLessThanHundred(Math.floor(num / 1e3)) + " Thousand ";
            num %= 1e3;
        }
        if (num >= 100) {
            result += words[Math.floor(num / 100)] + " Hundred ";
            num %= 100;
        }
        if (num > 0) {
            if (result !== "") {
                result += "and ";
            }
            result += convertLessThanHundred(num);
        }
        return result.trim();
    }
    return convertpriceToWords(number);
}

$(document).on("change", ".sqft__based-on", function () {
  const type = $(this).val();
  calculatePricePerSquareFootBasedOnType(type);
});

$(document).on("change", ".sold_sqft__based-on", function () {
  const type = $(this).val();
  calculateSoldPricePerSquareFootBasedOnType(type);
});

// converting rent amount to words
$(document).on('input', '.rent__amount', function(){
  let rentAmount = $(this).val();
  let rentAmountInWords = convertNumberToWords(rentAmount);
  let inWordsEle = $(this).parent().find('.rent__amount-in__words').find('span');
  inWordsEle.html(rentAmountInWords);
});

// Initialize the script
function init() {
  // Attach the event handler to the input fields
  $(document).on("input", "#CarpetArea, #expected_price", function () {
    
    calculatePricePerSquareFoot("expected_price", "price_per_sq_ft",
                                 "property-price__in_words","property-price-psqft__in_words", "sqft__based-on");
  });

  $(document).on("input", "#CarpetArea, #expected_sold_price", function () {
    calculatePricePerSquareFoot("expected_sold_price", "sold_price_per_sq_ft",
     "sold-property-price__in_words", "sold-property-price-psqft__in_words", "sold_sqft__based-on");
  });

  $(document).on(
    "input",
    "#CarpetArea, #BuildupArea, #SuperBuildupArea",
    function () {
      let CarpetArea = $("#CarpetArea").val();
      let BuildupArea = $("#BuildupArea").val();
      let SuperBuildupArea = $("#SuperBuildupArea").val();
      // const price = parseFloat($("#"+ expected_price).val());
      let propertyArea = "";
      propertyArea =
        CarpetArea != ""
          ? parseFloat($("#CarpetArea").val())
          : BuildupArea != ""
          ? parseFloat($("#BuildupArea").val())
          : SuperBuildupArea != ""
          ? parseFloat($("#SuperBuildupArea").val())
          : 0;
      let selectedValue =
        CarpetArea != ""
          ? "1"
          : BuildupArea != ""
          ? "2"
          : SuperBuildupArea != ""
          ? "3"
          : 0;
      let saleRentPrice = parseFloat($("#expected_price").val()) ?? 0;
      let soldPrice = parseFloat($("#expected_sold_price").val()) ?? 0;
      if ($("#ForSold").prop("checked")) {
        $("#sold-property-price__in_words").html(convertNumberToWords(soldPrice));
        if (isNaN(propertyArea) || isNaN(soldPrice)) {
          $("#result").text("Price per square foot: N/A");
        } else if (propertyArea === 0) {
          $("#result").text("Price per square foot: Infinity");
        } else {
          let soldPricePerSqFt = soldPrice / propertyArea;
          $("#sold_price_per_sq_ft").val(soldPricePerSqFt.toFixed(2));
          $("#sold-property-price-psqft__in_words").html(convertNumberToWords(soldPricePerSqFt))
          $(".sold_sqft__based-on option[value='" + selectedValue + "']").prop(
            "selected",
            true
          );
          $(".sold_sqft__based-on").change();
        }
      } else {
        $("#property-price__in_words").html(
          convertNumberToWords(saleRentPrice)
        );
        if (isNaN(propertyArea) || isNaN(saleRentPrice)) {
          $("#result").text("Price per square foot: N/A");
        } else if (isNaN(propertyArea) || isNaN(soldPrice)) {
          $("#result").text("Price per square foot: N/A");
        } else if (propertyArea === 0) {
          $("#result").text("Price per square foot: Infinity");
        } else {
          let saleRentPricePerSqFt = saleRentPrice / propertyArea;
          $("#price_per_sq_ft").val(saleRentPricePerSqFt.toFixed(2));
          $("#property-price-psqft__in_words").html(convertNumberToWords(saleRentPricePerSqFt));
          $(".sqft__based-on option[value='" + selectedValue + "']").prop(
            "selected",
            true
          );
          $(".sqft__based-on").change();
        }
      }
    }
  );
  // Initial calculation
  if($('#ForSale').prop('checked') === true){
    let propertyPrice = parseFloat($("#expected_price").val());
    let currentPricePerSquareFoot = $('#price_per_sq_ft').val();
    currentPricePerSquareFoot = (currentPricePerSquareFoot > 0) ? Math.round(currentPricePerSquareFoot) : 0;
    $("#property-price__in_words").html(convertNumberToWords(propertyPrice));
    $("#property-price-psqft__in_words").html(convertNumberToWords(currentPricePerSquareFoot));
  }

  if($('#ForSold').prop('checked') === true){
    let propertySoldPrice = parseFloat($("#expected_sold_price").val());
    let currentSoldPricePerSquareFoot = $('#sold_price_per_sq_ft').val();
    currentSoldPricePerSquareFoot = (currentSoldPricePerSquareFoot > 0) ? Math.round(currentSoldPricePerSquareFoot) : 0;
    $("#sold-property-price__in_words").html(convertNumberToWords(propertySoldPrice));
    $("#sold-property-price-psqft__in_words").html(convertNumberToWords(currentSoldPricePerSquareFoot))
  }
  if($('#ForRent').prop('checked') === true || $('#ForRented').prop('checked') === true){
    let ele = $('.rent__amount');
    let rentAmount = ele.val();
    let rentAmountInWords = convertNumberToWords(rentAmount);
    let inWordsEle = ele.parent().find('.rent__amount-in__words').find('span');
    inWordsEle.html(rentAmountInWords);
  }
  // property-sold-price__in_words
}
// Call the init function to start the script
init();
