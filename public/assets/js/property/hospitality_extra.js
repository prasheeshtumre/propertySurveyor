   
        //  Multi screens script 
        
      
  $(document).ready(function() {
  const $screens = $(".screen");
  var currentScreen = 0;
   const $screens1 = $(".progress-bar");
  var progressbar = 0;

  function showScreen(screenIndex) {
    $screens.removeClass("visible highlight");
    $screens.eq(screenIndex).addClass("visible");

    if (screenIndex > 0) {
      $screens.eq(screenIndex - 1).addClass("highlight");
    }
  }
  
  function showAtive(screenIndex) {
    
    $screens1.removeClass("active");
    $screens1.eq(screenIndex).addClass("active");

    if (screenIndex > 0) {
      $screens1.eq(screenIndex - 1).addClass("active");
      
    }
    if(screenIndex===2)
     $screens1.eq(screenIndex).addClass("active");
    }

  // Initially show the first screen
  showScreen(currentScreen);

  // Next button click event handler
  $(".nextBtn").on("click", function() {
    // nextStep()
    if($('.flash-errors').length == 0){
      if (currentScreen < $screens.length - 1) {
        currentScreen++;
        showScreen(currentScreen);
        progressbar++;
        showAtive(progressbar);
      }
    }
  });

  function nextStep(){
      if (currentScreen < $screens.length - 1) {
        currentScreen++;
        showScreen(currentScreen);
        progressbar++;
        showAtive(progressbar);
      }
  }

  // Previous button click event handler
  $(".prevBtn").on("click", function() {
    if (currentScreen > 0) {
      currentScreen--;
      showScreen(currentScreen);
       progressbar--;
       showAtive(progressbar);
    }
  });
});



$(document).ready(function() {
  $(".progress-bar").on("click", function() {
    $(".progress-bar").removeClass("highlight");
    $(this).addClass("highlight");
  });
});









//   Multi screens script end 