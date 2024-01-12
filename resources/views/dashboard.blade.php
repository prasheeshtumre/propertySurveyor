@include('header');

<div class="container" >
    
 


<!--<div class="d-flex">	-->
<!--      <div class="text-start">	-->
<!--     	 <h4> Dashboard </h4>-->
<!--     </div>	-->
     
<!--     <div>-->
             
<!--     </div>-->
 
<!-- </div>-->
 
	<div class="row mt-5 mt-sm-0">
	    
	    <div class="col-md-3 mt-3">
	        <div class="card shadow bbxx1">
              <div class="card-body">
               <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> PROPERTY TAX <br> SERVICES </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/property_tax.png') }}">
                    </div>
               </div>   
                
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-3">
	        <div class="card shadow bbxx2">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> Advertisement <br>
PERMISSIONS
 </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/advertisement.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-3">
	        <div class="card shadow bbxx3">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> WATER DEPT <br>
SERVICES</a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/waterdrop.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-3">
	        <div class="card shadow bbxx4">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> GARDEN <br>
DEPT SERVICES </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/gradening.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-4">
	        <div class="card shadow bbxx5">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> TOWN PLANNING <br>
DEPT. </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/townplanning.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-4">
	        <div class="card shadow bbxx6">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> ANIMAL HUSBANDRY <br>
LICENSES </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/animal_hus.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-4">
	        <div class="card shadow bbxx7">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> DRAINAGE <br>
CONNECTIONS </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/drainage.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    
	    <div class="col-md-3 mt-4">
	        <div class="card shadow bbxx8">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="{{url('health-department')}}"> HEALTH DEPT  <br>
SERVICES </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/health_dept.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-3 mt-4">
	        <div class="card shadow bbxx9">
              <div class="card-body">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#"> NOC SERVICES <br>
(FIRE DEPT.) </a>  
                    <div class="wtt_">
                        <img src="{{ asset('public/images/noservice.png') }}">
                    </div>
               </div> 
              </div>
            </div>
	    </div>
	    
  
	    
	    
	</div>
	
	
	
	
	
	
	
</div>

 <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->

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














</body>
</html>


