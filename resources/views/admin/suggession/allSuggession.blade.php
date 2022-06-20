@extends('admin.layouts.adminMaster')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card ">
        <div class="card-header">
            <div class="card-title">All Suggessions Or Complain</div>
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
                               {{-- <th>User</th>
                               <th>Admin</th> --}}
                               <th>Created_at</th>
                               <th>Update At</th>
                               <th>Closed</th>
                           </tr>
                       </thead>
                       @php
                           $i=1;
                       @endphp
                       @forelse ($suggessions as $sg)
                           <tr>
                               <td>{{ $i++}}</td>
                               <td> <a href="{{ route('admin.suggessionChat',['chat'=>$sg->id]) }}" class="btn btn-info">{{ $sg->user->name }}</a> </td>
                               @php
                                 $last_mess=App\Models\Suggestion::where('parent_id',$sg->id)->latest()->first();
                                   
                               @endphp
                               <td>{{ $last_mess->body ?? $sg->body }}</td>
                               {{-- <td>{{ $sg->user->name }}</td> --}}
                               {{-- <td>{{ $sg->admin? $sg->admin->name : null }}</td> --}}
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
        
    </section>
@endsection
@push('js')

@endpush
