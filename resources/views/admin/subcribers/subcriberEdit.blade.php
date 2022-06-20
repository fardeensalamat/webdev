@extends('admin.layouts.adminMaster')

@push('css')
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">

        <br>

        <div class="row">

            <div class="col-sm-12">


                @include('alerts.alerts')

                <div class="card card-widget">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span
                                class="badge badge-light">

                                Subscriber Information Update
                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            Subsciber Details
                                        </div>
                                        <div class="card-body">
                                            <dl class="row">
                                                <dt class="col-md-6">Subscriber Balance:
                                                </dt>
                                                <dd class="col-md-6">{{ $subcriber->balance ?: '-' }} TK</dd>

                                                <dt class="col-md-6">Cashout Balance (User):
                                                </dt>
                                                <dd class="col-md-6">
                                                    {{ $subcriber->user ? $subcriber->user->balance : '-' }} TK</dd>
                                                <dt class="col-md-6">User:
                                                </dt>
                                                <dd class="col-md-6">{{ $subcriber->user->name }}
                                                    ({{ $subcriber->user->mobile }})</dd>

                                                <dt class="col-md-6">Work Station:
                                                </dt>
                                                <dd class="col-md-6">
                                                    {{ $subcriber->workStation ? $subcriber->workStation->title : '-' }}
                                                </dd>

                                                {{-- <dt class="col-md-6">Referrer:                                  
                                        </dt> --}}
                                                <dt class="col-md-6">Introduce by Tenant :
                                                </dt>

                                                <dd class="col-md-6">
                                                    {{ $subcriber->referrer ? $subcriber->referrer->subscription_code : '-' }}
                                                </dd>

                                                <dt class="col-md-6">Top Id :
                                                </dt>

                                                <dd class="col-md-6">
                                                    {{ $subcriber->topId() ? $subcriber->topId()->subscription_code : '-' }}
                                                </dd>

                                                <dt class="col-md-6">Employee :
                                                </dt>

                                                <dd class="col-md-6">{{ $subcriber->referredTeam()->count() }}
                                                </dd>

                                                {{-- <dt class="col-md-6">Left Id :                                  
                                        </dt>

                                        <dd class="col-md-6">
                                            {{$subcriber->leftHand() ? $subcriber->leftHand()->subscription_code : '-'}}
                                        </dd>

                                        <dt class="col-md-6">Right Id :                                 
                                        </dt> 

                                        <dd class="col-md-6">
                                            {{$subcriber->rightHand() ? $subcriber->rightHand()->subscription_code : '-'}}
                                        </dd> --}}


                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">{{ __('Update Subscriber') }}
                                            ({{ $subcriber->mobile }})</div>
                                        <div class="card-body">
                                            <form method="POST"
                                                action="{{ route('admin.substcribeUpdate', $subcriber) }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="user" name="user"
                                                            class="form-control user-select select2-container step2-select select2"
                                                            data-placeholder="Mobile or Email"
                                                            data-ajax-url="{{ route('admin.selectNewRole') }}"
                                                            data-ajax-cache="true" data-ajax-dataType="json"
                                                            data-ajax-delay="200" style="">

                                                        </select>
                                                        {{-- <select id="user" name="from" role="textbox"
                                                        class="form-control user-select select2-container step2-select select2"
                                                        data-placeholder="Select City"
                                                        data-ajax-url="{{ route('admin.selectNewRole') }}"
                                                        data-ajax-cache="true" data-ajax-dataType="json" data-ajax-delay="200"
                                                        style="">
    
                                                    </select> --}}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') ?: $subcriber->name }}"
                                                            required autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="mobile"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="mobile" type="text"
                                                            class="form-control @error('mobile') is-invalid @enderror"
                                                            name="mobile"
                                                            value="{{ old('mobile') ?: $subcriber->mobile }}" required
                                                            autocomplete="mobile">

                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="subscription_code"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>
                                                    <div class="col-sm-6 col-md-6">
                                                        <select class="form-control select2 select2bs4"
                                                            name="load_district">
                                                            @if ($subcriber->district_id)
                                                                <option value="{{ $subcriber->district->id }}">
                                                                    {{ $subcriber->district->name }} </option>
                                                            @endif
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}">
                                                                    {{ $district->name }}
                                                                    ({{ $district->id }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="subscription_code"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Subscription code') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="subscription_code" type="text"
                                                            class="form-control @error('subscription_code') is-invalid @enderror"
                                                            name="subscription_code"
                                                            value="{{ old('subscription_code') ?: $subcriber->subscription_code }}"
                                                            required autocomplete="subscription_code">

                                                        @error('subscription_code')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="work_station_id"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Work Station') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="work_station_id" type="text"
                                                            class="form-control @error('work_station_id') is-invalid @enderror"
                                                            name="work_station_id"
                                                            value="{{ old('work_station_id') ?: $subcriber->workStation->title }}"
                                                            autocomplete="work_station_id" readonly>

                                                        @error('work_station_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Update') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @if (Auth::user()->roleItems()->count() < 1)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            <h4>Change Or Delete Leader (That will refer me)</h4>
                                        </div>
                                        <div class="card-body">
                                            @if (!$subcriber->referral_id == null)
                                                <form
                                                    action="{{ route('admin.updatePfReffer', ['subcriber' => $subcriber->id, 'type' => 'delete']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="submit"
                                                        onclick="return confirm('are you sure? you want to delete reffer for this  pf?');"
                                                        class="btn btn-danger" value="Delete Reffer">
                                                </form>
                                                <h3 class="text-center">or</h3>
                                            @endif
                                            <form
                                                action="{{ route('admin.updatePfReffer', ['subcriber' => $subcriber->id, 'type' => 'update']) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="select_subscriber">
                                                        <h3>Update Leader ({{ $subcriber->referral_id }})</h3>
                                                    </label>
                                                    <select id="modal-container" name="reffer"
                                                        class="seleect5 search form-control"
                                                        data-placeholder="Search Wih PF"
                                                        data-ajax-url="{{ route('admin.selectNewRefferFromSubscriber2', ['subscription' => $subcriber->id]) }}"
                                                        data-ajax-cache="true" data-ajax-dataType="json"
                                                        data-ajax-delay="200" style="">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-success" value="Update Leader">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            <h4>Add Reffer (That I will refer)</h4>
                                        </div>
                                        <div class="card-body">
                                            <form
                                                action="{{ route('admin.updatePfReffer', ['subcriber' => $subcriber->id, 'type' => 'add']) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <select id="myModal" name="refferme"
                                                        class="seleect5 search form-control" data-placeholder="Search PF"
                                                        data-ajax-url="{{ route('admin.selectNewRefferFromSubscriber2',['subscription'=>$subcriber->id]) }}"
                                                        data-ajax-cache="true" data-ajax-dataType="json"
                                                        data-ajax-delay="200" style="">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-success" value="Add">
                                                </div>
                                            </form>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            <h4>My Leader (Who refered me)</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive ajax-data-container">
                                                <table class="table table-hover table-bordered table-striped table-sm }}"
                                                    style="white-space: nowrap">
                                                    <thead>
                                                        <tr class="nowrap">
                                                            <th>Action</th>
                                                            <th>ID</th>
                                                            <th>Tenant</th>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
                                                            <th>Balance</th>
                                                            <th>PF No.</th>
                                                            <th>Work Station</th>
                                                            <th>Category</th>
                                                            <th>District</th>
                                                            <th>Referer</th>
                                                            <th>Joining Date</th>
                                                        </tr>
                                                    </thead>
                                                    @if ($myLeader)
                                                        <tbody>
                                                            <tr class="nowrap">

                                                                <td>
                                                                    <div class="btn-group btn-group-xs w3-hover-shadow">

                                                                        <a class="btn btn-primary btn-xs"
                                                                            href="{{ route('admin.subcriberEdit', $myLeader) }}"
                                                                            target="_blank">Edit</a>
                                                                        {{-- <a class="btn btn-primary btn-xs" href="{{ route('admin.userCompanies', $user) }}">Company</a> --}}

                                                                        <div class="btn-group " role="group">
                                                                            <button id="btnGroupDrop1" type="button"
                                                                                class="btn btn-primary dropdown-toggle btn-xs"
                                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                                aria-expanded="false">

                                                                            </button>
                                                                            <div class="dropdown-menu"
                                                                                x-placement="bottom-start"
                                                                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">

                                                                                <a
                                                                                    href="{{ route('admin.subscriberHistoryInfo', [$myLeader, 'type' => 'honorarium']) }}"><button
                                                                                        type="button"
                                                                                        class="dropdown-item btn btn-primary btn-xs">Honorarium
                                                                                    </button></a>

                                                                                <a
                                                                                    href="{{ route('admin.subscriberHistoryInfo', [$myLeader, 'type' => 'job']) }}"><button
                                                                                        type="button"
                                                                                        class="dropdown-item btn btn-primary btn-xs">Posted
                                                                                        Job</button></a>

                                                                                <a
                                                                                    href="{{ route('admin.subscriberHistoryInfo', [$myLeader, 'type' => 'work']) }}"><button
                                                                                        type="button"
                                                                                        class="dropdown-item btn btn-primary btn-xs">All
                                                                                        Works of Job</button></a>

                                                                                <a
                                                                                    href="{{ route('admin.subscriberHistoryInfo', [$myLeader, 'type' => 'move_to_wallet']) }}"><button
                                                                                        type="button"
                                                                                        class="dropdown-item btn btn-primary btn-xs">Balance
                                                                                        Move History</button></a>


                                                                                @if ($myLeader->user)

                                                                                    <a
                                                                                        href="{{ route('admin.userHistoryInfo', ['user' => $myLeader->user_id, 'type' => 'subscribers']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">All
                                                                                            Subcribers</button></a>

                                                                                    <a
                                                                                        href="{{ route('admin.userHistoryInfo', ['user' => $myLeader->user_id, 'type' => 'all_tr']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">All
                                                                                            Tr Of Tenant</button></a>

                                                                                    <a
                                                                                        href="{{ route('admin.userHistoryInfo', ['user' => $myLeader->user_id, 'type' => 'deposit']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">Deposit
                                                                                            of Tenant</button></a>

                                                                                    <a
                                                                                        href="{{ route('admin.userHistoryInfo', ['user' => $myLeader->user_id, 'type' => 'withdraw']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">Withdraw
                                                                                            of Tenant</button></a>
                                                                                @endif

                                                                            </div>
                                                                        </div>


                                                                    </div>


                                                                </td>
                                                                <td>{{ $myLeader->id }}</td>
                                                                <td>
                                                                    @if ($myLeader->user)
                                                                        <a class="btn btn-xs {{ $myLeader->user->active ? '' : 'btn-danger' }}  w3-round w3-border"
                                                                            href="{{ route('admin.usersAll', ['user' => $myLeader->user]) }}">{{ $myLeader->user_id }}</a>
                                                                    @else
                                                                        {{ $myLeader->user_id }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $myLeader->user ? $myLeader->user->name : '' }}
                                                                </td>
                                                                {{-- <td>{{ $myLeader->user ? $myLeader->user->email: '' }}</td> --}}
                                                                <td>{{ $myLeader->user ? $myLeader->user->mobile : '' }}
                                                                </td>
                                                                {{-- <td>{{ $user->position }}</td> --}}
                                                                <td>
                                                                    @if ($myLeader->balance > 0)
                                                                        <span
                                                                            class="badge badge-success">{{ $myLeader->balance }}</span>
                                                                    @else
                                                                        {{ $myLeader->balance }}
                                                                    @endif

                                                                </td>
                                                                <td>{{ $myLeader->subscription_code }}</td>
                                                                <td>{{ $myLeader->workStation ? $myLeader->workStation->title : '' }}
                                                                </td>
                                                                <td>{{ $myLeader->category ? $myLeader->category->name : '' }}
                                                                </td>

                                                                <td>
                                                                    @if ($myLeader->district)
                                                                        {{ $myLeader->district->name }}
                                                                        ({{ $myLeader->district_id }})
                                                                    @endif
                                                                </td>
                                                                <td>{{ $myLeader->referrer ? $myLeader->referrer->subscription_code : '' }}
                                                                </td>

                                                                {{-- <td>{{  $myLeader->referredTeam()->count() }} </td> --}}

                                                                <th>{{ $myLeader->created_at }}</th>

                                                            </tr>
                                                        </tbody>
                                                    @else
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="12" class="text-center text-danger h4">No
                                                                    Leader Found</td>
                                                            </tr>
                                                        </tbody>
                                                    @endif

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            <h4>My Reffer (Who I have referred)</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive ajax-data-container">
                                                <table class="table table-hover table-bordered table-striped table-sm }}"
                                                    style="white-space: nowrap">


                                                    <thead>
                                                        <tr class="nowrap">
                                                            <th>SL</th>
                                                            <th>ID</th>
                                                            <th>Tenant</th>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
                                                            <th>Balance</th>
                                                            <th>PF No.</th>
                                                            <th>Work Station</th>
                                                            <th>Category</th>
                                                            <th>District</th>
                                                            <th>Referer</th>
                                                            <th>Joining Date</th>
                                                        </tr>
                                                    </thead>
                                                    @if ($myReffer)
                                                        <tbody>
                                                            <?php $i = 1; ?>
                                                            <?php $i = ($myReffer->currentPage() - 1) * $myReffer->perPage() + 1; ?>
                                                            @foreach ($myReffer as $sc)
                                                                <tr class="nowrap">
                                                                    <td>{{ $i }}</td>
                                                                    <td>
                                                                        <div
                                                                            class="btn-group btn-group-xs w3-hover-shadow">
                                                                            <a class="btn btn-primary btn-xs"
                                                                                href="{{ route('admin.subcriberEdit', $sc) }}"
                                                                                target="_blank">Edit</a>
                                                                            <div class="btn-group " role="group">
                                                                                <button id="btnGroupDrop1" type="button"
                                                                                    class="btn btn-primary dropdown-toggle btn-xs"
                                                                                    data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                </button>
                                                                                <div class="dropdown-menu"
                                                                                    x-placement="bottom-start"
                                                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
                                                                                    <a
                                                                                        href="{{ route('admin.subscriberHistoryInfo', [$sc, 'type' => 'honorarium']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">Honorarium
                                                                                        </button></a>
                                                                                    <a
                                                                                        href="{{ route('admin.subscriberHistoryInfo', [$sc, 'type' => 'job']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">Posted
                                                                                            Job</button></a>
                                                                                    <a
                                                                                        href="{{ route('admin.subscriberHistoryInfo', [$sc, 'type' => 'work']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">All
                                                                                            Works of Job</button></a>
                                                                                    <a
                                                                                        href="{{ route('admin.subscriberHistoryInfo', [$sc, 'type' => 'move_to_wallet']) }}"><button
                                                                                            type="button"
                                                                                            class="dropdown-item btn btn-primary btn-xs">Balance
                                                                                            Move History</button></a>
                                                                                    @if ($sc->user)
                                                                                        <a
                                                                                            href="{{ route('admin.userHistoryInfo', ['user' => $sc->user_id, 'type' => 'subscribers']) }}"><button
                                                                                                type="button"
                                                                                                class="dropdown-item btn btn-primary btn-xs">All
                                                                                                Subcribers</button></a>

                                                                                        <a
                                                                                            href="{{ route('admin.userHistoryInfo', ['user' => $sc->user_id, 'type' => 'all_tr']) }}"><button
                                                                                                type="button"
                                                                                                class="dropdown-item btn btn-primary btn-xs">All
                                                                                                Tr Of Tenant</button></a>

                                                                                        <a
                                                                                            href="{{ route('admin.userHistoryInfo', ['user' => $sc->user_id, 'type' => 'deposit']) }}"><button
                                                                                                type="button"
                                                                                                class="dropdown-item btn btn-primary btn-xs">Deposit
                                                                                                of Tenant</button></a>

                                                                                        <a
                                                                                            href="{{ route('admin.userHistoryInfo', ['user' => $sc->user_id, 'type' => 'withdraw']) }}"><button
                                                                                                type="button"
                                                                                                class="dropdown-item btn btn-primary btn-xs">Withdraw
                                                                                                of Tenant</button></a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $sc->id }}</td>
                                                                    <td>
                                                                        @if ($sc->user)
                                                                            <a class="btn btn-xs {{ $sc->user->active ? '' : 'btn-danger' }}  w3-round w3-border"
                                                                                href="{{ route('admin.usersAll', ['user' => $sc->user]) }}">{{ $sc->user_id }}</a>
                                                                        @else
                                                                            {{ $sc->user_id }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $sc->user ? $sc->user->name : '' }}</td>
                                                                    <td>{{ $sc->user ? $sc->user->mobile : '' }}</td>
                                                                    <td>
                                                                        @if ($sc->balance > 0)
                                                                            <span
                                                                                class="badge badge-success">{{ $sc->balance }}</span>
                                                                        @else
                                                                            {{ $sc->balance }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $sc->subscription_code }}</td>
                                                                    <td>{{ $sc->workStation ? $sc->workStation->title : '' }}
                                                                    </td>
                                                                    <td>{{ $sc->category ? $sc->category->name : '' }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($sc->district)
                                                                            {{ $sc->district->name }}
                                                                            ({{ $sc->district_id }})
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $sc->referrer ? $sc->referrer->subscription_code : '' }}
                                                                    </td>
                                                                    <th>{{ $sc->created_at }}</th>
                                                                </tr>
                                                                <?php $i++; ?>
                                                            @endforeach
                                                        </tbody>
                                                    @endif

                                                </table>
                                                {{ $myReffer->render() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- <script>
        //     $(document).ready(function() {
        //         //    var mobile= $('#user').val();
        //         //    if (mobile.lenght < 14) {
        //         //        $("select#workstation").attr('disabled');
        //         //    }
        //         $('.select5').select2({
        //             theme: 'bootstrap4',
        //             containerCssClass: ".select5",
        //         });

        //         $('.select5').select2({
        //             theme: 'bootstrap4',
        //             // containerCssClass: ".search",
        //             // minimumInputLength: 1,
        //             ajax: {
        //                 data: function(params) {
        //                     return {
        //                         q: params.term, // search term
        //                         page: params.page
        //                     };
        //                 },
        //                 processResults: function(data, params) {
        //                     params.page = params.page || 1;
        //                     // alert(data[0].s);
        //                     var data = $.map(data, function(obj) {
        //                         obj.id = obj.id || obj.id;
        //                         return obj;
        //                     });
        //                     var data = $.map(data, function(obj) {
        //                         obj.text = obj.name + " (" + obj.subscription_code + ") (" + obj
        //                             .id + ")";
        //                         return obj;
        //                     });
        //                     return {
        //                         results: data,
        //                         pagination: {
        //                             more: (params.page * 30) < data.total_count
        //                         }
        //                     };
        //                 }
        //             },
        //         });
        //     });
        //     $('#newUser').click(function(e) {
        //         e.preventDefault();

        //         $("#hideShow").toggle();
        //     });
        // 
    </script>

    <script>
        $(function() {
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

        });
    </script>

    <script>
        $(document).ready(function() {



            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('.step2-select').select2({
                theme: 'bootstrap4',
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.mobile || obj.mobile;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.mobile;
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });


        });
    </script> --}}
    <script>
        $(document).ready(function() {

            // $('.select2').select2({
            //     theme: 'bootstrap4'
            // });

            $('.step2-select').select2({
                theme: 'bootstrap4',

                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.mobile;
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //// To


        });
    </script>
    <script>
        $(document).ready(function() {
            // seleect5 search
            // $('.seleect5').select2({
            //     theme: 'bootstrap4'
            // });

            $('.addmeReffer').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#myModal')
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.id + "- (" + obj.name + ")";
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //// To


        });
    </script>
    <script>
        $(document).ready(function() {
            // seleect5 search
            // $('.seleect5').select2({
            //     theme: 'bootstrap4'
            // });

            $('.search').select2({
                theme: 'bootstrap4',
                containerCssClass: ".search",
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.id + "- (" + obj.name + ")";
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //// To


        });
    </script>

@endpush
