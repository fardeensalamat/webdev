@extends('user.layouts.userMaster')

@push('css')
 

@endpush
@section('content')

<section class="content">
 
    <br>
        
<div class="row">
    <div class="col-md-12 ">

        <div class="card card-primary card-outline">
            <div class="card-body p-2">
                <h3 class="card-title ">Soft Market</h3>
            </div>
        </div>
 
        
    </div>
</div>



<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3">
         <div class="card card-widget mt-1">
             <div class="card-body p-1">

                <div class="input-group ">
                    <input type="text" value="{{ $selectedCat ? $selectedCat->name:null }}" data-url="{{ route('user.searchLeftCategoryAjax') }}" class="form-control ajax-data-search" placeholder="Category Search" aria-label="Category Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                    </div>
                  </div>
             </div>
         </div>
    </div>
</div>

<div class="row">
    <div class="col-4 col-md-3">
        <div class="card card-widget">
            <div class="card-body p-1" >
                <div class="cat-content-div p-1 ajax-data-container">
                    @include('user.softmarkets.includes.leftSideCategoryList')
                </div>
            </div>
        </div>
    </div>

    <div class="col-8 col-md-9 col-lg-9">
        <div class="row">
         @foreach ($shops as  $cat)
          
                @include('user.softmarkets.includes.shopCardSmall')
         @endforeach

         {{ $shops->render() }}
        </div>
    </div>
</div>


 
</div>


 
@endsection


@push('js')
<script type="text/javascript" src="{{ asset('cp/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();


            $(function(){
                $('.cat-content-div').slimScroll({
                    height: '500px',
                    size: '4px',
                });
            });

        });
    </script>

@endpush
