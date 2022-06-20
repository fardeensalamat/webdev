@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<link rel="stylesheet" href="{{ asset('cp/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush

@section('content')
<br>
<section class="content">
  @include('alerts.alerts')
    <div class="card card-primary">
        <div class="card-header with-border ">
            <h3 class="card-title">
                Manage Categories [Category: {{ ucfirst($cat->name) }}, Service Station: {{ $cat->workstation ? $cat->workstation->title : '' }}]
            </h3>
        </div>

        <div class="card-body w3-light-gray">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header with-border">
                                    <h3 class="card-title">
                                        Categories Details
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{route('admin.categoryUpdatePost',$cat)}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-sm-12 control-label">Name</label>
                                                <div class="col-sm-12">
                                                  <input type="text" name="name"
                                                  value="{{$cat->name}}" class="form-control"  id="name" placeholder="name" autocomplete="off">
                                                  @if ($errors->has('name'))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first('name') }}</strong>
                                                      </span>
                                                  @endif
                                                </div>
                                            </div>

                                              <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                                <label for="description" class="col-sm-12 control-label">Description</label>
                                                <div class="col-sm-12">
                                                  <input type="text" name="description"  class="form-control" id="description" placeholder="Description"
                                                  value="{{$cat->description}}"
                                                  autocomplete="off">
                                                  @if ($errors->has('description'))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first('description') }}</strong>
                                                      </span>
                                                  @endif
                                                </div>
                                              </div>

                                              <div class="form-group {{ $errors->has('service_product_commission') ? ' has-error' : '' }}">
                                                <label for="service_product_commission" class="col-sm-12 control-label">Service Product Commission (B: {{ $cat->product_commission_balance }} SCB)</label>
                                                <div class="col-sm-12">
                                                  <input type="number" min="1" max="100" name="service_product_commission"  class="form-control" id="service_product_commission" placeholder="Service Product Commission"
                                                  value="{{$cat->service_product_commission}}"
                                                  autocomplete="off">
                                                  @if ($errors->has('service_product_commission'))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first('service_product_commission') }}</strong>
                                                      </span>
                                                  @endif
                                                </div>
                                              </div>

                                              <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                                <label class="col-sm-12 control-label">Category Image</label>

                                                <div class="row">
                                                  <div class="col-sm-12">
                                                    @if ($errors->has('image'))
                                                      <p style="color: red;margin: 0;">{{ $errors->first('image') }}</p>
                                                    @endif
                                                    <input type="file" name="image" class="form-control" >
                                                  </div>


                                                </div>
                                              </div>
                                              <div class="form-group {{ $errors->has('banner') ? ' has-error' : '' }}">
                                                <label class="col-sm-12 control-label">Category Banner</label>
                                                <div class="row">
                                                  <div class="col-sm-12">
                                                    @if ($errors->has('banner'))
                                                    <p style="color: red;margin: 0;">{{ $errors->first('banner') }}</p>
                                                  @endif
                                                  <input type="file" name="banner" class="form-control" >
                                                  </div>


                                                </div>
                                              </div>

                                            <div class="form-group col-lg-12">
                                                <label>Catagory Active</label>
                                              <div class="i-checks"><label style="cursor: pointer;"> <input name="active" {{$cat->active==true?'checked':''}} type="checkbox" > <i></i> Active</label></div>

                                            </div>

                                            <div class="form-group col-lg-12">
                                              <label>Catagory Fetured</label>
                                              <div class="i-checks"><label style="cursor: pointer;">    <input name="featured" {{$cat->featured==true?'checked':''}}   type="checkbox" > <i></i> Featured</label>
                                              </div>
                                            </div>
                                          </div>


                                        </div>

                                          <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                              <button type="reset" class="btn btn-default">Cancel</button>

                                              <button type="submit" class="btn btn-primary pull-right">Update</button>

                                            </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      Business Profile
                    </div>
                    <div class="card-body">
                      <div class="col-md-12">
                        <form action="{{route('admin.categoryBusinessProfileUpdatePost',$cat)}}" class="form-group" method="post">
                          @csrf
                          <div class="form-group {{ $errors->has('sp_title') ? ' has-error' : '' }}">
                            <label for="sp_title" class="col-sm-12 control-label">Service Profile Title
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_title"
                              value="{{$cat->sp_title}}" class="form-control"  id="sp_title" placeholder="Service Profile Title" autocomplete="off">
                              @if ($errors->has('sp_title'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_title') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group {{ $errors->has('sp_description') ? ' has-error' : '' }}">
                            <label for="sp_description" class="col-sm-12 control-label">Service Profile Description
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_description"
                              value="{{$cat->sp_description}}" class="form-control"  id="sp_description" placeholder="Service Profile Description" autocomplete="off">
                              @if ($errors->has('sp_description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_description') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>


                          <div class="form-group {{ $errors->has('sp_short_price') ? ' has-error' : '' }}">
                            <label for="sp_short_price" class="col-sm-12 control-label">Service Profile Short Price
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_short_price"
                              value="{{$cat->sp_short_price}}" class="form-control"  id="sp_short_price" placeholder="Service Profile Short Price" autocomplete="off">
                              @if ($errors->has('sp_short_price'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_short_price') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          

                          <div class="form-group {{ $errors->has('sp_short_price_owner_com') ? ' has-error' : '' }}">
                            <label for="sp_short_price" class="col-sm-12 control-label">Short Price Owner Commision (%)
                            </label>
                            <div class="col-sm-12">
                              <input type="number" min="0" max="100" name="sp_short_price_owner_com"
                              value="{{$cat->sp_short_price_owner_com}}" class="form-control"  id="sp_short_price_owner_com" placeholder="Short Price Owner Commision (%)" autocomplete="off">
                              @if ($errors->has('sp_short_price_owner_com'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_short_price_owner_com') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group {{ $errors->has('sp_short_p_view_btn_txt') ? ' has-error' : '' }}">
                            <label for="sp_short_p_view_btn_txt" class="col-sm-12 control-label">Short Price View Button
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_short_p_view_btn_txt"
                              value="{{$cat->sp_short_p_view_btn_txt}}" class="form-control"  id="sp_short_p_view_btn_txt" placeholder="Short Price View Button Text" autocomplete="off">
                              @if ($errors->has('sp_short_p_view_btn_txt'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_short_p_view_btn_txt') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>

                          <div class="form-group {{ $errors->has('sp_full_price') ? ' has-error' : '' }}">
                            <label for="sp_full_price" class="col-sm-12 control-label">Service Profile Full Price
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_full_price"
                              value="{{$cat->sp_full_price}}" class="form-control"  id="sp_full_price" placeholder="Service Profile Full Price" autocomplete="off">
                              @if ($errors->has('sp_full_price'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_full_price') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>

                          <div class="form-group {{ $errors->has('sp_full_price_owner_com') ? ' has-error' : '' }}">
                            <label for="sp_short_price" class="col-sm-12 control-label">Full Price Owner Commision (%)
                            </label>
                            <div class="col-sm-12">
                              <input type="number" min="0" max="100" name="sp_full_price_owner_com"
                              value="{{$cat->sp_full_price_owner_com}}" class="form-control"  id="sp_full_price_owner_com" placeholder="Full Price Owner Commision (%)" autocomplete="off">
                              @if ($errors->has('sp_full_price_owner_com'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_full_price_owner_com') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group {{ $errors->has('sp_full_p_view_btn_txt') ? ' has-error' : '' }}">
                            <label for="sp_full_p_view_btn_txt" class="col-sm-12 control-label">Full Price View Button Text
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_full_p_view_btn_txt"
                              value="{{$cat->sp_full_p_view_btn_txt}}" class="form-control"  id="sp_full_p_view_btn_txt" placeholder="Full Price View Button Text" autocomplete="off">
                              @if ($errors->has('sp_full_p_view_btn_txt'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_full_p_view_btn_txt') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          

                          <div class="form-group {{ $errors->has('sp_create_charge') ? ' has-error' : '' }}">
                            <label for="sp_create_charge" class="col-sm-12 control-label">Service Profile Create Charge
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_create_charge"
                              value="{{$cat->sp_create_charge}}" class="form-control"  id="sp_create_charge" placeholder="Service Profile Charge" autocomplete="off">
                              @if ($errors->has('sp_create_charge'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_create_charge') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group {{ $errors->has('sp_adtopup_bonus') ? ' has-error' : '' }}">
                            <label for="sp_adtopup_bonus" class="col-sm-12 control-label">Ad Topup Bonus
                            </label>
                            <div class="col-sm-12">
                              <input type="text" name="sp_adtopup_bonus"
                              value="{{$cat->sp_adtopup_bonus}}" class="form-control"  id="sp_adtopup_bonus" placeholder="Ad top up bonus" autocomplete="off">
                              @if ($errors->has('sp_adtopup_bonus'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sp_adtopup_bonus') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-md-6">
                              <div class="card card-secondary">
                                <div class="card-header">
                                  <div class="card-title">
                                    Custom Color
                                  </div>

                                </div>
                                <div class="card-body">
                                  <div class="form-group {{ $errors->has('sp_header_bg_color') ? ' has-error' : '' }}">
                                    <label for="sp_header_bg_color" class="col-sm-12 control-label">Service Profile Header Background Color
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="color" name="sp_header_bg_color"
                                      value="{{$cat->sp_header_bg_color}}" class="form-control"  id="sp_header_bg_color" placeholder="Service Profile Header Background Color" autocomplete="off">
                                      @if ($errors->has('sp_header_bg_color'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('sp_header_bg_color') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group {{ $errors->has('sp_header_text_color') ? ' has-error' : '' }}">
                                    <label for="sp_header_text_color" class="col-sm-12 control-label">Service Profile Header Text Color
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="color" name="sp_header_text_color"
                                      value="{{$cat->sp_header_text_color}}" class="form-control"  id="sp_header_text_color" placeholder="Service Profile Header Text Color" autocomplete="off">
                                      @if ($errors->has('sp_header_text_color'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('sp_header_text_color') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>



                                  <div class="form-group {{ $errors->has('sp_body_bg_color') ? ' has-error' : '' }}">
                                    <label for="sp_body_bg_color" class="col-sm-12 control-label">Service Profile Body Background Color
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="color" name="sp_body_bg_color"
                                      value="{{$cat->sp_body_bg_color}}" class="form-control"  id="sp_body_bg_color" placeholder="Service Profile Body Background Color" autocomplete="off">
                                      @if ($errors->has('sp_body_bg_color'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('sp_body_bg_color') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group {{ $errors->has('sp_body_text_color') ? ' has-error' : '' }}">
                                    <label for="sp_body_text_color" class="col-sm-12 control-label">Service Profile Body Text Color
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="color" name="sp_body_text_color"
                                      value="{{$cat->sp_body_text_color}}" class="form-control"  id="sp_body_text_color" placeholder="Service Profile Body Text Color" autocomplete="off">
                                      @if ($errors->has('sp_body_text_color'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('sp_body_text_color') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group {{ $errors->has('sp_footer_bg_color') ? ' has-error' : '' }}">
                                    <label for="sp_footer_bg_color" class="col-sm-12 control-label">Service Profile Footer Background Color
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="color" name="sp_footer_bg_color"
                                      value="{{$cat->sp_footer_bg_color}}" class="form-control"  id="sp_footer_bg_color" placeholder="Service Profile Footer Background Color" autocomplete="off">
                                      @if ($errors->has('sp_footer_bg_color'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('sp_footer_bg_color') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group {{ $errors->has('sp_footer_text_color') ? ' has-error' : '' }}">
                                    <label for="sp_footer_text_color" class="col-sm-12 control-label">Service Profile Footer Text Color
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="color" name="sp_footer_text_color"
                                      value="{{$cat->sp_footer_text_color}}" class="form-control"  id="sp_footer_text_color" placeholder="Service Profile Footer Text Color" autocomplete="off">
                                      @if ($errors->has('sp_footer_text_color'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('sp_footer_text_color') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>


                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="card card-secondary">
                                <div class="card-header">
                                  <h3 class="card-title">Others settings</h3>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label for="">Chat: </label> <br>
                                      <input type="checkbox" name="sp_chat" {{ $cat->sp_chat == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Review: </label> <br>
                                      <input type="checkbox" name="sp_review" {{ $cat->sp_review == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Active: </label> <br>
                                      <input type="checkbox" name="sp_active" {{ $cat->sp_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Featured: </label> <br>
                                      <input type="checkbox" name="sp_featured" {{ $cat->sp_featured == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="col-md-6">
                                      <label for="">Location: </label> <br>
                                      <input type="checkbox" name="sp_location" {{ $cat->sp_location == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Bidding : </label> <br>
                                      <input type="checkbox" name="sp_bidding" {{ $cat->sp_bidding == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="col-md-6">
                                      <label for="">Order : </label> <br>
                                      <input type="checkbox" name="sp_order" {{ $cat->sp_order == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-6"><h4> <b>Business Type</b></h4></div>
                                        <div class="col-6">
                                          <select name="business_type" id="" class="form-control">
                                            <option {{ $cat->business_type == "shop"? 'selected':'' }} value="shop">Shop</option>
                                            <option {{ $cat->business_type == "service"? 'selected':'' }} value="service">Service</option>
                                            <option {{ $cat->business_type == "course"? 'selected':'' }} value="course">Course</option>
                                            <option {{ $cat->business_type == "journey"? 'selected':'' }} value="journey">Journey</option>
                                            <option {{ $cat->business_type == "job"? 'selected':'' }} value="job">Job</option>
                                            <option {{ $cat->business_type == "matrimony"? 'selected':'' }} value="matrimony">Matrimony</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                      </div>



                      <div class="col-md-12">
                        <div class="card card-primary">
                          <div class="card-header">
                            Service Profile Infos
                          </div>
                          <div class="card-body">
                            <form action="{{ route('admin.serviceProfileInfo',$cat) }}" method="post">
                              @csrf
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="profile_key_info" class="col-sm-12 control-label">Profile Key Info</label>
                                    <div class="col-sm-12">
                                      <input required type="text" name="profile_key_info"
                                      value="{{old('profile_key_info')}}" class="form-control"  id="profile_key_info" placeholder="Profile Key Info" autocomplete="off">
                                      @if ($errors->has('profile_key_info'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('profile_key_info') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                                </div>
                                <div class="col-md-3">
                                  <div class="form-group {{ $errors->has('field_type') ? ' has-error' : '' }}">
                                    <label for="profile_key_info" class="col-sm-12 control-label">Field Type</label>
                                    <div class="col-sm-12">
                                      <select required name="field_type" class="form-control" id="field_type">
                                        <option >Select Type</option>
                                        <option value="string">String</option>
                                        <option value="text">Text</option>
                                        <option value="integer">Integer</option>
                                        <option value="float">Float</option>
                                        <option value="image">Image</option>
                                        <option value="doc">Doc (Word)</option>
                                        <option value="pdf">PDF (Download)</option>

                                      </select>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group {{ $errors->has('access_type') ? ' has-error' : '' }}">
                                  <label for="access_type" class="col-sm-12 control-label">Access Type</label>
                                  <div class="col-sm-12">
                                    <select required name="access_type" class="form-control" id="access_type">
                                      <option >Select Access Type</option>
                                      <option value="free">Free</option>
                                      <option value="short_paid">Short Paid</option>
                                      <option value="full_paid">Full Paid</option>

                                    </select>
                                  </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label for="">Active</label>
                                      <br>
                                      <input type="checkbox" name="active_sp_info" id="active_sp_info">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Profile Card Display</label>
                                      <input type="checkbox" name="profile_card_display" id="profile_card_display">

                                    </div>

                                  </div>
                                </div>
                                <div class="col-md-1 mt-4">
                              <button class="btn btn-success btn-sm" type="submit">Submit</button>

                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        @if ($serviceProfileInfos->count() > 0)

                          <div class="card card-primary">
                            <div class="card-header">
                              All Service Profile Info <small> Category: {{ $cat->name }} </small>
                            </div>
                            <div class="card-body">
                                @foreach ($serviceProfileInfos as $item)
                                <div class="card">
                                  <div class="card-header">
                                    ID: {{ $item->id }} Info Key: <b>{{ $item->profile_info_key }}</b> Field Type: <b>{{ $item->field_type }}</b> Access Type : <b>{{ $item->access_type }}</b> Active: <b>{{ $item->active == 1 ? "Active" : "Inactive"}}</b>
                                      <div class="card-tools">
                                        <a href="{{ route('admin.serviceProfileInfosEdit',$item) }}" class="btn btn-sm btn-warning">
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.serviceProfileInfosDelete',$item) }}" onclick="return confirm('Do you want to delete service profile info?')" class="btn btn-sm btn-danger">
                                          <i class="fa fa-trash"></i>
                                        </a>
                                      </div>
                                  </div>
                                </div>
                                @endforeach
                            </div>
                          </div>
                        @endif
                      </div>


                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="card card-warning">
                    <div class="card card-header">
                      Personal Profile
                    </div>
                    <div class="card-body">
                      <div class="card-body">
                        <div class="col-md-12">
                          <form action="{{ route('admin.updatePersonalProfilePost',$cat) }}" class="form-group" method="post">
                            @csrf
                            <div class="form-group {{ $errors->has('pp_title') ? ' has-error' : '' }}">
                              <label for="pp_title" class="col-sm-12 control-label">Personal Profile Title
                              </label>
                              <div class="col-sm-12">
                                <input type="text" name="pp_title"
                                value="{{$cat->pp_title}}" class="form-control"  id="pp_title" placeholder="Personal Profile Title" autocomplete="off">
                                @if ($errors->has('pp_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pp_title') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                            <div class="form-group {{ $errors->has('pp_description') ? ' has-error' : '' }}">
                              <label for="pp_description" class="col-sm-12 control-label">Personal Profile Description
                              </label>
                              <div class="col-sm-12">
                                <input type="text" name="pp_description"
                                value="{{$cat->pp_description}}" class="form-control"  id="pp_description" placeholder="Personal Profile Description" autocomplete="off">
                                @if ($errors->has('pp_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pp_description') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>


                            {{-- <div class="form-group {{ $errors->has('sp_short_price') ? ' has-error' : '' }}">
                              <label for="sp_short_price" class="col-sm-12 control-label">Personal Profile Short Price
                              </label>
                              <div class="col-sm-12">
                                <input type="text" name="sp_short_price"
                                value="{{$cat->sp_short_price}}" class="form-control"  id="sp_short_price" placeholder="Personal Profile Short Price" autocomplete="off">
                                @if ($errors->has('sp_short_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sp_short_price') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div> --}}

                            {{-- <div class="form-group {{ $errors->has('sp_full_price') ? ' has-error' : '' }}">
                              <label for="sp_full_price" class="col-sm-12 control-label">Personal Profile Full Price
                              </label>
                              <div class="col-sm-12">
                                <input type="text" name="sp_full_price"
                                value="{{$cat->sp_full_price}}" class="form-control"  id="sp_full_price" placeholder="Personal Profile Full Price" autocomplete="off">
                                @if ($errors->has('sp_full_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sp_full_price') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div> --}}
                            {{-- <div class="form-group {{ $errors->has('sp_create_charge') ? ' has-error' : '' }}">
                              <label for="sp_create_charge" class="col-sm-12 control-label">Personal Profile Create Charge
                              </label>
                              <div class="col-sm-12">
                                <input type="text" name="sp_create_charge"
                                value="{{$cat->sp_create_charge}}" class="form-control"  id="sp_create_charge" placeholder="Personal Profile Charge" autocomplete="off">
                                @if ($errors->has('sp_create_charge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sp_create_charge') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div> --}}


                            <div class="row">
                              <div class="col-md-6">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <div class="card-title">
                                      Custom Color
                                    </div>

                                  </div>
                                  <div class="card-body">
                                    <div class="form-group {{ $errors->has('pp_header_bg_color') ? ' has-error' : '' }}">
                                      <label for="pp_header_bg_color" class="col-sm-12 control-label">Personal Profile Header Background Color
                                      </label>
                                      <div class="col-sm-12">
                                        <input type="color" name="pp_header_bg_color"
                                        value="{{$cat->pp_header_bg_color}}" class="form-control"  id="pp_header_bg_color" placeholder="Personal Profile Header Background Color" autocomplete="off">
                                        @if ($errors->has('pp_header_bg_color'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pp_header_bg_color') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('pp_header_text_color') ? ' has-error' : '' }}">
                                      <label for="pp_header_text_color" class="col-sm-12 control-label">Personal Profile Header Text Color
                                      </label>
                                      <div class="col-sm-12">
                                        <input type="color" name="pp_header_text_color"
                                        value="{{$cat->pp_header_text_color}}" class="form-control"  id="pp_header_text_color" placeholder="Personal Profile Header Text Color" autocomplete="off">
                                        @if ($errors->has('pp_header_text_color'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pp_header_text_color') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('pp_body_bg_color') ? ' has-error' : '' }}">
                                        <label for="pp_body_bg_color" class="col-sm-12 control-label">Personal Profile Body Background Color
                                        </label>
                                        <div class="col-sm-12">
                                          <input type="color" name="pp_body_bg_color"
                                          value="{{$cat->pp_body_bg_color}}" class="form-control"  id="pp_body_bg_color" placeholder="Personal Profile Body Background Color" autocomplete="off">
                                          @if ($errors->has('pp_body_bg_color'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('pp_body_bg_color') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                      </div>

                                      <div class="form-group {{ $errors->has('pp_body_text_color') ? ' has-error' : '' }}">
                                        <label for="pp_body_text_color" class="col-sm-12 control-label">Personal Profile Body Text Color
                                        </label>
                                        <div class="col-sm-12">
                                          <input type="color" name="pp_body_text_color"
                                          value="{{$cat->pp_body_text_color}}" class="form-control"  id="pp_body_text_color" placeholder="Personal Profile Body Text Color" autocomplete="off">
                                          @if ($errors->has('pp_body_text_color'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('pp_body_text_color') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                      </div>

                                    <div class="form-group {{ $errors->has('pp_footer_bg_color') ? ' has-error' : '' }}">
                                      <label for="pp_footer_bg_color" class="col-sm-12 control-label">Personal Profile Footer Background Color
                                      </label>
                                      <div class="col-sm-12">
                                        <input type="color" name="pp_footer_bg_color"
                                        value="{{$cat->pp_footer_bg_color}}" class="form-control"  id="pp_footer_bg_color" placeholder="Personal Profile Footer Background Color" autocomplete="off">
                                        @if ($errors->has('pp_footer_bg_color'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pp_footer_bg_color') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('pp_footer_text_color') ? ' has-error' : '' }}">
                                      <label for="pp_footer_text_color" class="col-sm-12 control-label">Personal Profile Footer Text Color
                                      </label>
                                      <div class="col-sm-12">
                                        <input type="color" name="pp_footer_text_color"
                                        value="{{$cat->pp_footer_text_color}}" class="form-control"  id="pp_footer_text_color" placeholder="Personal Profile Footer Text Color" autocomplete="off">
                                        @if ($errors->has('pp_footer_text_color'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pp_footer_text_color') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    </div>



                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h3 class="card-title">Others settings</h3>
                                  </div>
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="">Chat: </label> <br>
                                        <input type="checkbox" name="pp_chat" {{ $cat->pp_chat == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="">Review: </label> <br>
                                        <input type="checkbox" name="pp_review" {{ $cat->pp_review == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="">Active: </label> <br>
                                        <input type="checkbox" name="pp_active" {{ $cat->pp_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="">Featured: </label> <br>
                                        <input type="checkbox" name="pp_featured" {{ $cat->pp_featured == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                      </div>

                                      <div class="col-md-6">
                                        <label for="">Location: </label> <br>
                                        <input type="checkbox" name="pp_location" {{ $cat->pp_location == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                      </div>


                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                          </form>
                        </div>



                        <div class="col-md-12">
                          <div class="card card-warning">
                            <div class="card-header">
                              Personal Profile Infos
                            </div>
                            <div class="card-body">
                              <form action="{{ route('admin.personalProfileInfo',$cat) }}" method="post">
                                @csrf
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                      <label for="profile_key_info" class="col-sm-12 control-label">Profile Key Info</label>
                                      <div class="col-sm-12">
                                        <input type="text" required name="profile_key_info"
                                        value="{{old('profile_key_info')}}" class="form-control"  id="profile_key_info" placeholder="Profile Key Info" autocomplete="off">
                                        @if ($errors->has('profile_key_info'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profile_key_info') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                  </div>

                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('field_type') ? ' has-error' : '' }}">
                                      <label for="profile_key_info" class="col-sm-12 control-label">Field Type</label>
                                      <div class="col-sm-12">
                                        <select name="field_type" required class="form-control" id="field_type">
                                          <option >Select Type</option>
                                          <option value="string">String</option>
                                          <option value="text">Text</option>
                                          <option value="integer">Integer</option>
                                          <option value="float">Float</option>
                                          <option value="file">File</option>

                                        </select>
                                      </div>
                                  </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('access_type') ? ' has-error' : '' }}">
                                    <label for="access_type" class="col-sm-12 control-label">Access Type</label>
                                    <div class="col-sm-12">
                                      <select name="access_type" required  class="form-control" id="access_type">
                                        <option >Select Access Type</option>
                                        <option value="free">Free</option>
                                        {{-- <option value="short_paid">Short Paid</option>
                                        <option value="full_paid">Full Paid</option> --}}

                                      </select>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="">Active</label>
                                        <br>
                                        <input type="checkbox" name="active_sp_info" id="active_sp_info">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="">Profile Card Display</label>
                                        <input type="checkbox" name="profile_card_display" id="profile_card_display">

                                      </div>

                                    </div>
                                  </div>
                                  <div class="col-md-1 mt-4">
                                <button class="btn btn-success btn-sm" type="submit">Submit</button>

                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          @if ($profileProfileInfos->count() > 0)

                            <div class="card card-warning">
                              <div class="card-header">
                                All Personal Profile Info <small> Category: {{ $cat->name }} </small>
                              </div>
                              <div class="card-body">
                                  @foreach ($profileProfileInfos as $item)
                                  <div class="card">
                                    <div class="card-header">
                                      ID: {{ $item->id }} Info Key: <b>{{ $item->profile_info_key }}</b> Field Type: <b>{{ $item->field_type }}</b> Access Type : <b>{{ $item->access_type }}</b> Active: <b>{{ $item->active == 1 ? "Active" : "Inactive"}}</b>
                                        <div class="card-tools">
                                          <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                          </a>
                                          <a href="" onclick="return confirm('Do you want to delete service profile info?')" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </div>
                                    </div>
                                  </div>
                                  @endforeach
                              </div>
                            </div>
                          @endif
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
<script src="{{ asset('cp/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('cp/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script>
  $(function () {
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  })
</script>
@endpush
