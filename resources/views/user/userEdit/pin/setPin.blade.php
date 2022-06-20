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
                            <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span
                                    class="badge badge-light">

                                    Tenant Pin Change Step 3/3

                                </span>
                            </h3>
                        </div>
                        <div class="card-body" style="min-height: 200px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card card-primary">
                                            <div class="card-header">{{ __('Pin Change of Tenant') }}
                                                ({{ $user->mobile }})</div>

                                            <div class="card-body" id="pinSet">
                                                <form method="POST" action="{{ route('user.userPinUpdate') }}"
                                                    enctype="multipart/form-data" id="passOTP">
                                                    @csrf
                                                    <input type="hidden" name="check" value="@if (session('check'))
                                                {{ session('check') }}
                                                @else
                                                unchecked
                                                @endif">
                                                    <div class="form-group row">
                                                        <label for="new_pin"
                                                            class="col-md-4 col-form-label text-md-right">{{ __('Set New Pin (Number)') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="new_pin" type="tel"
                                                                class="form-control @error('new_pin') is-invalid @enderror"
                                                                name="new_pin" placeholder="Enter New Pin Number">

                                                            @error('new_pin')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button  type="submit"
                                                                class="btn btn-primary">
                                                                {{ __('Update') }}
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
            // $(document).ready(function() {
            //     $('#passForm').submit(function(e) {
            //         e.preventDefault();
            //         var form = $(this);
            //         var url = form.attr('action');
            //         $.ajax({
            //             type: "POST",
            //             url: url,
            //             data: form.serialize(), // serializes the form's elements.
            //             success: function(data) {
            //                 if (data.status == 'success') {
            //                     $('#password').attr('readonly');
            //                 }
            //                 alert("DONE");

            //             }
            //         });
            //     })
            // $('#passOTP').submit(function(e) {
            //     e.preventDefault();
            //     var form = $(this);
            //     var url = form.attr('action');
            //     $.ajax({
            //         type: "POST",
            //         url: url,
            //         data: form.serialize(), // serializes the form's elements.
            //         success: function(data) {
            //             if (data.status == 'success') {
            //                 $('#pinSet').html(data.html);
            //             }
            //         }
            //     });
            // })
            });
        </script>



    @endpush
