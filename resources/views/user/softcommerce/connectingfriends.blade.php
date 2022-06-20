@extends('user.layouts.userMaster')

@push('css')
    <style>
        @media only screen and (max-width: 714px) {
            iframe{
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            overflow: hidden;
            }
        }

    </style>
@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="row">
                @if (isset($websiteParameter->connecting_friends_notice))
                <div class="col-12 ">
                   <div class="card">
                       <div class="card-header">Important Notice</div>
                       <div class="card-body">
                          
                               <p class="text-center m-auto" > {!! $websiteParameter->connecting_friends_notice !!} </p>
                          
                       </div>
                   </div>
                </div>
                @endif
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 col-sm-mb-5">
                                    @if($referall)
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
                            
                                            <div class="info-box-content">
                                            <span class="info-box-text">Share your Reffarel Link</span>
                                            <span class="info-box-number">
                                                <small style="max-width:140px !important;"><b>
                                                {{ url('/reffer') }} <br>
                                                {{ '/'.$referall->subscription_code }}
                                                </b>
                            
                                                </small>
                            
                                                <br>
                                                <button class="copyboard btn btn-primary btn-xs" data-text="{{route('welcome.pf',['reffer'=> $referall->subscription_code])}}">Copy to Clipboard</button>
                                            </span>
                            
                            
                            
                            
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 ">
                                    <div class="bg-info text-center d-flex align-items-center justify-content-center py-3"
                                        style="border-radius: 2%">
                                        <a href="{{ route('user.makeServiceProfile') }}">
                                            <div class="textscontent-saif text-center">
                                                <div class="textcontent1-saif text-center">
                                                    <i class="fas fa-share fa-2x"></i>
                                                    <h3>Create service/business profile</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <br>
    </section>
@endsection


@push('js')
<script>

	$(function(){

$(document).on('click', '.copyboard', function(e) {
  e.preventDefault();


  $(".copyboard").text('Copy to Clipboard');

  $(this).text('Coppied!');
  var copyText = $(this).attr('data-text');

  var textarea = document.createElement("textarea");
  textarea.textContent = copyText;
  textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand("copy");

  document.body.removeChild(textarea);
});

	});
</script>
@endpush
