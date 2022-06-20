<!-- Main content -->
<br>
<section class="content">

    <div class="row">
        {{-- <div class="col-md-4 hidden-xs">

      @include('user.includes.others.userBasic')
         

 
        </div> --}}
        <!-- /.col -->
        <div class="col-md-12">

            @include('alerts.alerts')


            <div class="card card-primary">
                <div class="card-header">
                    Balance Withdraw
                </div>
                <div class="card-body" style="min-height: 470px;">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="w3-card">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">
                                            Cashout / Withdraw
                                        </h3>
                                    </div>
                                    <div class="card-body" style="min-height: 200px;">

                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="card card-default">
                                                    <div class="card-body">

                                                        <dl class="dl-horizontal">


                                                            <dt>Available Balance :
                                                                <span
                                                                    class="badge {{ $user->balance >= 1 ? ' badge-success ' : 'badge-default' }}">
                                                                    {{ $user->balance }} TK
                                                                </span> &nbsp;

                                                                <input type="hidden" id="current-balance"
                                                                    value="{{ $user->balance }}">
                                                            </dt>

                                                            <dt>Cashout Date : {{ date('d-M-Y') }}</dt>
                                                            {{-- <dd>{{ date('d-M-Y') }}</dd> --}}

                                                            <dt>New Balance : <span class="new-balance"></span></dt>

                                                            {{-- <dd class="new-balance"></dd> --}}



                                                        </dl>


                                                    </div>
                                                </div>




                                            </div>
                                            <div class="col-sm-6">

                                                <div class="card card-default">
                                                    <div class="card-body">


                                                        <form action="{{ route('user.commissionWithdrawPost') }}"
                                                            method="post">

                                                            @csrf


                                                            <div class="form-group form-group-sm">
                                                                <label for="cashout_from">Cashout From:*</label>

                                                                <div class="radio radio-agent form-check"><input type="radio" class="form-check-input" name="cashout_from" 
                                                                            value="bank_account">
                                                                            <label class="form-check-label"><b>Bank
                                                                                Account</b></label>
                                                                        
                                                                </div>

                                                                <div class="radio radio-recharge form-check">
                                                                    <input type="radio" name="cashout_from"
                                                                        class="form-check-input"
                                                                        value="mobile_recharge">
                                                                    <label class="form-check-label"><b>Mobile
                                                                            Recharge</b></label>
                                                                </div>

                                                                <div class="radio radio-bkash form-check ">
                                                                    <input type="radio" name="cashout_from"
                                                                        class="form-check-input" value="bkash">
                                                                    <label class="form-check-label"><b>bKash, Nagad,
                                                                            Rocket</b></label>

                                                                </div>
                                                                @if(Auth::user()->is_employee==true)
                                                                    <div class="radio radio-cash form-check ">
                                                                        <input type="radio" name="cashout_from"
                                                                            class="form-check-input" value="cash">
                                                                        <label class="form-check-label"><b>Cash</b></label>

                                                                    </div>
                                                                @endif

                                                                <hr class="p-0 mb-0 ml-0 mr-0 mt-3">



                                                            </div>

                                                            <div class="from-agent-list" style="display:none;">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="bank_amount">Cashout
                                                                                Amount:*</label>
                                                                            <input type="number" min="10" step="1"
                                                                                max="{{ (int) $user->balance }}"
                                                                                name="bank_amount"
                                                                                class="form-control cashout_amount"
                                                                                id="cashout_amount"
                                                                                placeholder="Cashout Amount">
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="pin_for_bank">4 Digit PIN
                                                                                Code:*</label>
                                                                            <input type="tel" min="1" step="1"
                                                                                name="pin_for_bank"
                                                                                class="form-control pin_for_bkash pin-check"
                                                                                id="pin_for_bkash"
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
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="account_number">Bank Account
                                                                                Number:*</label>
                                                                            <input type="number" name="account_number"
                                                                                class="form-control "
                                                                                id="account_number"
                                                                                placeholder="Account Number">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="account_holder_name">Account
                                                                                Holder Name:*</label>
                                                                            <input type="text"
                                                                                name="account_holder_name"
                                                                                class="form-control "
                                                                                id="account_holder_name"
                                                                                placeholder="Account Holder Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="bank_name">Bank Name:*</label>
                                                                            <input type="text" name="bank_name"
                                                                                class="form-control " id="bank_name"
                                                                                placeholder="Bank Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="branch_name">Branch
                                                                                Name:*</label>
                                                                            <input type="text" name="branch_name"
                                                                                class="form-control " id="branch_name"
                                                                                placeholder="Brance Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                      <div class="form-group form-group-sm  ">
                                                                          <label for="details">Details :</label>
                                                                          <textarea name="details" class="form-control" id="details" cols="30" rows="3"></textarea>
                                                                         
                                                                      </div>
                                                                  </div>
                                                                </div>

                                                                <span class="help-block">Don't match PIN? <b> <br>
                                                                        <a href="{{ route('user.userPinChange') }}"
                                                                            class="new-pin-link-">Click here to set
                                                                            your PIN</a></b>
                                                                </span>
                                                                <span class="new-pin-success-msg"></span>

                                                            </div>


                                                            <div class="recharge-input-list " style="display:none;">
                                                                <div class="form-group form-group-sm ">
                                                                    <label>Recharge Type:*</label>

                                                                    <br>
                                                                    <div class="form-check">
                                                                        <input type="radio" name="recharge_type"
                                                                            class="form-check-input" value="prepaid"
                                                                            checked>
                                                                        <label
                                                                            class="form-check-label pr-4"><b>Prepaid</b></label>

                                                                        <input type="radio" name="recharge_type"
                                                                            class="form-check-input pl-3"
                                                                            value="postpaid">
                                                                        <label
                                                                            class="form-check-label"><b>Postpaid</b></label>
                                                                    </div>

                                                                    {{-- <label class="radio-inline"><input type="radio" name="recharge_type" value="skitto">Skitto</label> --}}

                                                                </div>


                                                                <div class="form-group form-group-sm ">
                                                                    <label>Mobile Number:*</label>

                                                                    <input type="text" name="mobile_number"
                                                                        class="form-control mobile_number"
                                                                        id="mobile_number" placeholder="Mobile Number">

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="recharge_amount">Recharge
                                                                                Amount:*</label>


                                                                            <input type="number" min="10" step="1"
                                                                                max="{{ (int) $user->balance < 1000 ? (int) $user->balance : 1000 }}"
                                                                                name="recharge_amount"
                                                                                class="form-control recharge_amount"
                                                                                id="recharge_amount"
                                                                                placeholder="Recharge Amount">
                                                                        </div>


                                                                    </div>
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="pin_for_recharge">4 Digit PIN
                                                                                Code:*</label>
                                                                            <input type="tel" min="1" step="1"
                                                                                name="pin_for_recharge"
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
                                                                </div>

                                                                <span class="help-block">Don't match PIN? <b> <br>
                                                                        <a href="{{ route('user.userPinChange') }}"
                                                                            class="new-pin-link-">Click here to set
                                                                            your PIN</a></b>
                                                                </span>
                                                                <span class="new-pin-success-msg"></span>



                                                            </div>

                                                           


                                                            <div class="bkash-input-list" style="display:none;">
                                                                <div class="form-group form-group-sm">
                                                                    <label>Service Type:*</label>

                                                                    <br>
                                                                    <div class="form-check">
                                                                        <input type="radio" name="service_type"
                                                                            class="form-check-input" value="bkash"
                                                                            checked>
                                                                        <label
                                                                            class="form-check-label pr-4"><b>bKash</b></label>
                                                                        <br>
                                                                        <input type="radio" name="service_type"
                                                                            class="form-check-input pl-3" value="nagad">
                                                                        <label
                                                                            class="form-check-label"><b>Nagad</b></label>
                                                                        <br>

                                                                        <input type="radio" name="service_type"
                                                                            class="form-check-input pl-3"
                                                                            value="rocket">
                                                                        <label
                                                                            class="form-check-label"><b>Rocket</b></label>
                                                                    </div>


                                                                </div>

                                                                <div class="form-group form-group-sm ">
                                                                    <label>bKash, Nagad, Rocket Personal
                                                                        Number:*</label>

                                                                    <input type="text" name="cashin_number"
                                                                        class="form-control bkash_number"
                                                                        id="bkash_number" placeholder="personal number">

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="bkash_amount">CashIn
                                                                                Amount:*</label>


                                                                            <input type="number" min="50" step="1"
                                                                                max="" name="bkash_amount"
                                                                                class="form-control bkash_amount"
                                                                                id="bkash_amount"
                                                                                placeholder="Recharge Amount">
                                                                        </div>


                                                                    </div>
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="pin_for_bkash">4 Digit PIN
                                                                                Code:*</label>
                                                                            <input type="tel" min="1" step="1"
                                                                                name="pin_for_bkash"
                                                                                class="form-control pin_for_bkash pin-check"
                                                                                id="pin_for_bkash"
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
                                                                </div>

                                                                <span class="help-block">Don't match PIN? <b> <br>
                                                                        <a href="{{ route('user.userPinChange') }}"
                                                                            class="new-pin-link-">Click here to set
                                                                            your PIN</a></b>
                                                                </span>
                                                                <span class="new-pin-success-msg"></span>



                                                            </div>
                                                            <div class="from-cash-list" style="display:none;">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="cash_amount">Cashout
                                                                                Amount:*</label>
                                                                            <input type="number" min="10" step="1"
                                                                                max="{{ (int) $user->balance }}"
                                                                                name="cash_amount"
                                                                                class="form-control cashout_amount"
                                                                                id="cashout_amount"
                                                                                placeholder="Cashout Amount">
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-sm  ">
                                                                            <label for="pin_for_bank">4 Digit PIN
                                                                                Code:*</label>
                                                                            <input type="tel" min="1" step="1"
                                                                                name="pin_for_cash"
                                                                                class="form-control pin_for_bkash pin-check"
                                                                                id="pin_for_bkash"
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
                                                                </div>
                                                                

                                                            </div>

                                                           


                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm mt-3">Submit</button>
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
                </div>
            </div>




        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
