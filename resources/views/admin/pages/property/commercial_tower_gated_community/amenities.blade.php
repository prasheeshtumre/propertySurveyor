<style>
    .addpuls{
            background: #662e93;
    padding: 2px 6px;
    border-radius: 3px;
    color: white;
    font-size: 14px;
    margin-left: 5px;
    }
    .brder_round .row {
            border: 1px solid #000;
    border-radius: 3px;
    margin: 10px 0px;
    padding: 15px 0px;
    }
    span.remove-storey, span.remove-storey-unit {
        position: absolute;
    top: 2.5%;
    left: 96.5%;
    width: 20px;
    cursor: pointer;
}
.brder_round {
        position: relative;
}
</style>

@extends('admin.layouts.main')
@section('content')
  

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Gated Community Details</h4>

                        {{--                         
                            <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic  Elements</li>
                            </ol>
                            </div> 
                        --}}


                    </div>
                </div>
            </div>
            <!-- end page title -->
            
                <div class="row">
                    <div class="col-xl-12 col-md-12">
<!--APARTMENT Category-->
                        <div class="card"  style="">
                            
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 ">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id" placeholder="EX:7255158845" value="" onkeypress="return isNumber(event)">
                                        </div>
                                        <div>
                                            <button class="btn btn-success add-floor" type="button" id="btn-search-gis-id">Search</button>
                                        </div>
                                    </div>
                                </div>
                                    <div id="defined_block"></div>
                                     
                                     <div class="brder_round">
                                         <div class="row">
                                            <div class="col-xxl-3 col-md-3 ">
                                                  <label for="" class="form-label">No of Blocks <span class="errorcl">*</span> </label>
                                              <div class="input-group ">
                                              <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Blocks" aria-label="" aria-describedby="button-addon2">
                                              <div class="input-group-append">
                                                <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Blocks</button>
                                              </div>
                                            </div>
                                            </div>
                                            
                                             <div class="col-xxl-3 col-md-3">
                                                  <label for="" class="form-label">Name of the Block  </label>
                                                  <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="" aria-label="" aria-describedby="button-addon2">
                                            </div>
                                            <span class="remove-storey">
                                               <span class="mdi mdi-minus-box-outline mdi-18px"></span>
                                            </span>
                                            </div>
                                            </div>
                                            
                                   
                                      <div class="brder_round">
                                     <div class="row">
                                     <div class="col-xxl-3 col-md-3 ">
                                        <div>
                                            <label for="" class="form-label">No of Towers for Block 1 </label>
                                            <div class="input-group ">
                                      <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Towers" aria-label="" aria-describedby="button-addon2">
                                      <div class="input-group-append">
                                        <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Towers</button>
                                      </div>
                                    </div>
                                   
                                                                                    </div>
                                    </div>
                                     <div class="col-xxl-3 col-md-3 ">
                                          <label for="" class="form-label">Name of the Tower  </label>
                                          <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="" aria-label="" aria-describedby="button-addon2">
                                    </div>
                                     <span class="remove-storey">
                                               <span class="mdi mdi-minus-box-outline mdi-18px"></span>
                                            </span>
                                     </div>
                                      </div>
                                      
                                        <div class="brder_round">
                                     <div class="row">
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="" class="form-label">No of Floors for Tower 1<span class="errorcl">*</span> </label>
                                           <div class="input-group ">
                                      <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
                                      <div class="input-group-append">
                                        <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Floors</button>
                                      </div>
                                    </div>
                                     </div>
                                        </div>
                                         <div class="col-xxl-3 col-md-3">
                                                  <label for="" class="form-label">Name of the Floor</label>
                                                  <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="" aria-label="" aria-describedby="button-addon2">
                                            </div>
                                             <span class="remove-storey">
                                               <span class="mdi mdi-minus-box-outline mdi-18px"></span>
                                            </span>
                                    </div>
                                     </div>
                                     
                                       <div class="brder_round">
                                     <div class="row">
                                      <div class="col-xxl-3 col-md-3 ">
                                        <div>
                                            <label for="" class="form-label">No of Units for Floor 1 <span class="errorcl">*</span> </label>
                                            <div class="input-group ">
                                      <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Units" aria-label="" aria-describedby="button-addon2">
                                      <div class="input-group-append">
                                        <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Units</button>
                                      </div>
                                    </div>
                                                                                    </div>
                                    </div>
                                    
                                     <div class="col-xxl-3 col-md-3">
                                                  <label for="" class="form-label">Name of the Unit  </label>
                                                  <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="" aria-label="" aria-describedby="button-addon2">
                                            </div>
                                             <span class="remove-storey">
                                               <span class="mdi mdi-minus-box-outline mdi-18px"></span>
                                            </span>
                                       </div>
                                       </div>
                                       
                                       
                                <div class="row">
                                     <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label"> Unit Name  </label>
                                            <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                                                                    </div>
                                    </div>
                                    </div>
                                     <div class="row">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label"> Year of Construction </label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected="">-Select Category-</option>
                                              <option selected="">1920</option>
                                            </select>
                                         </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3  mb-3">
                                        <div>
                                            <label for="" class="form-label">Status of the project<span class="errorcl">*</span></label>
                                            <select class="form-select" name="project_status" id="project_status">
                                                <option selected="">-Select project status-</option>
                                                @forelse($project_status as $key => $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                @empty
                                                    <option value="">Not Found</option>
                                                @endforelse
                                                
                                            </select>
                                         </div>
                                    </div>
                                     <div class="col-xxl-3 col-md-3  mb-3">
                                        <div>
                                            <label for="" class="form-label">In Under Construction<span class="errorcl">*</span></label>
                                            <select class="form-select" name="under_construction" id="under_construction">
                                                <option selected="">-Select under construction-</option>
                                                @forelse($under_construction as $key => $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                @empty
                                                    <option value="">Not Found</option>
                                                @endforelse
                                             </select>
                                         </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3  mb-3">
                                        <div>
                                            <label for="" class="form-label">In Slab completed<span class="errorcl">*</span></label>
                                             <input  type="date" class="form-control " name="slab_completed" id="slab_completed" placeholder="" value="">
                                         </div>
                                    </div>
                                </div>
                                <div class="mb-3 mb-3">
                                    <h4 class="mb-3">Amenities Details <small><i>(Optional)</i></small></h4>
                                    <label class="form-label small-heading">{{$amenities->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($amenities_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Amenities Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>

                                    <label class="form-label small-heading">{{$property_features->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($property_features_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Property Features Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>


                                    <label class="form-label small-heading">{{$society_building_features->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($society_building_features_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Society/Building features Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>

                                    <label class="form-label small-heading">{{$additonal_features->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($additional_features_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Additional Features Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    <label class="form-label small-heading">{{$water_source->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($water_source_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Water Source Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    <label class="form-label small-heading">{{$overlooking->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($overlooking_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Overlooking Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    <label class="form-label small-heading">{{$other_features->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($other_features_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Other Features Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    <label class="form-label small-heading">{{$power_backup->name}}</label>
                                    <div class="row align-items-center mb-2">
                                        @forelse($power_backup_options as $key => $val)
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    <input type="checkbox" value=""> {{$val->name}}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="col-md-2 simplecheck mb-3">
                                                <span>
                                                    No Power Back up Found
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>

                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-4 simplecheck mb-3">
                                             <label class="form-label">Type of Floor</label>
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option value="">Select</option>
                                                    @forelse($floor_type as $key=>$val)
                                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                                    @empty
                                                        <option value="">No Type of Floors Found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <label class="form-label">Width of Facing road</label>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4">
                                            <div class="box-bdr">
                                                <div class="row d-flex">
                                                    <div class="col-md-7 mb-3">
                                                        <input type="text" class="form-control form-control-b0 col-md-3 border-none" name="" id="" placeholder="Width of Facing road">
                                                    </div>
                                                    <div class="col-md-5 mb-3 ms-auto" style="border-left: solid 1px #ddd">
                                                        <select class="form-select form-control-b0">
                                                            <option value="">Select</option>
                                                            <option value="">Feet</option>
                                                            <option value="">Meter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <label class="form-label">Location Advantages</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Metro Station
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to school
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Hospital
                                            </span>
                                        </div>
                                        
                                        
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Market
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Railway Station
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Airport
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Mall
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Highway
                                            </span>
                                        </div>
                                    </div>
                                    
                                  
                                </div>
                                
                                <div class="mb-3 ">
                                    <h4 class="mb-3">Compliances </h4>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label">RERA Number </label>
                                          <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                                                                    </div>
                                    </div>
                                  
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                          RERA Approval Copy </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add RERA Approval Copy</span></label>
                                      </div>

                                    </div>

                                    </div>
                                     <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label">DTCP/HMDA Number  </label>
                                            <input  type="text" name="" class="form-control " id="" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                         DTCP/HMDA Approval Copy</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span>Add  DTCP/HMDA Approval Copy</span></label>
                                      </div>

                                    </div>

                                    </div>
                                     <div class="col-xxl-3 col-md-3 mb-3">
                                         <div>
                                             <label>
                                                Commencement Certificate
                                             </label>
                                       <div>
                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                            <label for="html">Yes</label>
                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                            <label for="css">No</label>
                                            </div>
                                    </div>
                                       </div>
                                       
                                       <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        Commencement Certificate</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add  Commencement Certificate</span></label>
                                      </div>

                                    </div>

                                    </div>
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                         <div>
                                             <label>
                                               GHMC Approval
                                             </label>
                                       <div>
                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                            <label for="html">Yes</label>
                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                            <label for="css">No</label>
                                            </div>
                                    </div>
                                       </div>
                                       
                                          <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                       GHMC Approval Copy</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add  GHMC Approval Copy</span></label>
                                      </div>

                                    </div>

                                    </div>
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        Legal Documents</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add  Legal Documents</span></label>
                                      </div>

                                    </div>

                                    </div>
                                    </div>
                              </div>
                              
                      
                                <div class="mb-3 ">
                                    <h4 class="mb-3"> Project Repository </h4>
                                    <div class="row align-items-center mb-2">
                                          <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        Project Brochure</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;" >
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span>  Add Project Brochure</span></label>
                                      </div>

                                    </div>

                                    </div>
                                  
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label"> Project Promotional Video</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <sprpan class="mdi mdi-plus "></span> <span> Add Project Promotional Video </span></label>
                                      </div>

                                    </div>

                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                         Images</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <sprpan class="mdi mdi-plus "></span> <span> Add Images</span></label>
                                      </div>

                                    </div>

                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        3D View Video
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add 3D View Video</span></label>
                                      </div>

                                    </div>

                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                       All Floor Plans
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add All Floor Plans</span></label>
                                      </div>

                                    </div>

                                    </div>
                                     
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="" class="form-label">
                                        Website Address </label>
                                        <input type="text" class="form-control no_of_floors">
                                    </div>

                                    </div>
                                    </div>
                                     </div>
                                    
                                    <div class="row">
                                        <h4 class="mb-3"> Others <span class="addpuls"> <i class="fa-solid fa-plus"></i> </span></h4>
                                         <div class="col-xxl-2 col-md-2 ">
                                            <div class="form-group mb-3">
                                                <label for="files" class="form-label">   Enter the Name </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                         <div class="col-xxl-2 col-md-2 ">
                                            <div class="form-group mb-3">
                                                <label for="files" class="form-label">  Upload (PDF, Images) </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                      <div class="row mb-3">
                                        <h4 class="mb-3"> Block/Tower Repository  </span></h4>
                                         <div class="col-xxl-3 col-md-3 mb-3"> 
                                            <div>
                                            <label for="" class="form-label">Select Block/Tower</label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected="">-Select Category-</option>
                                               
                                            </select>
                                         </div>
                                        </div>
                                          <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                       Floor Plan
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add Floor Plan</span></label>
                                      </div>

                                      </div>
                                     </div>
                                     <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                      Images
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add Images</span></label>
                                      </div>

                                    </div>
                                        
                                    </div>
                                    
                                    <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                      3D View Video
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add 3D View Video</span></label>
                                      </div>

                                    </div>
                                        
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                      Tower Video
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add Tower Video</span></label>
                                      </div>

                                    </div>
                                        
                                    </div> 
                                    </div>
                                    
                                      <div class="row mb-3">
                                        <h4 class="mb-3"> Others <span class="addpuls"> <i class="fa-solid fa-plus"></i> </span></h4>
                                         <div class="col-xxl-2 col-md-2 ">
                                            <div>
                                                <label for="files" class="form-label">   Enter the Name </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                         <div class="col-xxl-2 col-md-2">
                                            <div>
                                                <label for="files" class="form-label">  Upload (PDF, Images) </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="text-end">
                                               <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    
                              </div>
                              </div>
                              
                            </div>
 <!--INDEPENDENT HOUSE/VILLA-->   
      <div class="col-xl-12 col-md-12">
                      <div class="card p-0">
                             <div class="card-body ">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 mb-3"> 
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id" placeholder="EX:7255158845" value="" onkeypress="return isNumber(event)">
                                                                                    </div>
                                    </div>
                                    </div>
                                     <div class="row">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                          <label for="" class="form-label"> No of Blocks <span class="errorcl">*</span> </label>
                                      <div class="input-group ">
                                      <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Blocks" aria-label="" aria-describedby="button-addon2">
                                      <div class="input-group-append">
                                        <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Blocks</button>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                                  <label for="" class="form-label">Name of the Block  </label>
                                                  <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="" aria-label="" aria-describedby="button-addon2">
                                            </div>
                                    </div>
                                
                                     <div class="row">
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label">No of Units for Block 1 <span class="errorcl">*</span> </label>
                                            <div class="input-group ">
                                      <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Units" aria-label="" aria-describedby="button-addon2">
                                      <div class="input-group-append">
                                        <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Unit</button>
                                      </div>
                                    </div>
                                       </div>
                                    </div>
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                                  <label for="" class="form-label">Name of the Unit </label>
                                                  <input type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="" aria-label="" aria-describedby="button-addon2">
                                            </div>
                                       </div>
                                <div class="row">
                                     <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label"> Unit Name  </label>
                                            <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                                                                    </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label"> Year of Construction </label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected="">-Select Category-</option>
                                              <option selected="">1920</option>
                                            </select>
                                         </div>
                                    </div>
                                    
                                    <div class="col-xxl-3 col-md-3  mb-3">
                                        <div>
                                            <label for="" class="form-label">Status of the project<span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected="">-Select Category-</option>
                                                <option selected="">Grounded</option>
                                                <option selected="">Under Construction</option>
                                                <option selected="">Completed</option>
                                            
                                                
                                            </select>
                                         </div>
                                    </div>
                                    
                                     <div class="col-xxl-3 col-md-3  mb-3">
                                        <div>
                                            <label for="" class="form-label">In Under Construction<span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected="">-Select Category-</option>
                                                <option selected="">Foundation completed</option>
                                                <option selected="">Slab Completed</option>
                                             </select>
                                         </div>
                                    </div>
                                    
                                    <div class="col-xxl-3 col-md-3  mb-3">
                                        <div>
                                            <label for="" class="form-label">In Slab completed<span class="errorcl">*</span></label>
                                             <input  type="date" class="form-control " id="" placeholder="" value="">
                                         </div>
                                    </div>
                                
                                <div class="mb-3 mb-3">
                                    <h4 class="mb-3">Amenities Details <small><i>(Optional)</i></small></h4>
                                    <label class="form-label small-heading">Amenities</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Maintenance Staff
                                            </span>
                                        </div>

                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Water Storage
                                            </span>
                                        </div>

                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Security/Fire Alarm
                                            </span>
                                        </div>

                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Visitor Parking
                                            </span>
                                        </div>

                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Feng Shui/Vaastu Compliant
                                            </span>
                                        </div>

                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Park
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Intercom Facility
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Lift(s) </span>
                                        </div>
                                    </div>

                                    <label class="form-label small-heading">Property Features</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> High Ceiling Height
                                            </span>
                                        </div>


                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> False Ceiling Lighting
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Piped-gas
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Internet/wifi connectivity
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Centrally Air Conditioned
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Water purifier
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Recently Renovated
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Private Garden/Terrace
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Natural Light
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Airy Rooms
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Spacious Interiors
                                            </span>
                                        </div>


                                    </div>


                                    <label class="form-label small-heading">Society/Building features</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Water softening plant
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Shopping Centre
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Fitness Centre/GYM
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Swimming Pool
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Club house/Community Center
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Tennis Court(s)
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Squash Court
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Kids' Play Areas
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Jogging / Cycle Track
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Attached Market
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Home Automation
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Security Personnel
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Badminton Court(s)
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Conference Room
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Multiplex
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> ATM's
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Barbeque Area
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Double Glazed Windows
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Facilities for Disabled
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Cleaning Services
                                            </span>
                                        </div>

                                    </div>

                                    <label class="form-label small-heading">Additional Features</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Separate entry for servant room
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Waste Disposal
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> No open drainage around
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Rain Water Harvesting
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Bank Attached Property
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Low Density Society
                                            </span>
                                        </div>
                                    </div>


                                    <label class="form-label small-heading">Water Source</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Municipal corporation
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Borewell/Tank
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> 24*7 Water
                                            </span>
                                        </div>
                                    </div>

                                    <label class="form-label small-heading">Overlooking</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Pool
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Park/Garden
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Club
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Main Road
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Others
                                            </span>
                                        </div>
                                    </div>

                                    <label class="form-label small-heading">Other Features</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> In a gated society
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Corner Property
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Pet friendly
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Wheelchair friendly
                                            </span>
                                        </div>
                                    </div>

                                    <label class="form-label small-heading">Power Back up</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> None
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Partial
                                            </span>
                                        </div>
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Full
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-4 simplecheck mb-3">
                                            <label class="form-label">Type of Floor</label>
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option value="">Select</option>
                                                    <option value="">Marble</option>
                                                    <option value="">Concrete</option>
                                                    <option value="">Polished Concrete</option>
                                                    <option value="">Granite</option>
                                                    <option value="">Ceramic</option>
                                                    <option value="">Mosaic</option>
                                                    <option value="">Cement</option>
                                                    <option value="">Stone</option>
                                                    <option value="">Vinyl</option>
                                                    <option value="">Wood</option>
                                                    <option value="">Vitrified</option>
                                                    <option value="">Spartex</option>
                                                    <option value="">IPS Finish</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <label class="form-label">Width of Facing road</label>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4">
                                            <div class="box-bdr">
                                                <div class="row d-flex">
                                                    <div class="col-md-7 mb-3">
                                                        <input type="text" class="form-control form-control-b0 col-md-3 border-none" name="" id="" placeholder="Width of Facing road">
                                                    </div>
                                                    <div class="col-md-5 mb-3 ms-auto" style="border-left: solid 1px #ddd">
                                                        <select class="form-select form-control-b0">
                                                            <option value="">Select</option>
                                                            <option value="">Feet</option>
                                                            <option value="">Meter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <label class="form-label">Location Advantages</label>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Metro Station
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to school
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Hospital
                                            </span>
                                        </div>
                                        
                                        
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Market
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Railway Station
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Airport
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Mall
                                            </span>
                                        </div>
                                        <div class="col-md-3 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" value=""> Close to Highway
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3 mb-3">
                                    <h4 class="mb-3">Compliances </h4>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label">RERA Number </label>
                                          <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                                                                    </div>
                                    </div>
                                  
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                          RERA Approval Copy </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add RERA Approval Copy</span></label>
                                      </div>

                                    </div>

                                    </div>
                                     <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="" class="form-label">DTCP/HMDA Number  </label>
                                            <input  type="text" name="" class="form-control " id="" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                         DTCP/HMDA Approval Copy</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span>Add  DTCP/HMDA Approval Copy</span></label>
                                      </div>

                                    </div>

                                    </div>
                                     <div class="col-xxl-3 col-md-3 mb-3">
                                         <div>
                                             <label>
                                                Commencement Certificate
                                             </label>
                                       <div>
                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                            <label for="html">Yes</label>
                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                            <label for="css">No</label>
                                            </div>
                                    </div>
                                       </div>
                                       
                                       <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        Commencement Certificate</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add  Commencement Certificate</span></label>
                                      </div>

                                    </div>

                                    </div>
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                         <div>
                                             <label>
                                               GHMC Approval
                                             </label>
                                       <div>
                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                            <label for="html">Yes</label>
                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                            <label for="css">No</label>
                                            </div>
                                    </div>
                                       </div>
                                       
                                          <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                       GHMC Approval Copy</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add  GHMC Approval Copy</span></label>
                                      </div>

                                    </div>

                                    </div>
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        Legal Documents</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add  Legal Documents</span></label>
                                      </div>

                                    </div>

                                    </div>
                                    </div>
                              </div>
                              
                      
                                <div class="mb-3 mb-3">
                                    <h4 class="mb-3"> Project Repository </h4>
                                    <div class="row align-items-center mb-2">
                                          <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        Project Brochure</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;" >
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span>  Add Project Brochure</span></label>
                                      </div>

                                    </div>

                                    </div>
                                  
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label"> Project Promotional Video</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <sprpan class="mdi mdi-plus "></span> <span> Add Project Promotional Video </span></label>
                                      </div>

                                    </div>

                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                         Images</label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <sprpan class="mdi mdi-plus "></span> <span> Add Images</span></label>
                                      </div>

                                    </div>

                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                        3D View Video
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add 3D View Video</span></label>
                                      </div>

                                    </div>

                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="files" class="form-label">
                                       All Floor Plans
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add All Floor Plans</span></label>
                                      </div>

                                    </div>

                                    </div>
                                     
                                      <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="" class="form-label">
                                        Website Address </label>
                                        <input type="text" class="form-control no_of_floors">
                                    </div>

                                    </div>
                                    </div>
                                     </div>
                                    
                                    <div class="row">
                                        <h4 class="mb-3"> Others <span class="addpuls"> <i class="fa-solid fa-plus"></i> </span></h4>
                                         <div class="col-xxl-2 col-md-2 mb-3 ">
                                            <div class="form-group">
                                                <label for="files" class="form-label">   Enter the Name </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                         <div class="col-xxl-2 col-md-2 mb-3 ">
                                            <div class="form-group">
                                                <label for="files" class="form-label">  Upload (PDF, Images) </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                      <div class="row mb-3">
                                        <h4 class="mb-3"> Block/Tower Repository  </span></h4>
                                         <div class="col-xxl-3 col-md-3 mb-3"> 
                                            <div>
                                            <label for="" class="form-label">Select Block/Tower</label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected="">-Select Category-</option>
                                               
                                            </select>
                                         </div>
                                        </div>
                                          <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                       Floor Plan
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add Floor Plan</span></label>
                                      </div>

                                      </div>
                                     </div>
                                     <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                      Images
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add Images</span></label>
                                      </div>

                                    </div>
                                        
                                    </div>
                                    
                                    <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                      3D View Video
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add 3D View Video</span></label>
                                      </div>

                                    </div>
                                        
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3"> 
                                         <div>
                                        <label for="files" class="form-label">
                                      Tower Video
                                           </label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple="" placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Add Tower Video</span></label>
                                      </div>

                                    </div>
                                        
                                    </div> 
                                    </div>
                                    
                                      <div class="row mb-3">
                                        <h4 class="mb-3"> Others <span class="addpuls"> <i class="fa-solid fa-plus"></i> </span></h4>
                                         <div class="col-xxl-2 col-md-2 ">
                                            <div class="form-group mb-3">
                                                <label for="files" class="form-label">   Enter the Name </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                         <div class="col-xxl-2 col-md-2">
                                            <div class="form-group mb-3">
                                                <label for="files" class="form-label">  Upload (PDF, Images) </label>
                                                  <input type="text" name="" class="form-control " id="" placeholder="" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="text-end">
                                               <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                     </div> 
                              </div> 
                               </div> 
  <!--PLOT/LAND-->                            


                        </div>

                    </div>

                <!--</div>-->

                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="loader-container d-none">
                                <div class="loader-circle-2"></div>
                            </div>
                          


                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="create_success" aria-labelledby="exampleModalToggleLabel" tabindex="-1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="success alert">
                            <div class="alert-body">
                                <h2>Property Added Successfully</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-brand-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Brand </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('surveyor.brand.store') }}" method="post" class="add-brand-frm" >
          <div class="modal-body">
                 <input type="text" value="" id="brand_parent_id" name="parent_id" class="" >
                <div class="row">
                    <div class="col-auto ">
                        <label for="" class="form-label">Concerned Person Name</label>
                        <input type="text" value="" name="brand_name" class="form-control form-control-sm" >
                    </div>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>

<script>
</script>
    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
	
 <script>
     $(document).on('click', '#btn-search-gis-id', function(e) {
            let gis_id = $("#gis_id").val();
            if(gis_id == ''){
                 toastr.error('Please enter GIS ID');
                 return false
            }else{
                $.ajax({
                type: "GET",
                url: "{{ url('surveyor/property/get_secondary_defined_block') }}",
                data: {gis_id:gis_id},
                success: function(response) {
                    if(response.status === false){
                        toastr.error(response.message);
                        $('#defined_block').empty();
                    }else{
                        $('#defined_block').html(response);
                    }
                    
                }
            });
            }
            
        });
 </script>
 <script>
       // generate floors using add floor button
        $(document).on('click', ".add-floor", function(){
            let currentStoreyCount = $('.storey').length;
            let count = ($('.no_of_floors').val() == '') ? 0 : parseInt($('.no_of_floors').val());
            // alert(count)
            if(count < 1){
                toastr.error('please enter valid floor count');
                return false
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count) ;
            let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalFloors = '';
            $('.loader-container').removeClass('d-none');
            
            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getFloors(start index, finalCount)
            totalFloors = getFloors(currentStoreyCount, finalCount);
            (currentStoreyCount > 0 ) 
            ? (
                $(totalFloors).insertAfter($(".storey:last-child"))
                ) 
            : $(totalFloors).insertAfter( $(this).closest(".append-floors") );
            $(".remove-storey").each(function(){
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none') : '';
            })
            $(".remove-storey").last().removeClass('d-none');
            $('.floor_unit_type_dd').select2();
            $('.no_of_floors').val($('.storey').length);
        });
          function getFloors(startIndex, count){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get_floors') }}",
                data:{c_id : c_id, count : count, start_index : startIndex},
                success: function(response) {
                    temp_floors = response;
                    $('.loader-container').addClass('d-none');
                }
            });
            
            return temp_floors;
        }
 </script>
 
 
    <script>
        @foreach ($errors->all() as $error)
            // toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            $(function() {
                $('#create_success').modal('show');
            })
        @endif
    </script>
    <script>
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
   
    @endpush