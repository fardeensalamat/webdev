@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  @include('admin.honorariums.parts.create')
@endsection


@push('js')
<script>
$(document).ready(function(){
  $('#typeOfGlass').on('change', function(){
    $('#glassWidth').html('');
        if($('#typeOfGlass').val()=='Joining'){
          $('#glassWidth').append('<option value="Signup">Signup</option>');
          $('#glassWidth').append('<option value="Refferal">Introducer</option>');
          $('#glassWidth').append('<option value="Pair">Incentive</option>');
          $('#glassWidth').append('<option value="Reward">Reward</option>');
        }
        else if($('#typeOfGlass').val()=='Transfer')
        {
          $('#glassWidth').append('<option value="Refferal">Introducer</option>');
        }
        else{
          $('#glassWidth').append('<option value="Affiliate">Affiliate</option>');
          $('#glassWidth').append('<option value="Up">Up</option>');
          $('#glassWidth').append('<option value="Updown">Updown</option>');
          $('#glassWidth').append('<option value="Team_group">Team group</option>');
          $('#glassWidth').append('<option value="Work_station_individual">Work station individual</option>');
          $('#glassWidth').append('<option value="All_work_station">All work station</option>');
          $('#glassWidth').append('<option value="Lifetime_refer">Lifetime refer</option>');
          $('#glassWidth').append('<option value="Incentive">Incentive</option>');
          $('#glassWidth').append('<option value="All_working">All working</option>');

        }
  });

  $('select').change(function(){
    if($(this).val()==="Working")
        $('.hideme').show();
        else
            $('.hideme').hide();
  }).change();
});
</script>
@endpush
