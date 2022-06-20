@extends('subscriber.layouts.userMaster')

@push('css')



@endpush
@section('content')
    <br>
    @include('alerts.alerts')
    <section class="content">
        @if ($profile->category->business_type == 'shop')
            @if ($profile->profile_type == 'personal')
                <div class="row">
                    <div class="col-md-8 m-auto">
                        <div class="card card-default">
                            <div class="card-header"
                                style="background-color: {{ $profile->category ? $profile->category->pp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_header_text_color : '' }}">
                                <div class="d-flex justify-content-between">
                                    <p> {{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
                                        ({{ ucfirst($profile->profile_type) }})</p>
                                        <p>Support Number :{{$profile->addedby->mobile ?? '01756533523'}}</p>

                                    <p><a class="btn w3-purple "
                                            href="{{ route('subscriber.myProfileEdit', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Edit</a>
                                    </p>
                                </div>
                            </div>

                            <div class="card-body"
                                style="background-color: {{ $profile->category ? $profile->category->pp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_body_text_color : '' }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <img class=" w3-circle"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                                    alt="sans" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <p>
                                                    <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                                </p>

                                                <p>
                                                    <b>Bio:</b> {{ $profile->short_bio }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>

                                <div class="card">
                                    <div class="card-body">

                                        @foreach ($profile->freeValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <hr>



                            </div>

                            <div class="card-footer"
                                style="background-color: {{ $profile->category ? $profile->category->pp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_footer_text_color : '' }}">
                                <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                            </div>

                        </div>
                    </div>
                </div>

            @else
                {{-- Business Area --}}
                <div class="row">

                    <div class="col-md-8 offset-2">
                        <div class="card card-default">
                            <div class="card-header"
                                style="background-color: {{ $profile->category ? $profile->category->sp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_header_text_color : '' }}">

                                <div class="d-flex justify-content-between">
                                    <p> {{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
                                        ({{ ucfirst($profile->profile_type) }}) </p>
                                        <p>Support Number :{{$profile->addedby->mobile ?? '01756533523'}}</p>
                                    <p><a class="btn w3-purple "
                                            href="{{ route('subscriber.myProfileEdit', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Edit</a>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p> <strong> Cat:</strong>{{ $profile->category->name }} <strong>
                                            SS:</strong>{{ $profile->workstation->title }}
                                    </p>
                                    @if ($profile->category->sp_order)
                                        <p> <a class="btn btn-success btn-xs"
                                                href="{{ route('subscriber.newProfileProduct', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Upload
                                                New Product</a></p>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body"
                                style="background-color: {{ $profile->category ? $profile->category->sp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_body_text_color : '' }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <img class=" w3-circle"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                                    alt="sans" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <p>
                                                    <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                                </p>

                                                <p>
                                                    <b>Bio:</b> {{ $profile->short_bio }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="card">
                                    <div class="card-body">

                                        @foreach ($profile->freeValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-body" style="white-space: pre-line;">
                                        @foreach ($profile->shortValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')<p>
                                                    <b>{{ $value->profile_info_key }}</b>:
                                                </p>{!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($profile->fullValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer"
                                style="background-color: {{ $profile->category ? $profile->category->sp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_footer_text_color : '' }}">
                                <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header">Visitors ({{ count($total_visitor) }})</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                {{-- <th>Id</td> --}}
                                                {{-- <td>Personal Profile</td> --}}
                                                <td>Free</td>
                                                <td>Short Paid</td>
                                                <td>Full Paid</td>
                                                <td>Visited</td>
                                                <td>Visitor Subscription</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($visitors))
                                                @forelse($visitors as $visitor)

                                                    <tr>
                                                        {{-- <td>{{ $visitor->id }}</td> --}}
                                                        {{-- <td>{{ $visitor->personal_profile->name }}</td> --}}
                                                        <td>{{ $visitor->free }}</td>
                                                        <td>{{ $visitor->short_paid }}</td>
                                                        <td>{{ $visitor->full_paid }}</td>
                                                        <td>{{ $visitor->visit_count }}</td>
                                                        <td>
                                                            {{ $visitor->subscriber ? $visitor->subscriber->subscription_code : '' }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-info"
                                                                href="{{ route('subscriber.visitorProfileDetails', ['visitor' => $visitor, 'subscription' => $subscription->subscription_code]) }}">Details</a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center text-danger">No Visitor Found
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-info btn-xs"
                                    href="{{ route('subscriber.allordersOfServiceProducts', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">All
                                    Orders</a>
                                <a href="{{ route('subscriber.myAllServiceProfileProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                    class="btn w3-deep-orange btn-xs">All Products</a>
                            </div>
                        </div>
                       
                    </div>
                </div>
            @endif
        @elseif ($profile->category->business_type == 'service')
            @if ($profile->profile_type == 'personal')
                <div class="row">
                    <div class="col-md-8 m-auto">
                        <div class="card card-default">
                            <div class="card-header"
                                style="background-color: {{ $profile->category ? $profile->category->pp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_header_text_color : '' }}">
                                <div class="d-flex justify-content-between">
                                    <p> {{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
                                        ({{ ucfirst($profile->profile_type) }})</p>
                                        <p>Support Number :{{$profile->addedby->mobile ?? '01756533523'}}</p>

                                    <p><a class="btn w3-purple "
                                            href="{{ route('subscriber.myProfileEdit', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Edit</a>
                                    </p>
                                </div>
                            </div>

                            <div class="card-body"
                                style="background-color: {{ $profile->category ? $profile->category->pp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_body_text_color : '' }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <img class=" w3-circle"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                                    alt="sans" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <p>
                                                    <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                                </p>

                                                <p>
                                                    <b>Bio:</b> {{ $profile->short_bio }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <table class="w3-table">
    
                                    <tr>
                                      <th>Email</th>
                                      <td>
                                        <button class="btn btn-xs btn-success" onclick="return confirm('Do you want to see the email ? 10tk Charge applicable')">Email</button>
                                      </td>
                                    </tr>
    
                                    <tr>
                                        <th>Mobile</th>
                                        <td>
                                          <button class="btn btn-xs btn-success" onclick="return confirm('Do you want to see the mobile ? 10tk Charge applicable')">Mobile</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>
                                          <button class="btn btn-xs btn-success" onclick="return confirm('Do you want to see the Address ? 10tk Charge applicable')">Address</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> --}}

                                </div>
                                <hr>

                                <div class="card">
                                    <div class="card-body">

                                        @foreach ($profile->freeValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <hr>



                            </div>

                            <div class="card-footer"
                                style="background-color: {{ $profile->category ? $profile->category->pp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_footer_text_color : '' }}">
                                <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                            </div>

                        </div>
                    </div>
                </div>

            @else
                {{-- Business Area --}}
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <div class="card card-default">
                            <div class="card-header"
                                style="background-color: {{ $profile->category ? $profile->category->sp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_header_text_color : '' }}">

                                <div class="d-flex justify-content-between">
                                    <p> {{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
                                        ({{ ucfirst($profile->profile_type) }}) </p>
                                    <p><a class="btn w3-purple "
                                            href="{{ route('subscriber.myProfileEdit', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Edit</a>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p> <strong> Cat:</strong>{{ $profile->category->name }} <strong>
                                            SS:</strong>{{ $profile->workstation->title }}
                                    </p>
                                    <p>Support Number :{{$profile->addedby->mobile ?? '01756533523'}}</p>
                                    <p> <a class="btn btn-success btn-xs"
                                            href="{{ route('subscriber.newServiceItem', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Upload
                                            New Service Item</a></p>
                                </div>
                            </div>

                            <div class="card-body"
                                style="background-color: {{ $profile->category ? $profile->category->sp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_body_text_color : '' }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <img class=" w3-circle"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                                    alt="sans" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <p>
                                                    <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                                </p>
                                                <p>
                                                    <b>Bio:</b> {{ $profile->short_bio }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="card">
                                    <div class="card-body">

                                        @foreach ($profile->freeValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-body" style="white-space: pre-line;">
                                        @foreach ($profile->shortValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')<p>
                                                    <b>{{ $value->profile_info_key }}</b>:
                                                </p>{!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($profile->fullValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')
                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>
                                            @elseif($value->field_type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer"
                                style="background-color: {{ $profile->category ? $profile->category->sp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_footer_text_color : '' }}">
                                <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header">Visitors ({{ count($total_visitor) }})</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                {{-- <th>Id</td> --}}
                                                {{-- <td>Personal Profile</td> --}}
                                                <td>Free</td>
                                                <td>Short Paid</td>
                                                <td>Full Paid</td>
                                                <td>Visited</td>
                                                <td>Visitor Subscription</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($visitors))
                                                @forelse($visitors as $visitor)

                                                    <tr>
                                                        {{-- <td>{{ $visitor->id }}</td> --}}
                                                        {{-- <td>{{ $visitor->personal_profile->name }}</td> --}}
                                                        <td>{{ $visitor->free }}</td>
                                                        <td>{{ $visitor->short_paid }}</td>
                                                        <td>{{ $visitor->full_paid }}</td>
                                                        <td>{{ $visitor->visit_count }}</td>
                                                        <td>
                                                            {{ $visitor->subscriber ? $visitor->subscriber->subscription_code : '' }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-info"
                                                                href="{{ route('subscriber.visitorProfileDetails', ['visitor' => $visitor, 'subscription' => $subscription->subscription_code]) }}">Details</a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center text-danger">No Visitor Found
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-info btn-xs"
                                    href="{{ route('subscriber.allordersOfServiceProducts', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">All
                                    Orders</a>
                                <a href="{{ route('subscriber.allServiceItems', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                    class="btn w3-deep-orange btn-xs">All Services</a>
                            </div>
                        </div>
                       
                    </div>
                </div>

            @endif
        @elseif ($profile->category->business_type == 'course')
            @if ($profile->profile_type == 'personal')
                <div class="row">
                    <div class="col-md-8 m-auto">
                        <div class="card card-default">
                            <div class="card-header"
                                style="background-color: {{ $profile->category ? $profile->category->pp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_header_text_color : '' }}">
                                <div class="d-flex justify-content-between">
                                    <p> {{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
                                        ({{ ucfirst($profile->profile_type) }})</p>
                                        <p>Support Number :{{$profile->addedby->mobile ?? '01756533523'}}</p>

                                    <p><a class="btn w3-purple "
                                            href="{{ route('subscriber.myProfileEdit', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Edit</a>
                                    </p>
                                </div>
                            </div>

                            <div class="card-body"
                                style="background-color: {{ $profile->category ? $profile->category->pp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_body_text_color : '' }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <img class=" w3-circle"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                                    alt="sans" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <p>
                                                    <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                                </p>

                                                <p>
                                                    <b>Bio:</b> {{ $profile->short_bio }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="w3-table">

                                                <tr>
                                                <th>Email</th>
                                                <td>
                                                    <button class="btn btn-xs btn-success" onclick="return confirm('Do you want to see the email ? 10tk Charge applicable')">Email</button>
                                                </td>
                                                </tr>

                                                <tr>
                                                    <th>Mobile</th>
                                                    <td>
                                                    <button class="btn btn-xs btn-success" onclick="return confirm('Do you want to see the mobile ? 10tk Charge applicable')">Mobile</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>
                                                    <button class="btn btn-xs btn-success" onclick="return confirm('Do you want to see the Address ? 10tk Charge applicable')">Address</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}

                                </div>
                                <hr>

                                <div class="card">
                                    <div class="card-body">

                                        @foreach ($profile->freeValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <hr>



                            </div>

                            <div class="card-footer"
                                style="background-color: {{ $profile->category ? $profile->category->pp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->pp_footer_text_color : '' }}">
                                <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                            </div>

                        </div>
                    </div>
                </div>

            @else
                {{-- Business Area --}}
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <div class="card card-default">
                            <div class="card-header"
                                style="background-color: {{ $profile->category ? $profile->category->sp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_header_text_color : '' }}">

                                <div class="d-flex justify-content-between">
                                    <p> {{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
                                        ({{ ucfirst($profile->profile_type) }}) </p>
                                    <p><a class="btn w3-purple "
                                            href="{{ route('subscriber.myProfileEdit', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Edit</a>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p> <strong> Cat:</strong>{{ $profile->category->name }} <strong>
                                            SS:</strong>{{ $profile->workstation->title }}
                                    </p>
                                    <p>Support Number :{{$profile->addedby->mobile ?? '01756533523'}}</p>
                                    <p> <a class="btn btn-success btn-xs"
                                            href="{{ route('subscriber.newCourse', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">Upload
                                            New Course</a></p>
                                </div>
                            </div>

                            <div class="card-body"
                                style="background-color: {{ $profile->category ? $profile->category->sp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_body_text_color : '' }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <img class=" w3-circle"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                                    alt="sans" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 175px;">
                                                <p>
                                                    <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                                </p>
                                                @if($profile->designation)
                                                    <p>
                                                        <b>Designation:</b> {{ $profile->designation }}
                                                    </p>
                                                @endif
                                                <p>
                                                    <b>Bio:</b> {{ $profile->short_bio }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="card">
                                    <div class="card-body">

                                        @foreach ($profile->freeValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-body" style="white-space: pre-line;">
                                        @foreach ($profile->shortValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')<p>
                                                    <b>{{ $value->profile_info_key }}</b>:
                                                </p>{!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($profile->fullValues() as $value)
                                            @if ($value->field_type == 'string')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'text')

                                                <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>

                                            @elseif($value->field_type == 'float')
                                                <p><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}
                                                </p>
                                            @elseif($value->field_type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword"
                                                            width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer"
                                style="background-color: {{ $profile->category ? $profile->category->sp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_footer_text_color : '' }}">
                                <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header">Visitors ({{ count($total_visitor) }})</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                {{-- <th>Id</td> --}}
                                                {{-- <td>Personal Profile</td> --}}
                                                <td>Free</td>
                                                <td>Short Paid</td>
                                                <td>Full Paid</td>
                                                <td>Visited</td>
                                                <td>Visitor Subscription</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($visitors))
                                                @forelse($visitors as $visitor)

                                                    <tr>
                                                        {{-- <td>{{ $visitor->id }}</td> --}}
                                                        {{-- <td>{{ $visitor->personal_profile->name }}</td> --}}
                                                        <td>{{ $visitor->free }}</td>
                                                        <td>{{ $visitor->short_paid }}</td>
                                                        <td>{{ $visitor->full_paid }}</td>
                                                        <td>{{ $visitor->visit_count }}</td>
                                                        <td>
                                                            {{ $visitor->subscriber ? $visitor->subscriber->subscription_code : '' }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-info"
                                                                href="{{ route('subscriber.visitorProfileDetails', ['visitor' => $visitor, 'subscription' => $subscription->subscription_code]) }}">Details</a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center text-danger">No Visitor Found
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-info btn-xs"
                                    href="{{ route('subscriber.allordersOfServiceProducts', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}">All
                                    Orders</a>
                                <a href="{{ route('subscriber.allServiceItems', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                    class="btn w3-deep-orange btn-xs">All Services</a>
                            </div>
                        </div>
                    
                    </div>
                </div>

            @endif
            
        @elseif ($profile->category->business_type == 'job')
            JOB is Comming soon
        @elseif ($profile->category->business_type == 'matrimony')
            Marrage Media is Comming soon
        @endif


    </section>
@endsection
