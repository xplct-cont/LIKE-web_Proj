<div class="table-responsive">
    <table class="table" id="posts-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $posts)
            <tr>
                <td>{{ $posts->title }}</td>
            <td>{{ $posts->description }}</td>
            <td>{{ $posts->image }}</td>
            <td>{{ $posts->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['posts.destroy', $posts->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('posts.show', [$posts->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('posts.edit', [$posts->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
