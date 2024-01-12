@extends('admin.layouts.main')
@section('content')
<style>
 .bbxx1 {
         background-color: #FFF4E0;
    height: 125px;
    align-items: center;
    justify-content: start;
    display: flex;
        border: 5px solid white;
 }
  .bbxx2 {
         background-color: #ceefff;
    height: 125px;
    align-items: center;
    justify-content: start;
    display: flex;
        border: 5px solid white;
 }
 .number-Dashbord {
     margin-top: 15px;
    font-size: 25px;
    font-weight: 600;
 }
</style>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="container">
                <!--Main Dashbaoard-->
                   <div class="row mt-3 mb-3">
                     <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx1" style="">
               <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0"> Total No  Units </p>
                        <p class="number-Dashbord">47</p>
                    </a>  
                   
               </div>   
                
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx2" style="">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0">Vacant  Units  </p>
                         <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div> 
              </div>
            </div>
	    </div>
	     <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx2" style="">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0">Units Availaible Sale </p>
                         <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div> 
              </div>
            </div>
	    </div>
        </div>
                  <!--Main Dashbaoard End--> 
                
                  <!--Units --> 
                  <h4>Units</h4>
                <div class="row">
                     <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx1" style="">
               <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0"> Availaible Units <br> In Commercial </p>
                         <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div>   
                
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx2" style="">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0">Availaible Units <br> In Residential </p> 
                        <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div> 
              </div>
            </div>
	    </div>
        </div> 
    <!--Units End--> 
    
    
    
    <!--Vacants --> 
    <h4>Vacants</h4>
                <div class="row">
                     <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx1" style="">
               <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0"> Availaible Vacant Units <br> In Commercial </p>
                         <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div>   
                
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx2" style="">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0">Availaible Vacant Units <br> In Residential </p> 
                        <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div> 
              </div>
            </div>
	    </div>
        </div> 
    <!--Vacants End--> 
    
    
      <!--Units Availble for Sale --> 
    <h4>Units Availble for Sale</h4>
                <div class="row">
                     <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx1" style="">
               <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0"> Availble for Sale Units <br> In Commercial </p>
                         <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div>   
                
              </div>
            </div>
	    </div>
	    
	    <div class="col-md-4 mt-3">
	        <div class="card shadow ">
              <div class="card-body bbxx2" style="">
                  <div class="d-flex justify-content-between mm_col"> 
                    <a href="#">
                        <p class="text-uppercase fw-bold text-dark text-truncate mb-0"> Availble for Sale <br> In Residential </p> 
                        <p class="number-Dashbord">47</p>
                        </a>  
                   
               </div> 
              </div>
            </div>
	    </div>
        </div> 
    <!-- Availble for Sale End--> 
    
    
    <!--table of Commericial-->
    <div class="card">
        <div class="card-body">
            
     <h4>Availaible Units of Commercials</h4>  
    <table class="table table-bordered table-stripped mt-3 mb-3">
        <thead class="table-primary">
            <tr>
            <th>Sl.no</th>
            <th>Category of the Property</th>
            <th>No of Availaible</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                 <td>Building</td>
                  <td>4</td>
            </tr>
             <tr>
                <td>2</td>
                 <td>Building</td>
                  <td>4</td>
            </tr>
             <tr>
                <td>2</td>
                 <td>Building</td>
                  <td>4</td>
            </tr>
        </tbody>
    </table>
    
        <!--table of Resdential-->
        <h4>Availaible Units of Resdential</h4>
      <table class="table table-bordered table-stripped mt-3 mb-3">
        <thead class="table-primary">
            <tr>
            <th>Sl.no</th>
            <th>Category of the Property</th>
            <th>No of Availaible</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                 <td>Building</td>
                  <td>4</td>
            </tr>
             <tr>
                <td>2</td>
                 <td>Building</td>
                  <td>4</td>
            </tr>
             <tr>
                <td>2</td>
                 <td>Building</td>
                  <td>4</td>
            </tr>
        </tbody>
    </table>
     </div>
    </div>
    
    </div>
    </div>
     </div>
@endsection
@push('scripts')
    <script>
       var next_click=document.querySelectorAll(".next_button");
var main_form=document.querySelectorAll(".main");
var step_list = document.querySelectorAll(".progress-bar li");
var num = document.querySelector(".step-number");
let formnumber=0;

next_click.forEach(function(next_click_form){
    next_click_form.addEventListener('click',function(){
        if(!validateform()){
            return false
        }
       formnumber++;
       updateform();
       progress_forward();
       contentchange();
    });
}); 

var back_click=document.querySelectorAll(".back_button");
back_click.forEach(function(back_click_form){
    back_click_form.addEventListener('click',function(){
       formnumber--;
       updateform();
       progress_backward();
       contentchange();
    });
});

var username=document.querySelector("#user_name");
var shownname=document.querySelector(".shown_name");
 

var submit_click=document.querySelectorAll(".submit_button");
submit_click.forEach(function(submit_click_form){
    submit_click_form.addEventListener('click',function(){
       shownname.innerHTML= username.value;
       formnumber++;
       updateform(); 
    });
});

var heart=document.querySelector(".fa-heart");
heart.addEventListener('click',function(){
   heart.classList.toggle('heart');
});


var share=document.querySelector(".fa-share-alt");
share.addEventListener('click',function(){
   share.classList.toggle('share');
});

 

function updateform(){
    main_form.forEach(function(mainform_number){
        mainform_number.classList.remove('active');
    })
    main_form[formnumber].classList.add('active');
} 
 
function progress_forward(){
    // step_list.forEach(list => {
        
    //     list.classList.remove('active');
         
    // }); 
    
     
    num.innerHTML = formnumber+1;
    step_list[formnumber].classList.add('active');
}  

function progress_backward(){
    var form_num = formnumber+1;
    step_list[form_num].classList.remove('active');
    num.innerHTML = form_num;
} 
 
var step_num_content=document.querySelectorAll(".step-number-content");

 function contentchange(){
     step_num_content.forEach(function(content){
        content.classList.remove('active'); 
        content.classList.add('d-none');
     }); 
     step_num_content[formnumber].classList.add('active');
 } 
 
 
function validateform(){
    validate=true;
    var validate_inputs=document.querySelectorAll(".main.active input");
    validate_inputs.forEach(function(vaildate_input){
        vaildate_input.classList.remove('warning');
        if(vaildate_input.hasAttribute('require')){
            if(vaildate_input.value.length==0){
                validate=false;
                vaildate_input.classList.add('warning');
            }
        }
    });
    return validate;
    
}
    </script>
@endpush
