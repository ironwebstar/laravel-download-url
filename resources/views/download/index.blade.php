@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    <h1>Download Files <a href="{{ url('/download/create') }}" class="btn btn-primary btn-xs" title="Add New Url"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>

    </h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:5%;">S.No</th>
                    <th style="width:10%;"> Title </th>
                    <th style="width:40%;" style="width: 150px"> Url </th>
                    <th style="width:10%;"> Filename </th>
                    <th style="width:15%;"> Download State </th>
                    <th style="width:15%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
            @foreach($cleaner as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->filename }}</td>
                    <td class="download_statep_pending " id = "pending{{$item->id}}" style="display:block;">    
                        @if ($item->download_state == '1')
                            Pending
                        @elseif ($item->download_state == '2')
                            Downloading...
                        @elseif ($item->download_state == '3')
                            Downloading Complete
                        @elseif ($item->download_state == '4')
                            Downloading error...
                        @endif                         
                    </td>
                    <td class="download_state_downloading" id = "downloading{{$item->id}}" style="display:none;">Downloading...</td>
                    <td>                        
                        <a href="{{ route('downloads', $item->id) }}" id ="{{$item->id}}" class="btn_download btn btn-primary btn-xs" title="Download File"><span class=" glyphicon glyphicon-download" aria-hidden="true"/>Download</a>
                        <a href="{{ url('/download/' . $item->id) }}" class="btn btn-success btn-xs" title="View Url"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/download/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Url"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/download', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Url" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Url',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                       
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $cleaner->render() !!} </div>
    </div>
    </div>
</div>
@endsection
    <script src="{{ 'js/jquery.min.js' }}"></script>
    <script src="{{ 'js/bootstrap.min.js' }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(function(){
            $(".btn_download").on('click', function(){                
                obj_id = $(this).attr("id");
                $("#pending"+ obj_id).hide();
                $("#downloading" + obj_id).show();
            });
        })
    });

</script>
