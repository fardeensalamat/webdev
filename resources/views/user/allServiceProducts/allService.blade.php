@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-teal">
                    <h3 class="text-center">Services</h3>
                </div>
            </div>
            <form action="" class="py-3">
                <div class="input-group input-group-md" style="border-radius: 10px" >
                    <input type="text" data-url="{{ route('user.serviceSearchAjax') }}"
                        class="form-control ajax-data-search" placeholder="Search Services">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary w3-border px-2">
                            <i class="fas fa-search "></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="row" id="showServices">
                        @include('user.softmarkets.includes.serviceCard')
                        {{-- @forelse ( $shops as  $cat )
                        @if ($cat->category->business_type == 'service')
                        @include('user.softmarkets.includes.serviceCard')
                            @elseif ($cat->category->business_type == 'shop')
                            @include('user.softmarkets.includes.shopCardSmall') 
                        @endif
                            
                        @empty
                            <h3 class="text-danger text-center">No Service Found</h3>
                        @endforelse
            
                        {{ $shops->render() }} --}}
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
        });
    </script>
        <script>
            $(function() {
    
                var delay = (function() {
                    var timer = 0;
                    return function(callback, ms) {
                        clearTimeout(timer);
                        timer = setTimeout(callback, ms);
                    };
                })();
    
    
                //////////////////////
                $(document).on('keypress', '.ajax-data-search', function(e) {
                    if (e.which == 13) {
                        e.preventDefault();
                    }
                });
                //////////////////////
                $(document).on("keyup", ".ajax-data-search", function(e) {
                    e.preventDefault();
                    var that = $(this);
                    var q = e.target.value;
                    var url = that.attr("data-url");
                    var urls = url + '?q=' + q;
                   delay(function(){
                    $.ajax({
                        url:urls,
                        type:'GET',
                        success:function(response){
                            $('#showServices').html(response);
                            // console.log(r.page);
                        }
                    });
                   },500);
               
    
                });
                ////////////////////admin search end //////////////////
                $(document).on('click', '.ajax-pagination-area .pagination li a', function(e) {
                    e.preventDefault();
    
                    var url = $(this).attr('href');
    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        cache: false,
                        dataType: 'json',
                        success: function(response) {
                            $(".ajax-data-container").empty().append(response.page);
                        },
                        error: function() {}
                    });
    
                });
    
            });
        </script>

@endpush
