@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.blogmanagement') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        @lang('admin/posts/title.blogmanagement')

        <div class="pull-right">
            <a href="{{ route('create/post') }}" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
        </div>
    </h3>
</div>

{{ $posts->links() }}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">@lang('admin/posts/table.title')</th>
            <th class="span1"><i class="fa fa-comments"></i></th>
            <th class="span2">@lang('admin/posts/table.created_at')</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td><a href="{{ route('update/post', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="{{ $post->url() }}">{{ $post->title }}</a></td>
            <td>{{{ $post->comments()->count() }}}</td>
            <td>{{{ $post->created_at->diffForHumans() }}}</td>
            <td><a
                    href="#dataConfirmModal"
                    data-toggle="modal"
                    data-target="#dataConfirmModal"
                    data-title="@lang('admin/posts/modal.title')
                    {{{ $post->title }}}"
                    data-body="@lang('admin/posts/modal.body')"
                    data-href="{{ route('delete/post', $post->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}
@stop
