<div class="table-responsive">
    <table class="table" id="likes-table">
        <thead>
            <tr>
                <th>Post Id</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($likes as $likes)
            <tr>
                <td>{{ $likes->post_id }}</td>
            <td>{{ $likes->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['likes.destroy', $likes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('likes.show', [$likes->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('likes.edit', [$likes->id]) }}" class='btn btn-default btn-xs'>
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
