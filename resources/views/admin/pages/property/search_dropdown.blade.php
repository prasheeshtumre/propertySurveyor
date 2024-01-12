@extends('admin.layouts.main')
@section('content')
<style>
    #ul-container ul li{
        list-style-type: none;
        text-decoration: none;
        width: 100%;
        padding: 5px;
        background-color: #958e8e;
        color: #fff;
        border: 0.2px solid #fff;
    }
    #ul-container ul{
        margin: 0;
        padding: 0px 5px;
    }
</style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" name="" value="" data-url="{{route('search-dropdown')}}" class="form-control search2-dd" id="">
                                <div id="ul-container">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col--lg12">
                <div class="step step-2">
                        <div class="card">
                            <div class="card-body ">
                                <form action="{{ route('surveyor.property.image.store') }}" method="post" id="" enctype="multipart/form-data">
                                    @csrf    
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="files" class="form-label">
                                                Capture Property Images 
                                                <span class="errorcl">*</span></label>
                                            <div class="d-flex justify-content-center flex-column " >
                                                <input type="file" name="files[]" id="files" class="form-control"
                                                    multiple placeholder=" " style="display:none;">
                                                    <label for="files" class="form-label btn btn-outline-secondary upload-images-lab p-0 d-flex align-items-center justify-content-center "> 
                                                        <span class="mdi mdi-tray-arrow-up mdi-24px mx-2"></span>
                                                        <span> Capture Property Images</span></label>
                                                @error('files')
                                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                                @enderror
                                                @error('files.*')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>@php print_r($message); @endphp</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap">
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-warning waves-effect waves-light w_100 " id="">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

    <script>
        $(document).ready(function() {
            $(document).on('input', '.search2-dd', function(){  
                let currnetElement = $(this);
                let url = $(this).data('url');
                let searchKey = $(this).val(); 

                // Create a document fragment       
                var fragment = document.createDocumentFragment();
                var container = document.getElementById('ul-container');
                container.innerHTML = '';
                fragment.innerHtml = '';
                if(searchKey !== ''){
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {search_key : searchKey},
                        success: function(response) {
                            
                           
                            // Create the ul element
                            var ul = document.createElement('ul');

                            // Append li elements to the ul
                            $.each(response.options, function(key, value) {
                                var li = document.createElement('li');
                                li.textContent = value.cat_name;
                                ul.appendChild(li);
                            });

                            // Append the ul to the fragment
                            fragment.appendChild(ul);

                            // Append the fragment to a container element in the DOM
                            
                            container.innerHTML = '';
                            container.appendChild(fragment);
                            fragment.innerHtml = '';
                        }
                    });
                }
                
            });
            // $('.qweryu').searchSuggestions();
            $(document).on('click', '#ul-container ul li', function(){
                // alert($(this).html())
                $(this).closest('#ul-container').parent('div').find('input').val($(this).html());
                var container = document.getElementById('ul-container');
                container.innerHTML = '';
            });
        });
    </script>
   
@endpush
