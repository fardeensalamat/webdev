@extends('admin.layouts.adminMaster')
@section('content')
<section class="content">

    <br>


    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
    
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  All Roles 
                </h3>
                <div class="card-tools">
                    <a class="btn btn-default text-dark btn-sm" href="{{route('admin.addNewRole')}}"  > <i class="fa fa-plus"></i> Add New Role</a>
                 </div>
              </div>
    
              <div class="card-body">
    
    
    
    
    <div class="table-responsive">
              
    
              <table class="table table-hover table-sm">
    
    
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role Name</th>
                    <th>Role Items</th>                    
                    <th>Action</th>
                  </tr>
                </thead>
    
                <tbody> 
    
                  <?php $i = 1; ?>
    
                  <?php $i = (($rolesAll->currentPage() - 1) * $rolesAll->perPage() + 1); ?>
    
                @foreach($rolesAll as $role)        
    
    
                <tr>
    
                    <td>{{ $i }}</td>
                    <td>{{ $role->user->name }}</td>
                    <td>{{ $role->user->mobile }}</td>
                    <td>
                        {{$role->role_value}}
                    </td>
                    
                    <td>
                        @foreach($role->roleItems as $item)
                        <span class="badge badge-success">{{ $item->name }}</span> 
                        @endforeach
                        
                    </td>
                    <td>
    
                        
    
                    <div class="btn-group btn-group-xs">
                      <a class="btn btn-primary btn-xs" href="{{route('admin.editNewRole',$role->id)}}" onclick="return confirm('Do you want to edit this role?')">Edit</a>
                        <a class="btn btn-danger btn-xs" href="{{route('admin.adminDelete',$role)}}" onclick="return confirm('Do you want to delete this role?')">Delete</a>
    
    
                    </div>
                        
    
                    </td>
                  
                </tr>
    
                <?php $i++; ?>
    
                @endforeach 
                </tbody>
    
              </table>
    
              {{ $rolesAll->render() }}
    
            </div>
    
    
    
    </div>
    </div>
    </div>
    </div>
</section>
@endsection