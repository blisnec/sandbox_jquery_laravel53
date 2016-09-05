@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Items CRUD</h2>
            </div>
            <div class="pull-right">
                <?php if (\Entrust::can('item-create')) : ?>
                <a class="btn btn-success" href="{{ route('itemCRUD2.create') }}"> Create New Item</a>
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
            <th>Title</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($items as $key => $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->description }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('itemCRUD2.show',$item->id) }}">Show</a>
                <?php if (\Entrust::can('item-edit')) : ?>
                <a class="btn btn-primary" href="{{ route('itemCRUD2.edit',$item->id) }}">Edit</a>
                <?php endif; ?>
                <?php if (\Entrust::can('item-delete')) : ?>
                {!! Form::open(['method' => 'DELETE', 'route' => ['itemCRUD2.destroy', $item->id], 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                {!! Form::close() !!}
                <?php endif; ?>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $items->render() !!}
@endsection
