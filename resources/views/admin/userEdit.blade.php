@extends('admin.layouts.adminMaster')

@push('css')


    <style>
        tr.nowrap td {
            white-space: nowrap;
        }

        tr.nowrap th {
            white-space: nowrap;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">

        <br>

        <div class="row">

            <div class="col-sm-12">


                @include('alerts.alerts')




                @if (Auth::user()->roleItems()->count() < 1)
                <div class="card card-widget">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span
                                class="badge badge-light">

                                Tenant Information Update

                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">
                        <div class="container">
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header w3-blue">{{ __('Update Tenant') }} ({{ $user->mobile }})
                                        </div>

                                        <div class="card-body">
                                            <form method="POST"
                                                action="{{ route('admin.userUpdate', ['user' => $user, 'status' => 'basic']) }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                                    <div class="col-md-8">
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') ?: $user->name }}" required
                                                            autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?: $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}


                                                <div class="form-group row">
                                                    <label for="mobile"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                                    <div class="col-md-8">


                                                        <input id="mobile" type="text"
                                                            class="form-control @error('mobile') is-invalid @enderror"
                                                            value="{{ old('mobile') ?: $user->mobile }}" @if (Auth::user()->roleItems()->count() < 1)

                                                        name="mobile"
                                                    @else
                                                        name=""
                                                        readonly
                                                        @endif

                                                        autocomplete="mobile">

                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                                                {{-- <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div> --}}


                                                {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="wallet_lock" id="wallet_lock"  {{ $user->wallet_lock ? 'checked' : ''}}>

                                    <label for="wallet_lock" class="form-check-label" >
                                        {{ __('Wallet lock') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                                                <div class="form-group row">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="active"
                                                                id="active" {{ $user->active ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="active">
                                                                {{ __('Active') }}
                                                            </label>
                                                            <input type="date" name="status_auto_change_date"
                                                                class="form-control"
                                                                value="{{ $user->status_auto_change_date }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="is_employee"
                                                                id="is_employee" {{ $user->is_employee ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="is_employee">
                                                                {{ __('Is Employee') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="is_freelancer"
                                                                id="is_freelancer" {{ $user->is_freelancer ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="is_employee">
                                                                {{ __('Is Freelancer') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="is_vendor"
                                                                id="is_vendor" {{ $user->is_vendor ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="is_vendor">
                                                                {{ __('Is Vendor') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($user->is_employee==true)
                                                    <div class="form-group row">
                                                        <div class="col-md-8 offset-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="is_tso"
                                                                    id="is_tso" {{ $user->is_tso ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="is_tso">
                                                                    {{ __('Is TSO') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form-group row">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="referral"
                                                                id="referral" {{ $user->referral ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="referral">
                                                                {{ __('Show Refferal info and salse History') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($user->is_employee==true)

                                                    <div class="form-group row">
                                                        <div class="col-md-8 offset-md-4">
                                                            <select name="group_id" id="group_id" class="form-control select2">
                                                                <option value="">Select One</option>
                                                                @foreach ($users as $tso)
                                                                <option value="{{$tso->id}}" @if ($user->group_id==$tso->id) selected @endif>{{$tso->name}}</option>   
                                                                @endforeach 
                                                            </select>

                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Update') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header w3-green">{{ __('Update Balance') }} (Total:
                                            {{ $user->totalBalance() }})
                                            @if (Auth::user()->roleItems()->count() < 1)
                                                <span class="badge badge-light"> New Updated: <span
                                                        class="new-balance">{{ $user->totalBalance() }}</span> </span>
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <form method="POST"
                                                action="{{ route('admin.userUpdate', ['user' => $user, 'status' => 'balance']) }}">
                                                @csrf

                                                @if (Auth::user()->roleItems()->count() < 1)

                                                    <div class="form-group row">
                                                        <label for="name"
                                                            class="col-md-6 col-form-label text-md-right">{{ __('Available Balance') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="number" min="0" step="any"
                                                                class="form-control balance-change-input @error('balance') is-invalid @enderror"
                                                                name="balance"
                                                                value="{{ old('balance') ?: $user->balance }}"
                                                                autocomplete="balance">

                                                            @error('balance')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                   

                                                    <div class="form-group row">
                                                        <label for="name"
                                                            class="col-md-6 col-form-label text-md-right">{{ __('System Balance') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="number" min="0" step="any"
                                                                class="form-control system-balance-change-input @error('system_balance') is-invalid @enderror"
                                                                name="system_balance"
                                                                value="{{ old('system_balance') ?: $user->system_balance }}"
                                                                autocomplete="system_balance">

                                                            @error('balance')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="name"
                                                            class="col-md-6 col-form-label text-md-right">{{ __('Ad Topup Balance') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="number" min="0" step="any"
                                                                class="form-control system-balance-change-input @error('ad_balance') is-invalid @enderror"
                                                                name="ad_balance"
                                                                value="{{ old('ad_balance') ?: $user->ad_balance }}"
                                                                autocomplete="ad_balance">

                                                            @error('ad_balance')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                   @if($user->is_employee==true)
                                                        <div class="form-group row">
                                                            <label for="name"
                                                                class="col-md-6 col-form-label text-md-right">{{ __('Employee Balance') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="name" type="number" min="0" step="any"
                                                                    class="form-control system-balance-change-input @error('employee_balance') is-invalid @enderror"
                                                                    name="employee_balance"
                                                                    value="{{ old('employee_balance') ?: $user->employee_balance }}"
                                                                    autocomplete="employee_balance">

                                                                @error('employee_balance')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif


                                                    <div class="form-group row">
                                                        <label for="name"
                                                            class="col-md-6 col-form-label text-md-right">{{ __('Honorarium Earning Set') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="number" min="0" step="any"
                                                                class="form-control system-balance-change-input @error('honorarium_earning_set') is-invalid @enderror"
                                                                name="honorarium_earning_set"
                                                                value="{{ old('honorarium_earning_set') ?: $user->honorarium_earning_set }}"
                                                                autocomplete="honorarium_earning_set">

                                                            @error('honorarium_earning_set')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                @endif
                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-3 col-form-label text-md-right">{{ __('Note') }}</label>

                                                    <div class="col-md-9">
                                                        <input id="note" type="text" class="form-control" name="note" autocomplete="note">

                                                        @error('note')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="wallet_lock" id="wallet_lock"
                                                                {{ $user->wallet_lock ? 'checked' : '' }}>

                                                            <label for="wallet_lock" class="form-check-label">
                                                                {{ __('Wallet lock') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="purchase_lock" id="purchase_lock"
                                                                {{ $user->purchase_lock ? 'checked' : '' }}>

                                                            <label for="purchase_lock" class="form-check-label">
                                                                {{ __('Purchase lock') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="withdraw_lock" id="withdraw_lock"
                                                                {{ $user->withdraw_lock ? 'checked' : '' }}>

                                                            <label for="withdraw_lock" class="form-check-label">
                                                                {{ __('Withdraw lock') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-6">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Update') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-widget">
                                        <div class="card-header with-border w3-teal">
                                            <h3 class="card-title">Send Temporary Pass</h3>
                                        </div>
                                        <div class="card-body" style="min-height: 205px;">
                                            <form method="post" action="{{ route('admin.newTempPassSendPost', $user) }}">
                                                {{ csrf_field() }}
                                                <div
                                                    class="form-group form-group-lg  {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                                    <label for="new_password">New Password:</label>
                                                    <input autocomplete="off" type="text"
                                                        placeholder="New Password for {{ $user->username }}"
                                                        name="new_password" @if (Auth::user()->roleItems()->count() < 1)
                                                    value="{{ old('new_password') ?: $user->password_temp }}"
                                                    @endif
                                                    class="form-control" id="new_password">
                                                    @if (Auth::user()->roleItems()->count() < 1)
                                                        <span class="help-block">Previous Temp Pass: <b
                                                                class="w3-text-purple">{{ $user->password_temp }}
                                                            </b></span>
                                                    @endif
                                                    @if ($errors->has('new_password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('new_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <button type="submit" class="w3-btn w3-round w3-blue">Set & Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                @endif



                <div class="card text-left">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa fa-th text-blue"></i> Tenant Information
                        </h4>
                    </div>
                    <div class="card-body w3-light-gray">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-widget">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-bordered">

                                                <tbody>
                                                    <tr>
                                                        <th width="100">ID</th>
                                                        <td>
                                                            @if ($user->active)
                                                                <span
                                                                    class="badge badge-success">{{ $user->id }}</span>
                                                            @else
                                                                <span class="badge badge-danger">{{ $user->id }}</span>
                                                            @endif

                                                            @if ($user->wallet_lock)
                                                                (<span class="badge badge-danger">Lock</span>)
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Name</th>
                                                        <td>{{ $user->name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Mobile</th>
                                                        <td>{{ $user->mobile }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Email</th>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>




                                                    <tr>
                                                        <th width="100">Balance</th>
                                                        <td>

                                                            @if ($user->totalBalance() > 0)
                                                                <span
                                                                    class="badge badge-success">{{ $user->totalBalance() }}</span>
                                                            @else
                                                                {{ $user->totalBalance() }}
                                                            @endif

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">PF Balance</th>
                                                        <td>

                                                            @if ($user->sfBalanceTotal() > 0)
                                                                <span
                                                                    class="badge badge-success">{{ $user->sfBalanceTotal() }}</span>
                                                            @else
                                                                {{ $user->sfBalanceTotal() }}
                                                            @endif

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Deposit</th>
                                                        <td>

                                                            @if ($user->totalDeposit() > 0)
                                                                <span
                                                                    class="badge badge-success">{{ $user->totalDeposit() }}</span>
                                                            @else
                                                                {{ $user->totalDeposit() }}
                                                            @endif

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Withdraw</th>
                                                        <td>

                                                            @if ($user->totalWithdraw() > 0)
                                                                <span
                                                                    class="badge badge-danger">{{ $user->totalWithdraw() }}</span>
                                                            @else
                                                                {{ $user->totalWithdraw() }}
                                                            @endif

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Facebook group link</th>
                                                        <td>
                                                            {{ $user->sc_fb_group_link }}
                                                            @if ($user->sc_fb_group_link_image)
                                                                <a href="{{ asset('storage/user/others/' . $user->sc_fb_group_link_image) }}"
                                                                    download>
                                                                    ( <i class="fa fa-download"></i> Download)
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Youtube channel link</th>
                                                        <td>
                                                            {{ $user->sc_youtube_channel_link }}
                                                            @if ($user->sc_fb_group_link_image)
                                                                <a href="{{ asset('storage/user/others/' . $user->sc_youtube_channel_link_image) }}"
                                                                    download>
                                                                    ( <i class="fa fa-download"></i> Download)
                                                            @endif
                                                        </td>
                                                    </tr>



                                                    <tr>
                                                        <th width="100">Joining Date</th>
                                                        <td>{{ $user->created_at }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">My Reffer</th>
                                                        <td>
                                                            {{ $user->introducerRefferer() ? $user->introducerRefferer()->id : null }}
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card card-widget">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-bordered">

                                                <tbody>

                                                    <tr>
                                                        <th width="100">Introducer</th>
                                                        <td>
                                                            @if ($intRef = $user->introducerRefferer())

                                                                <a class="btn btn-xs w3-round w3-border"
                                                                    href="{{ route('admin.usersAll', ['user' => $intRef->user_id]) }}">T-{{ $intRef->user_id }}</a>

                                                                <a href="{{ route('admin.userHistoryInfo', ['user' => $intRef->user_id, 'type' => 'subscribers']) }}"
                                                                    class="btn btn-xs w3-round w3-border">
                                                                    {{ $intRef->id }}
                                                                </a>

                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    @if (Auth::user()->roleItems()->count() < 1)
                                                        <tr>
                                                            <th width="100">My Referrals</th>
                                                            <td>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'reffer', 'status' => 'standard']) }}">
                                                                    | Click to get list</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th width="100">Paid Subscribers</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'subscribers', 'status' => 'standard']) }}">{{ $user->subscriptions->where('free_account', 0)->count() }}
                                                                | Click to get list</a>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Unpaid Subscribers</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'subscribers', 'status' => 'post_paid']) }}">{{ $user->subscriptions->where('free_account', 1)->count() }}
                                                                | Click to get list</a>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Paid Shop</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'shop','status' => 'paidshop']) }}">{{ $paidshop }}  | Click to get list </a>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Unpaid Shop</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'shop','status' => 'unpaidshop']) }}" >{{ $unpaidshop }}  | Click to get list</a>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Tr History</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'all_tr']) }}">Click
                                                                to get list</a>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Deposit History</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'deposit']) }}">Click
                                                                to get list</a>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Withdraw History</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'withdraw']) }}">Click
                                                                to get list</a>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">Honorarium History</th>
                                                        <td>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.userHistoryInfo', [$user, 'type' => 'honorarium']) }}">Click
                                                                to get list</a>

                                                        </td>
                                                    </tr>









                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>




                    </div>
                </div>

                @if (Auth::user()->roleItems()->count() < 1)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">Refferr
                                ({{ $user->introducerRefferer() ? $user->introducerRefferer()->id : null }})</div>
                            <div class="card-body">
                                {{-- {{ gettype($user->id) }} --}}
                                <form action="{{ route('admin.updateReferrals', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="select_subscriber">
                                            <h3>Update Reffer ()</h3>
                                        </label>
                                        <select id="select_subscriber" name="subscriber" required
                                            class="form-control user-select select2-container step2-select select2"
                                            data-placeholder="Reffer Id, Name, Subscription Code"
                                            data-ajax-url="{{ route('admin.selectNewReffer') }}" data-ajax-cache="true"
                                            data-ajax-dataType="json" data-ajax-delay="200" style="">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">Note</div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Add User Note</h4>
                                    <form action="{{ route('admin.addUserNote', ['user' => $user->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" cols="30" rows="3" class="form-control"
                                                placeholder="Write Note"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" id="image" name="image">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Add Note" class="btn btn-success">
                                        </div>
                                    </form>
                                    <hr>
                                    <h4 class="text-center">Note Details</h4>
                                    <div class="table-responsive">
                                        <table class="w3-table-all" style="white-space: nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Note</th>
                                                    <th>Image</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>

                                                <?php $i = ($notes->currentPage() - 1) * $notes->perPage() + 1; ?>
                                                @forelse ($notes as $note)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $note->note }}</td>
                                                        <td><img src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $note->fi()]) }}"
                                                                alt=""></td>
                                                        <td>{{ $note->created_at }}</td>
                                                        <td>
                                                            <div class="btn-group btn-sm">
                                                                <a href="{{ route('admin.deleteUserNote', ['note' => $note->id, 'user' => $user->id]) }}"
                                                                    onclick="return confirm('You want to delete this Note')"
                                                                    class="btn btn-xs btn-danger"><i
                                                                        class="fas fa-trash"></i></a>
                                                                <a href="#" class=" btn btn-xs btn-info"
                                                                    data-toggle="modal" data-target="#edit"><i
                                                                        class="fas fa-edit"></i></a>
                                                                <a href="#" class="btn btn-xs btn-success"
                                                                    data-toggle="modal" data-target="#view"><i
                                                                        class="fas fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                        {{-- Modal --}}
                                                        <div class="modal fade" id="edit" tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle">Edit Note</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('admin.noteUpdate', ['note' => $note->id, 'user' => $user->id]) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="note">Note</label>
                                                                                <textarea name="note_details" id="note"
                                                                                    cols="30" rows="3"
                                                                                    class="form-control"
                                                                                    placeholder="Write Note">{{ $note->note }}</textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="image">Image</label>
                                                                                <input type="file" id="image" name="image">
                                                                                <br>
                                                                                <img src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $note->fi()]) }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="view" tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-top" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle">View Note</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <p><b>User: </b> {{ $user->name }}</p>
                                                                        <p><b>Note: </b> {{ $note->note }}</p>
                                                                        <p><b>Image: </b> </p>
                                                                        <img class="img-fluid"
                                                                            src="{{ route('imagecache', ['template' => 'cplg', 'filename' => $note->fi()]) }}"
                                                                            alt="">
                                                                        <p><b>Created Date: </b> {{ $note->created_at }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                    </div>
                                    </tr>
                                    <?php $i++; ?>
                                @empty

                                    @endforelse
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->roleItems()->count() < 1)
                @if (isset($ubes))
                    <div class="col-md-12">
                        <div class="card card-widget">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span
                                        class="badge badge-light">

                                        Balance Update Information

                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="w3-table-all">
                                    <thead>
                                        <tr>
                                            <th>Updated By</th>
                                            <th>Previous Balance</th>
                                            <th>Changed Balance</th>
                                            <th>New Balance</th>
                                            <th>Employee Previous Bal</th>
                                            <th>Employee Changed Bal</th>
                                            <th>Employee New Bal</th>
                                            <th>Date</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($ubes as $ube)
                                            <tr>
                                                <th>{{ $ube->user ? $ube->user->name : '-' }}</th>
                                                <th>{{ $ube->previous_balance }}</th>
                                                <th>{{ $ube->changed_balance }}</th>
                                                <th>{{ $ube->new_balance }}</th>
                                                <th>{{ $ube->employee_previous_balance }}</th>
                                                <th>{{ $ube->employee_changed_balance }}</th>
                                                <th>{{ $ube->employee_new_balance }}</th>
                                                <th>{{ $ube->created_at }}</th>
                                                <th>{{ $ube->note }}</th>
                                                <th>{{ $ube->type }}</th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                {{ $ubes->render() }}
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($user_update_informations))
                    <div class="col-md-12">
                        <div class="card card-widget">
                            <div class="card-header">
                                <h3 class="card-title"><i
                                        class="fa fa-briefcase
                    text-primary"></i> <span
                                        class="badge badge-light">

                                        Account Status Update Information

                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="w3-table-all">
                                    <thead>
                                        <tr>
                                            <th>Modified By</th>
                                            <th>Previous Name</th>
                                            <th>Changed Name</th>
                                            <th>Previous Mobile</th>
                                            <th>Changed Mobile</th>
                                            <th>Account Status</th>
                                            <th>date</th>
                                            <th>Description</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($user_update_informations as $ube)
                                            <tr>
                                                <th>{{ $ube->addedby_id ? $ube->updatedBy->name : '-' }}</th>
                                                <th>{{ $ube->previus_name }}</th>
                                                <th>{{ $ube->new_name }}</th>
                                                <th>{{ $ube->previus_mobile }}</th>
                                                <th>{{ $ube->new_mobile }}</th>
                                                <th>
                                                    @if ($ube->active)
                                                        <span class="text-success">Active</span>
                                                    @else
                                                        <span class="text-danger">Inactive</span>
                                                    @endif
                                                </th>
                                                <th>
                                                    {{ $ube->created_at }}
                                                </th>
                                                <th>{{ $ube->description }}</th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                {{ $user_update_informations->render() }}
                            </div>
                        </div>
                    </div>
                @endif

            @endif
        </div>
        </div>



        </div>
        </div>
        </div>
        </div>



    </section>
@endsection


@push('js')
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {


            //////////////////////
            $(document).on('keyup change', '.balance-change-input, .system-balance-change-input', function(e) {
                var b = parseFloat($(".balance-change-input").val());
                var sb = parseFloat($(".system-balance-change-input").val());
                var t = b + sb;
                // alert(t);
                $(".new-balance").text(t);
            });
            //////////////////////
        });
    </script>
    <script>
        $(document).ready(function() {
            //    var mobile= $('#user').val();
            //    if (mobile.lenght < 14) {
            //        $("select#workstation").attr('disabled');
            //    }
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
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.name + " (" + obj.subscription_code + ") (" + obj
                                .id + ")";
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
        $('#newUser').click(function(e) {
            e.preventDefault();

            $("#hideShow").toggle();
        });
    </script>

@endpush
