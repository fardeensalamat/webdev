@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-indigo">
                    <h3>Add Service Profile Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.submitServiceProduct') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Product Title</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="service_station">Service Station</label>
                            <select name="service_station" id="service_station" class="form-control"
                                data-url="{{ route('user.searchOrderwiseCategoryAjax') }}">
                                <option value="">Select Service Station</option>
                                @foreach ($service_station as $st)
                                    <option value="{{ $st->id }}">{{ $st->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="workstation_cat">Category</label>
                            <select name="workstation_cat" id="workstation_cat" class="form-control" data-url="{{ route('user.checkServiceProfile') }}">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        @if (count($myServiceProfile) > 0)
                        <div class="form-group" id="showHide">
                            <label for="service_profile">Service Station</label>
                            <select name="service_profile" id="service_profile" class="form-control">
                              
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <input class="btn btn-success" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
            ///Extra

            $('select#service_station').on('hover', function() {
                alert($(this).val());
            });
            //Extra end

            $('select#service_station').on('change', function() {
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
                        // console.log(data.subcategories)
                        $('#workstation_cat').empty();
                        var d= '<option value="" selected>Select Category</option>';
                        $('select#workstation_cat').append(d);
                        $.each(data.categories, function(index, categories) {
                            $('select#workstation_cat').append('<option value="' +
                                categories.id + '">' + categories.name.en +
                                '</option>');
                            // console.log(categories.id);
                        })
                    }
                });
            });
            $("#showHide").hide();
            $('select#workstation_cat').on('change', function() {
                // alert("HELLO");
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
                        console.log(data.pp);
                       if (data.service_profiles.length > 0) {
                        $("#showHide").show();
                           $('#service_profile').empty();
                        $.each(data.service_profiles, function(index, profile) {
                            $('select#service_profile').append('<option value="' +
                            profile.id + '">' + profile.name +
                                '</option>');
                            // console.log(categories.id);
                        })
                       }else{
                           var d= confirm('You have no Profile In this Category? You Want to create Service Profile?');
                        //    console.log(d);
                           if (d) {
                               var link= "{{ route('subscriber.myProfileDetails',['subscription'=>"+subscription_code+",'profile_type'=>'business']) }}";
                            console.log(link); 
                           }else{
                            $("#showHide").hide();
                           }
                       }
                        
                    }
                });
            });


        });
    </script>

@endpush
