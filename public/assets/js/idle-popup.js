$(document).ready(function() {
    // Set the idle time threshold (in milliseconds)
    // var idleTimeThreshold = 60000; // 1 minute
    var idleTimeThreshold = 30 * 60000; // 30 minute
  
    // Set the timeout variable
    var idleTimeout;
  
    // Start the idle timer
    startIdleTimer();
  
    // Reset the idle timer on user activity
    $(document).on('mousemove keydown scroll', function() {
      clearTimeout(idleTimeout);
      startIdleTimer();
    });
  
    // Function to display the popup
    function displayPopup() {
      $('#notification-modal').modal('toggle');
      // $('#notification-modal').find('#msg').html('Screen is idle for more than one minute!');
      authCheck();
    }
  
    // Function to start the idle timer
    function startIdleTimer() {
      idleTimeout = setTimeout(displayPopup, idleTimeThreshold);
    }

    function authCheck(){
      $.ajax({
        type: "GET",
        url: apiUrl + "/auth-status",
        success: function(response) {
          if(typeof(response.status) != undefined && response.status == false){
            window.location.href = response.baseUrl;
          }
        },
        error: function(xhr) {
           
        }
      });
    }
    
    $(window).on('focus', function() {
      // $('#notification-modal').modal('toggle');
      // $('#notification-modal').find('#msg').html('Screen is idle for more than one minute!');
      authCheck();
    });
    
  });
  