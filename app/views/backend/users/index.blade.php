@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
User Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        User Management
        <div class="pull-right">
            <a href="{{ route('create/user') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus"></span> Create</a>
        </div>
    </h3>
</div>

<ul class="nav nav-pills">
  <li><a class="btn btn-medium" href="{{ URL::to('admin/users?withTrashed=true') }}">Include Deleted Users</a></li>
  <li><a class="btn btn-medium" href="{{ URL::to('admin/users?onlyTrashed=true') }}">Include Only Deleted Users</a></li>
</ul>
<div class="table-responsive">
<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th>@lang('admin/users/table.id')</th>
            <th>@lang('admin/users/table.first_name')</th>
            <th>@lang('admin/users/table.last_name')</th>
            <th>@lang('admin/users/table.email')</th>
            <th>@lang('admin/users/table.activated')</th>
            <th>@lang('admin/users/table.created_at')</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr
        @if ($user->accountStatus()=='suspended')
                <?php echo ' class="warning"'; ?>
            @elseif ($user->accountStatus()=='banned')
                <?php echo ' class="danger"'; ?>
            @endif>
            <td><a href="{{ route('update/user', $user->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td>{{{ $user->id }}}</td>
            <td>{{{ $user->first_name }}}</td>
            <td>{{{ $user->last_name }}}</td>
            <td>{{{ $user->email }}}</td>
            <td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
            <td>{{{ $user->created_at->diffForHumans() }}}</td>
            <td>
                @if ($user->accountStatus()=='suspended')
                    <a href="{{ route('unsuspend/user', $user->id) }}"><span class="glyphicon glyphicon-play"></span></a>
                @endif
            </td>
            <td>
                @if ( ! is_null($user->deleted_at))
                <a href="{{ route('restore/user', $user->id) }}"><span class="glyphicon glyphicon-ok"></span></a>
                @else
                @if (Sentry::getId() !== $user->id)
                <a
                    href="#dataConfirmModal"
                    data-toggle="modal"
                    data-target="#dataConfirmModal"
                    data-title="@lang('admin/users/modal.title')
                    {{{ $user->fullName() }}}"
                    data-body="@lang('admin/users/modal.body')"
                    data-href="{{ route('delete/user', $user->id) }}"><span class="glyphicon glyphicon-trash"></span></a>
                @else
                <span class="glyphicon glyphicon-trash text-muted"></span>
                @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@if (count($users))
<div class="row">
{{ $users->links() }}
</div>
@endif
@stop
