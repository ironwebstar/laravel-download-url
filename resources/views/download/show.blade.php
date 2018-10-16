@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Url {{ $cleaner->id }}
        <a href="{{ url('download/' . $cleaner->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Url"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['download', $cleaner->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Url',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $cleaner->id }}</td>
                </tr>
                <tr><th> Title </th><td> {{ $cleaner->title }} </td></tr>
                <tr><th> Url </th><td> {{ $cleaner->url }} </td></tr>
                <tr><th> Filename </th><td> {{ $cleaner->filename }} </td></tr>
                <tr><th> Download State </th><td> {{ $cleaner->download_state }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
