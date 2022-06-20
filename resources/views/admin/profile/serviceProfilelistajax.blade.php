<div class="table-responsive ajax-data-container">
    <table class="table table-stripped table-border table-sm">
        <thead>
            <tr>
                <th>SL</th>
                <th>Action</th>
                <th>Name</th>
                {{-- <th>Email</th> --}}
                <th>Mobile</th>
                <th>SS</th>
                <th>Cat</th>
                <th>Type</th>
                <th>Date</th>
                <th>Commission</th>
                <th>Status</th>


            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>

        <?php $i = (($profiles->currentPage() - 1) * $profiles->perPage() + 1); ?>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">

                          
                            @if(Auth::user()->roleItems()->count() < 1)
                            @if ($profile->status == "0")
                                <a href="{{ route('admin.profileStatusChange',['profile'=>$profile,'status'=>'approve']) }}" class="btn btn-xs
                                btn-success" onclick="return confirm('Do you want to approve this profile?')">Approve</a>
                                <a href="{{ route('admin.profileStatusChange',['profile'=>$profile,'status'=>'deny']) }}" class="btn btn-xs
                                btn-danger" onclick="return confirm('Do you want to deny this profile?')">Decline</a>
                                @elseif ($profile->status == '1')

                                <button class="btn btn-xs
                                btn-warning">Approved</button>
                                @elseif($profile->status == 'deny')
                                <button class="btn btn-xs
                                w3-deep-orange">Reject</button>
                                @endif
                                
                            
                                <a href="{{ route('admin.serviceProfileDelete',['profile'=>$profile->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-xs">Delete</a>
                            
                                <a class="btn btn-xs btn-success " href="{{ route('admin.serviceProfileEdit',['profile'=>$profile->id]) }}">Edit</a>
                            @endif
                            <a href="{{ route('admin.serviceProfileDetails',['profile'=>$profile->id]) }}" class="btn btn-info btn-xm">Details</a>

                            
                        </div>
                    </td>
                    <td>{{ ucfirst($profile->name) }}</td>
                    {{-- <td>{{ ucfirst($profile->user->email?? '') }}</td> --}}
                    <td>{{ ucfirst($profile->user->mobile?? '') }}</td>
                    <td>{{ ucfirst($profile->workstation->title?? '') }}</td>
                    <td>{{ ucfirst($profile->category->name?? '') }}</td>
                    <td>{{ ucfirst($profile->profile_type ??'') }}</td>
                    <td>{{ ucfirst($profile->created_at ??'') }}</td>
                    <td>@if($profile->commission==0){{$profile->category->service_product_commission}}@else{{ $profile->commission }}@endif</td>
                    <td>
                        {{ $profile->status == 1 ? 'Active' : 'Pending' }}
                    </td>
                    
                </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>

    </table>
</div>
{{ $profiles->render() }}