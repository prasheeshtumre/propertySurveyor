


 <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

<script>
    
    $(".profile .icon_wrap").click(function(){
  $(this).parent().toggleClass("active");
  $(".notifications").removeClass("active");
});

$(".notifications .icon_wrap").click(function(){
  $(this).parent().toggleClass("active");
   $(".profile").removeClass("active");
});

$(".show_all .link").click(function(){
  $(".notifications").removeClass("active");
  $(".popup").show();
});

$(".close, .shadow").click(function(){
  $(".popup").hide();
});
    
</script>
<script>
  $(document).ready(function(){
      //$(".lblmrt").hide();
          $('input[type=radio][name=balance]').change(function() {
          if (this.value == '1') {
              $(".lbleng").show();
              $(".lblmrt").hide();
          }
          else if (this.value == '2') {
              
              $(".lbleng").hide();
              $(".lblmrt").show();
          }
      });
  
  });
   </script>