@php
    use App\Models\Likes;
@endphp

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4>Posts</h4>
    </div>
    <div class="col-lg-6 offset-lg-3">
        @foreach ($posts as $item)
        <div class="card card-outline card-primary">
            <div class="card-header">
                <span class="card-title">{{ $item->title }}</span>
            </div>
            <div class="card-body">
                <p>{{ $item->description }}</p>
            </div>
            <div class="card-footer">
                @php
                    $likes = Likes::where('post_id', $item->id)
                                ->where('user_id', Auth::id())
                                ->get();
                @endphp
                @if (count($likes) < 1)
                    <button onclick="like({{ $item->id }})" class="btn text-info"><i id="heart-{{ $item->id }}" class="far fa-thumbs-up"></i> {{ $item->Likes }}</span></button>
                @else
                    <button onclick="like({{ $item->id }})" class="btn text-info"><i id="heart-{{ $item->id }}" class="fas fa-thumbs-up"></i> <span id="like-{{ $item->id }}" >{{ $item->Likes }}</span></button>
                @endif
                
                <button id="squint" class="btn text-smile"><i class="fas fa-grin-squint"></i></button>
                <button id="share" class="btn text-smile"><i class="fas fa-share-square"></i></button>
            </div>
        </div>
        @endforeach 
    </div>
</div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {

        });

        function like(id) {
            $.ajax({
                url : '/likes/like',
                type : 'POST',
                data : {
                    _token : "{{ csrf_token() }}",
                    post_id : id,
                },
                success : function(response) {
                    $('#heart-' + id).removeClass('far fa-thumbs-up').addClass('fas fa-thumbs-up');
                    var increment = parseInt($('#like-' + id).text()) + 1;
                    $('#like-' + id).text(increment);
                },
                error : function(error) {
                    alert('Error liking this bitch!');
                }
            });
        }
    </script>
@endpush
