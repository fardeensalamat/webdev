@extends('user.layouts.userMaster')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       Closed Complain or Suggesion
                    </div>
                    <div class="card-body">

                        <div class="col-md-6">
                            <div class="card direct-chat direct-chat-primary collapsed-card"
                                style="position: relative; left: 0px; top: 0px;">
                                <div class="card-header ui-sortable-handle" style="cursor: move;">
                                    <h3 class="card-title">
                                        {{ $suggession->body }}
                                        @if (!$suggession->hasParentOpend($suggession->id))
                                        <a href="{{ route('user.CloseSuggesionsPost',['parent'=>$suggession->id]) }}" class="badge badge-danger">Close Now</a>
                                        @endif
                                       
                                    </h3>
                                    <div class="card-tools">
                                        <span title="New Messages" class="badge badge-primary"></span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                {{-- {{ $suggession->suggessionDiscuss($openSG->id) }} --}}
                                <div class="card-body" style="display: block;">
                                    <div class="direct-chat-messages">
                                        @foreach ($suggession->suggessionDiscuss($suggession->id) as $sg)
                                            @if ($sg->admin_id == null)
                                                <div class="direct-chat-msg right userChat">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span
                                                            class="direct-chat-name float-right">{{ $sg->user->name }}</span>
                                                        <span
                                                            class="direct-chat-timestamp float-left">{{ \Carbon\Carbon::parse($sg->created_at)->format('d M, Y') }}</span>
                                                    </div>
                                                    <img class="direct-chat-img"
                                                        src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $sg->user->fi()]) }}"
                                                        alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        {{ $sg->body }}
                                                        
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            @else
                                                <div class="direct-chat-msg left">
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
                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                @if (!$suggession->hasParentOpend($suggession->id))
                                    <div class="card-footer" style="display: block;">
                                        <form id=""
                                            action="{{ route('user.addSuggesionsPost', ['parent' => $suggession->id, 'type' => 'admin']) }}"
                                            method="post">
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
                                @endif
                                
                                <!-- /.card-footer-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('js')

@endpush
