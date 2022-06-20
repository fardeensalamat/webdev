@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-indigo">
                    <h3>{{ __('blogs.blogs') }} </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('blogs.sl') }} </th>
                                    <th>{{ __('blogs.action') }} </th>
                                    <th>{{ __('blogs.title') }} </th>
                                    <th>{{ __('blogs.description') }} </th>
                                    <th>{{ __('blogs.categories') }} </th>
                                    <th>{{ __('blogs.tags') }} </th>
                                    <th>{{ __('blogs.blog_type') }} </th>
                                    <th>{{ __('blogs.publish_status') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $i = ($blogs->currentPage() - 1) * $blogs->perPage() + 1; ?>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div class="btn-group btn-sm">
                                                <a href="{{ route('user.editMyBlog',['blog'=>$blog->id]) }}" class="btn btn-info btn-xs">Edit</a>
                                                @if ($blog->type == 'blog')
                                                <a href="{{ route('welcome.blogDetails',['blog'=>$blog->id,'title'=>mySlug($blog->title)]) }}" class="btn btn-success btn-xs">Details</a>
                                                @elseif ($blog->type == 'news')
                                                <a href="{{ route('welcome.newsDetails',['news'=>$blog->id,'title'=>mySlug($blog->title)]) }}" class="btn btn-success btn-xs">Details</a>
                                                @elseif ($blog->type == 'event')
                                                <a href="{{ route('welcome.eventDetails',['event'=>$blog->id,'title'=>mySlug($blog->title)]) }}" class="btn btn-success btn-xs">Details</a>
                                                @endif
                                                
                                            </div>
                                        </td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->excerpt }}</td>
                                        <td>{{ $blog->cats() }}</td>
                                        <td>{{ $blog->tags }}</td>
                                        <td>{{ $blog->type }}</td>
                                        <td>
                                        @if ($blog->publish_status == 'published')
                                            <span class="badge badge-success">Published</span>
                                            @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $blogs->render() }}
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')



@endpush
