@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  <section class="content">

  	<br>


  	<div class="row">

      <div class="col-sm-12">
        @include('alerts.alerts')

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              All Subcribers
            </h3>
          </div>

          <div class="card-body">




<div class="table-responsive">


          <table class="table table-hover table-sm">


            <thead>
              <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Description</th>
                <th>Active</th>
                <th>Image</th>

                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              <?php $i = 1; ?>

              <?php $i = (($workStations->currentPage() - 1) * $workStations->perPage() + 1); ?>

            @foreach($workStations as $ws)


            <tr>

            	<td>{{ $i }}</td>
            	<td>{{ $ws->title }}</td>
            	<td>{{ $ws->description }}</td>
            	<td>{{ $ws->active==1 ? 'active' : 'inactive' }}</td>

                <td>
                    @if ($ws->feature_img)
                    <img src="{{asset('storage/workStation/image/'.$ws->feature_img)}}" width="100" height="50" alt="">
                    @endif

                </td>
            	<td>



            	<div class="btn-group btn-group-xs">

  {{-- <a class="btn  btn-xs w3-blue mx-1" href="{{ route('admin.message', $ws) }}"> <i class="fas fa-comments"></i> </a> --}}
  <a class="btn btn-primary btn-xs" href="{{ route('admin.workStationEdit', $ws) }}" target="_blank">Edit</a>
  <a class="btn btn-default btn-xs" href="{{route('admin.addNewCategory', $ws)}}">Category</a>

  @if(Auth::user()->roleItems()->count() < 1)
  <a class="btn btn-success btn-xs" href="{{route('admin.HonorariaLists', $ws)}}">Honoraria</a>
    @else

    @endif




</div>


            	</td>

            </tr>

            <?php $i++; ?>

            @endforeach
            </tbody>

          </table>

          {{ $workStations->render() }}

        </div>



</div>
</div>
</div>
</div>



  </section>
@endsection


@push('js')

@endpush

