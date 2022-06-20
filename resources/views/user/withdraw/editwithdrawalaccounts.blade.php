@extends('user.layouts.userMaster')
@push('css')
@endpush
@section('content')
    <section class="content">
        <br>

        <div class="row">
      
            <div class="col-sm-12">
      
      
      @include('alerts.alerts')
      
      
      
      
      
                  <div class="card card-widget">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span class="badge badge-light">
                        
                       Edit Withdrawal Account
      
                      </span> 
                  </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">
      
      
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-body">
                          <form method="POST" action="{{ route('user.withdrawalaaccountupdate',$data->id) }}" enctype="multipart/form-data">
                              @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="name" name='name' type="text" class="form-control @error('name') is-invalid @enderror" value="{{$data->name}}" placeholder="Ex: Oli Ullah">
                                        <input id="id" name='id' type="hidden" class="form-control @error('name') is-invalid @enderror" value="{{$data->id}}">
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{$data->number}}" placeholder="Ex: 017XXXXXXXXX">
        
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>
        
                                    <div class="col-md-6">
                                      <select name="type" id="type" class="form-control" >
                                          <option value="Bkash" {{ $data->type == 'Bkash' ? 'selected' : '' }}>Bkash</option>
                                          <option value="Rocket" {{ $data->type == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                                          <option value="Nagad"  {{ $data->type == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                                          <option value="Upay"  {{ $data->type == 'Upay' ? 'selected' : '' }}>Upay</option>
                                      </select>
        
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="current_password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Enter password for verify">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pin_for_recharge"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Pin') }}</label>

                                    <div class="col-sm-6">
            
                                            <input type="tel" min="1" step="1"
                                                name="pin"
                                                class="form-control pin_for_recharge pin-check"
                                                id="pin_for_recharge"
                                                placeholder="4 digit pin number"
                                                autocomplete="no"
                                                data-url="{{ route('user.pinCheck') }}">

                                            <span
                                                class="glyphicon  form-control-feedback"
                                                style="display: none;"></span>

                                            <small
                                                class="help-block feedback-display">&nbsp;</small>


                                    </div>
                                </div>


                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Add') }}
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
                      
                    </div>
                  </div>
                </div>
              </div>
    
    </section>
@endsection


@push('js')

<script>
$(document).on('keyup', '.pin-check', function(e){

e.preventDefault();
var that = $(this),
    url = that.attr('data-url');
    // alert(that.val());

    

      delay(function(){  
      
    $.ajax({
      url: url + '?pin=' + that.val(),
      type: 'GET',
      dataType: 'json',
      beforeSend: function()
      {
          // $(".placement-loading").show();

          that.closest('.form-group').removeClass('has-feedback has-error has-success');
    that.next(".form-control-feedback").hide().removeClass('glyphicon-remove glyphicon-ok');


      },
      complete: function()
      {
          // $(".placement-loading").hide();
      },
    })
      .done(function(response) {



        if(response.success)
        {
            that.closest('.form-group').addClass('has-feedback has-success');
            that.next(".form-control-feedback").show().addClass('glyphicon-ok');
            $(".feedback-display").text(response.feedback);

        }else{
            that.closest('.form-group').addClass('has-feedback has-error');
            that.next(".form-control-feedback").show().addClass('glyphicon-remove');
            $(".feedback-display").text(response.feedback);
            // $(".feedback-display").text(response.feedback + ' | ' + response.errors.pin);

        }

        

      })
      .fail(function() {});
      }, 800);
});


</script>



@endpush

