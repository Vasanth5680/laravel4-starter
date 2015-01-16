@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('admin/groups/title.management') ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h3>
        @lang('admin/groups/title.management')

        <div class="pull-right">
            <a href="{{ route('create/group') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
        </div>
    </h3>
</div>

@if ($groups->count() >= 1) {{ $groups->links() }}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">@lang('admin/groups/table.name')</th>
            <th class="span2">@lang('admin/groups/table.users')</th>
            <th class="span2">@lang('admin/groups/table.created_at')</th>
            <th class="span1"></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($groups as $group)
        <tr>
            <td><a href="{{ route('update/group', $group->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td>{{{ $group->name }}}</td>
            <td>{{{ $group->users()->count() }}}</td>
            <td>{{{ $group->created_at->diffForHumans() }}}</td>
            <td>
                <a
                    href="#dataConfirmModal"
                    data-toggle="modal"
                    data-target="#dataConfirmModal"
                    data-title="@lang('admin/groups/modal.title')
                    {{{ $group->name }}}"
                    data-body="@lang('admin/groups/modal.body')"
                    data-href="{{ route('delete/group', $group->id) }}"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $groups->links() }}

@else
    @lang('general.noresults')
@endif
@stop
