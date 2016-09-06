@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <?php if (\Entrust::can('user-create')) : ?>
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div>
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Branch</th>
            <th>Role</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach($data as $key => $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $branches[$user->branch]->SNAME}}</td>
            <td>
                @if(!empty($user->roles))
                    @foreach($user->roles as $v)
                    <label class="label label-success">{{ $v->display_name }}</label>
                    @endforeach
                @endif
            </td>
            <td>{{ $user->status }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                <?php if (\Entrust::can('user-edit')) : ?>
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                <?php endif; ?>
                <?php if (\Entrust::can('user-delete')) : ?>
                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                <?php endif; ?>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection