@extends('user.layouts.userMaster')
@push('css')

@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            <!-- /.row -->
            @include('alerts.alerts')
           <div class="card ">
            <div class="card-header">
                <div class="card-title">All Closed Suggessions Or Complain</div>
            </div>
                <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-striped">
                           <thead>
                               <tr>
                                   <th>#ID</th>
                                   <th>
                                     Chat
                                   </th>
                                   <th>Topic</th>
                                   <th>Created_at</th>
                                   <th>Update At</th>
                                   <th>Closed</th>
                               </tr>
                           </thead>
                           @forelse ($suggessions as $sg)
                               <tr>
                                   <td>{{ $sg->id }}</td>
                                   <td> <a href="{{ route('user.closedSuggestionChatDetails',['chat'=>$sg->id]) }}" class="btn btn-info">See Chat</a> </td>
                                   <td>{{ $sg->body }}</td>
                                   <td>{{ $sg->created_at}}</td>
                                   <td>{{ $sg->updated_at }}</td>
                                   <td>
                                       @if ($sg->closed)
                                           <span class="badge badge-danger">Closed</span>
                                           @else
                                           <span class="badge badge-success">Open</span>
                                       @endif
                                   </td>
                               </tr>
                           @empty
                               
                           @endforelse
                       </table>
                   </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection

@push('js')

<script>
    // $(document).on('submit','.userChat',function(e){
    //     alert("HH");
    //     e.preventDefault();
        
    // })
</script>
@endpush
