@extends('admin.layouts.adminMaster')
@section('content')
<section class="content">
    @include('alerts.alerts')
    <div class="col-md-12">
        <div class="card card-primary">
        <div class="card-header">
            Service Profile Infos
        </div>
        <div class="card-body">
            <form action="{{ route('admin.serviceProfileInfoUpdate',$serviceProfileInfo) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="profile_key_info" class="col-sm-12 control-label">Profile Key Info</label>
                    <div class="col-sm-12">
                    <input type="text" name="profile_key_info"
                    value="{{old('profile_key_info') ? : $serviceProfileInfo->profile_info_key}}" class="form-control"  id="profile_key_info" placeholder="Profile Key Info" autocomplete="off">
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
                    <select name="field_type" class="form-control" id="field_type">
                        @if ($serviceProfileInfo->field_type)
                        <option value="{{ $serviceProfileInfo->field_type }}">{{ $serviceProfileInfo->field_type }}</option>
                        @endif
                        <option value="string">String</option>
                        <option value="text">Text</option>


                        <option value="integer">Integer</option>
                        <option value="float">Float</option>
                        <option value="image">Image</option>
                        <option value="doc">doc (Word)</option>
                        <option value="pdf">PDF</option>

                    </select>
                    </div>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group {{ $errors->has('access_type') ? ' has-error' : '' }}">
                <label for="access_type" class="col-sm-12 control-label">Access Type</label>
                <div class="col-sm-12">
                    <select name="access_type" class="form-control" id="access_type">
                        @if ($serviceProfileInfo->access_type)
                        <option value="{{ $serviceProfileInfo->access_type }}">{{ $serviceProfileInfo->access_type }}</option>
                        @endif
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
                    <input type="checkbox" {{ $serviceProfileInfo->active == 1 ? "checked" : '' }} name="active_sp_info" id="active_sp_info">
                    </div>
                    <div class="col-md-6">
                    <label for="">Profile Card Display</label>
                    <input type="checkbox" {{ $serviceProfileInfo->profile_card_display == 1 ? "checked" : '' }}  name="profile_card_display" id="profile_card_display">

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
</section>
@endsection
