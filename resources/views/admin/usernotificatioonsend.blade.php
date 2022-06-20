@extends('admin.layouts.adminMaster')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Notification Send Panel</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.usernotificatioonsend') }}" method="POST" id='my-form'>
                                @csrf
                                <div class="form-group">
                                    <label for="type">Workstation</label>
                                    <select name="workstation" id="workstation"class="form-control" data-url={{ route('user.searchCategoryAjax') }} >
                                        <option value="">Select Workstation</option>
                                        @foreach ($workstation as $wt)
                                            <option value="{{ $wt->id }}">
                                                {{ $wt->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>

                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name='title'  class="form-control" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message">Messages</label><br>
                                    <textarea name="message" type="text" class="form-control" id="" cols="45" rows="3"></textarea>
                                    
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="details">Details</label><br>
                                    <textarea name="details" type="text" class="form-control" id="" cols="45" rows="3"></textarea>
                                    
                                    @error('details')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="type">SMS Key</label>
                                    <input type="text" name='key'  class="form-control" required>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Send">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </section>
@endsection
@push('js')

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
                        document.getElementById('location-selected-text').value = place
                            .formatted_address;


                    }

                }
            });
        });
    </script>

@endpush
