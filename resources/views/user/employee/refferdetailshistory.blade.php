@extends('user.layouts.userMaster')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('alerts.alerts')
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
                                                        <th width="100">Refferer</th>
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

                                                               T-{{ $intRef->user_id }}

                                                               
                                                                SP-{{ $intRef->id }}
                                                              

                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th width="100">My Referrals</th>
                                                        <td>
                                                            {{$prepaid_reffer}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Paid Subscribers</th>
                                                        <td>

                                                           {{ $user->subscriptions->where('free_account', 0)->count() }}
                                                              

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Unpaid Subscribers</th>
                                                        <td>

                                                           {{ $user->subscriptions->where('free_account', 1)->count() }}
                                                              

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Sales History</th>
                                                        <td>
                                                          Total Sales: {{$sales_count}}
                                                          Total Amount: {{$sales_total}}
                                                          

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="100">Purchase History</th>
                                                        <td>
                                                            Total Purchase: {{$purchase_count}}
                                                            Total Amount: {{$purchase_total}}

                                                           

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
            </div>
        </div>
    </section>
@endsection


