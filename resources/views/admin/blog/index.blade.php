@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />    
@endpush

@section('content')
<br>
<section class="content">
    <div class="card">
        <div class="card-body bg-info">
            <h4>All Blogs</h4>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped" style="white-space: nowrap">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Action</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Categories</th>
                        <th>Blog Type</th>
                        <th>Added By</th>
                        <th>Publish Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php $i = 1; ?>

              <?php $i = (($posts->currentPage() - 1) * $posts->perPage() + 1); ?>
                  @forelse ($posts as $post)
                  <tr>
                      <td>{{ $i }}</td>
                      <td>
                          <div class="btn-group btn-sm">
                              @if ($post->publish_status == 'published')
                              <span class="btn btn-warning btn-xs">Published</span>
                              @else
                              <a href="{{ route('admin.blogUpdateToPublished',$post) }}" class="btn btn-success btn-xs">Publish</a>
                              @endif

                              @if ($post->type == 'blog')
                              <a href="{{ route('welcome.blogDetails',['blog'=>$post->id,'title'=>mySlug($post->title)]) }}" class="btn btn-success btn-xs">Details</a>
                                  @elseif ($post->type == 'news')
                                  <a href="{{ route('welcome.newsDetails',['news'=>$post->id,'title'=>mySlug($post->title)]) }}" class="btn btn-success btn-xs">Details</a>
                                  @elseif ($post->type == 'event')
                                  <a href="{{ route('welcome.eventDetails',['event'=>$post->id,'title'=>mySlug($post->title)]) }}" class="btn btn-success btn-xs">Details</a>
                              @endif
                            <a href="{{ route('admin.blogEdit',$post) }}" class="btn btn-info btn-xs">Edit</a>
                            
                            <a href="{{ route('admin.postDelete',$post) }}" onclick="return confirm('Are you sure? you want to delete this post?');" class="btn btn-danger btn-xs">Delete</a>
                          </div>
                      </td>
                      <td>{{ $post->title }}</td>
                      <td>{{ mb_substr($post->description,0,20) }}</td>
                      <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $post->fi() ]) }}" alt=""></td>
                      <td>{{ $post->tags }}</td>
                      <td>{{ $post->cats()  }}</td>
                      <td>{{ $post->type }}</td>
                      <td>{{ $post->user ? $post->user->name : null}}</td>
                      <td>{{ $post->publish_status }}</td>
                  </tr>
                  <?php $i++; ?>
                  @empty
                      <tr>
                          <td colspan="8">No Blogs Found</td>
                      </tr>
                  @endforelse
                </tbody>
            </table>
        </div>
        {{ $posts->render() }}
    </div>
</section>
@endsection


@push('js')

@endpush


