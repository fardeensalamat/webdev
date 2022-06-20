@forelse ( $softmarkets as  $softmarket )
<div class="col-md-3 col-6">
    <a href="{{ route('user.catwiseProduct', ['cat' => $softmarket->id]) }}">
        <div class="card">
            <div class="card-header text-center">
                <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $softmarket->ci()]) }}"
                                        alt="..." width="130" class="mb-2 img-thumbnail img-fluid">
            </div>
            <div class="card-body">
                <p class="m-0"> <a
                    href="{{ route('user.catwiseProduct', ['cat' => $softmarket->id]) }}"
                    class="btn w3-purple btn-sm btn-block">{{ mb_substr($softmarket->name,0,16) }}..</a></p>
            </div>
        
        </div>
    </a>

</div>

@empty
    <h3 class="text-danger text-center">No Service Found</h3>
@endforelse

