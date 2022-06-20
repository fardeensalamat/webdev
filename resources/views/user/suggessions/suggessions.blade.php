@extends('user.layouts.userMaster')
@push('css')

@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            <!-- /.row -->
            @include('alerts.alerts')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                           Complain or Suggesion <span class="badge badge-danger"><a href="{{route('user.ClosedSuggestionChat')}}">View Closed Chat</a></span>
                        </div>
                        <div class="card-body">
                            @if ($openSG = Auth::user()->hasParentOpen())
                                <div class="col-md-6">
                                    <div class="card direct-chat direct-chat-primary collapsed-card"
                                        style="position: relative; left: 0px; top: 0px;">
                                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                                            <h3 class="card-title">
                                                {{ $openSG->body }}
                                            </h3>
                                            <div class="card-tools">
                                                <span title="3 New Messages" class="badge badge-primary">3</span>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" >
                                            {{-- {{ Auth::user()->suggessionDiscuss($openSG->id) }} --}}
                                            <div class="direct-chat-messages">
                                                @foreach (Auth::user()->suggessionDiscuss($openSG->id) as $sg)
                                                    @if ($sg->admin_id != null)
                                                    <div class="direct-chat-msg">
                                                        <div class="direct-chat-infos clearfix">
                                                            <span
                                                                class="direct-chat-name float-left">{{ $sg->admin->name }}</span>
                                                            <span
                                                                class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($sg->created_at)->format('d M, Y') }}</span>
                                                        </div>
                                                        <!-- /.direct-chat-infos -->

                                                        <img class="direct-chat-img"
                                                            src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $sg->admin->fi()]) }}"
                                                            alt="message user image">
                                                        <!-- /.direct-chat-img -->
                                                        <div class="direct-chat-text">
                                                            {{ $sg->body }}
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="direct-chat-msg right userChat">
                                                        @include('user.suggessions.ajax.userPart')
                                                    </div>

                                                    @endif

                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer" style="display: none;">
                                            <form id="" action="{{ route('user.addSuggesionsPost',['parent'=>$openSG->id,'type'=>'user']) }}" method="post">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" name="body" placeholder="Type here ..."
                                                        class="form-control">
                                                    <span class="input-group-append">
                                                        <button type="submit" id="userChat" class="btn btn-primary">Send</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card-footer-->
                                    </div>
                                </div>
                            @else
                            <div class="col-md-6 col-12 m-auto">
                                <div class="card">
                                    <div class="card-header">
                                        Add
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.storeSuggesion') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="type">Complaints Or Suggestions</label>
                                                <select name="type" class="form-control">
                                                    <option value="">Choose...</option>
                                                    <option value="suggesion">Suggesion</option>
                                                    <option value="complaint">complaint</option>
                                                </select>
                                                @error('type')
                                                    <span class="danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="body">Write about complaints Or suggestions</label>
                                                <input type="text" name="body" class="form-control" placeholder="Write here....">            @if (!Auth::user()->hasParentOpen())
                                                <div class="col-md-6 col-12 m-auto">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Add
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('user.storeSuggesion') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="type">Complaints Or Suggestions</label>
                                                                    <select name="type" class="form-control">
                                                                        <option value="">Choose...</option>
                                                                        <option value="suggesion">Suggesion</option>
                                                                        <option value="complaint">complaint</option>
                                                                    </select>
                                                                    @error('type')
                                                                        <span class="danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="body">Write about complaints Or suggestions</label>
                                                                    <textarea name="body" id="" cols="30" rows="3" class="form-control"></textarea>
                                                                    @error('body')
                                                                        <span class="danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" class="btn btn-info"> or <a href="" class="btn btn-danger">See
                                                                        Previews Chat</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                
                                                @error('body')
                                                    <span class="danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info"> or <a href="" class="btn btn-danger">See
                                                    Previews Chat</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                @endif

                        </div>
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
