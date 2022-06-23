@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  @include('admin.media.parts.mediaAll')
@endsection


@push('js')

<script>
	
	$(function(){

$(document).on('click', '.copyboard', function(e) {
  e.preventDefault();


  $(".copyboard").text('Copy to Clipboard');

  $(this).text('Coppied!');
  var copyText = $(this).attr('data-text');

  var textarea = document.createElement("textarea");
  textarea.textContent = copyText;
  textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand("copy"); 

  document.body.removeChild(textarea);
});

	});
</script>
@endpush

@push('js')
    <script src="{{ asset('js/location.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcjU4Z83IrRvF3DdDYqsBW66_2eUC8krU&libraries=places&callback=initAutocomplete"
        async defer></script>
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

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
                        document.getElementById('location-selected-text').value = place
                            .formatted_address;


                    }

                }
            });
        });
    </script>

@endpush
