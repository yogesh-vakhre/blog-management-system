
@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Post</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
        <a href="{{ route('posts.create') }}" class="btn btn-info  m-3">Create Post</a>
    <input type="hidden" value="{{auth()->user()->id}}" id="auth_user_id">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Content</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>

<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('posts.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'content', name: 'content'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
            {
                data: 'action',
                render: function (data, type, row, meta) {
                    let html= '';
                    let id =row?.id;
                    let user_id =row?.user_id;
                    let auth_user_id = $("#auth_user_id").val();

                    if (user_id == auth_user_id){


                    html = `<form method="post" action="{{url('/posts/')}}/${id}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href='{{url('/posts')}}/${id}' class="btn btn-primary btn-sm">View</a>
                        <a href='{{url('/posts')}}/${id}/edit' class="btn btn-primary btn-sm">Edit</a>
                        `;
                    }else{

                        html = `
                        <a href='{{url('/posts')}}/${id}' class="btn btn-primary btn-sm">View</a>
                        `;

                    }
                    return  html;
                }
                ,
                orderable: false,
                searchable: false
            },
        ]
    });

  });
</script>
@endsection
