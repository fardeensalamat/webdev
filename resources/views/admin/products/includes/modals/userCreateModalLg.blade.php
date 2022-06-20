


<!-- Modal content-->
<div class="modal-content w3-round">       
  <div class="modal-body-s">







    <div class="card card-widget">
        <div class="card-header with-border">
          <h3 class="card-title">New Member Create</h3>
          <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
      </div>
      <div class="card-body w3-light-gray pb-0 ">


        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
                <div class="card card-widget">
                    <div class="card-body">
 
                        
{{-- <div class="form-group has-feedback{{ $errors->has('user') ? ' has-error' : '' }}"> --}}
<label for="user"> {{ __('User (Lead Owner)') }}:</label>
<div class="input-group mb-3">
<select id="user"
name="user"
class="form-control user-select select2-container step2-select select2"
data-placeholder="Mobile or Email"
data-ajax-url="{{route('user.selectUser')}}"
data-user-add="{{ route('admin.leadOwnerIdAdd',['product'=>$product]) }}"
data-ajax-cache="true"
data-ajax-dataType="json"
data-ajax-delay="200"
style="">
@if($product->user)
<option value="{{ $product->user_id }}">{{ $product->user->mobileOrEmail() }}</option>
@endif
</select>
<div class="input-group-append">
    
    {{-- <button class="btn btn-primary" type="button"><i class="fa fa-save"></i></button> --}}

    <a href="" class="btn btn-default new-user-create-form-open" ><i class="fa fa-user-plus"></i></a>

</div>
{{-- @if( $errors->has('user') )
<span class="help-block">{{ $errors->first('user') }}</span>
@endif --}}
</div>

                    </div>
                </div>

    <div class="lead-owner-new-container float-left w-100" style="display: none;">
         @include('admin.leads.includes.forms.newUserForm')
    </div>


    <div class="lead-owner-sources-container float-left w-100">
        @if($product->user)
        @include('admin.products.ajax.userSourcesSelect')
        @endif
    </div>


                


            </div>
        </div>


 

</div>

  <div class="overlay modal-feed"><i class="fas fa-2x fa-sync-alt fa-spin w3-xxxlarge w3-text-blue"></i>
            </div>

 
</div>




</div>       
</div>

