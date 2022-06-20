@extends('subscriber.layouts.userMaster')
@push('css')
@endpush
@section('content')
    @include('subscriber.job.parts.softcommercejob')    
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $( "#category" ).change(function() {
            var catId= $("#category").val();   
            var url= window.location.origin+`/mypanel/category/${catId}/get-subcat`;
            $.getJSON(url, function(data){
                $('#subcategory').empty()
                data.forEach(element => {
                    $('#subcategory').append(`
                    <option value="${element.id}">${element.title}</option>
                    `)
                });
            });
  
        });
    })
</script>
@endpush