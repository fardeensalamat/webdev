@extends('user.layouts.userMaster')

@section('content')

<br>
    <section class="content">

        <div class="card bg-info">
            <div class="card-body">
                <h3>Employee Check In</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('user.makeStoreCheckIn')}}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                       <div class="form-group">

                                           <label for="name">Shop Check In</label>

                                           <input type="text" name="name"  placeholder="Enter Shop Name" class="form-control" required>

                                       </div>



                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                       <div class="form-group">

                                           <label for="name">Phone</label>

                                           <input type="text" name="phone"  placeholder="Enter Phone Number (Optional)" class="form-control" >

                                       </div>

                                    </div>
                                    <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="name">Google Location</label>

                                        <input type="text" name="location"  placeholder="Enter Location" class="form-control"  id="location-input" autocomplete="off" required>

                                        <input type="hidden" name="lat" class="form-control"  id="lat" >
                                        <input type="hidden" name="lng" class="form-control" id="lng">

                                    </div>



                                    </div>

                                </div>

                                <div class="row">

                                        <div class="col-md-12">

                                        <label for="name">Note</label>

                                        <textarea name="note" type="text" class="form-control"  cols="45" rows="3"></textarea>

                                        </div>

                                        </div>



                                </div>

                                <div class="row">

                                        <div class="col-md-12" style="margin-left: 1vw; margin-bottom: 1vw;">

                                        <button type="submit" class="btn btn-info">Save</button>



                                     </div>

                                 </div>



                             </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>


@endsection
<script src="{{ asset('js/location.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcjU4Z83IrRvF3DdDYqsBW66_2eUC8krU&libraries=places&callback=initAutocomplete"
        async defer></script>
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- jQuery library asrana-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>

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
        });
        $('#newUser').click(function(e) {
            e.preventDefault();

            $("#hideShow").toggle();
        });
    </script>
    <script>
        $('select#workstation').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {

                    $('#category').empty();
                    $.each(data.categories, function(index, categories) {
                        $('select#category').append('<option value="' +
                            categories.id + '">' + categories.name.en +
                            '</option>');
                        // console.log(categories.id);
                    })
                }
            });
        });

        $('select#category').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            var user = $('select#user').val();
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    user: user,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data)
                    $('.another').empty();
                    $('.another').append(data.html);


                    var autocomplete;

                    function initAutocomplete() {
                        // Create the autocomplete object, restricting the search to geographical
                        // location types.
                        autocomplete = new google.maps.places.Autocomplete(
                            /** @type {!HTMLInputElement} */
                            (document.getElementById('location-input')), {
                                types: ['geocode']
                            });

                        // When the user selects an address from the dropdown, populate the address
                        // fields in the form.
                        autocomplete.addListener('place_changed', fillInAddress);
                    }

                    function fillInAddress() {
                        // Get the place details from the autocomplete object.
                        var place = autocomplete.getPlace();

                        document.getElementById('lat').value = place.geometry.location.lat();
                        document.getElementById('lng').value = place.geometry.location.lng();
                        document.getElementById('location-selected-text').value = place.formatted_address;


                    }

                }
            });
        });
    </script>
@push('js')



@endpush
