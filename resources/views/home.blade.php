@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="col-1">Title</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Feed provider</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($feedItems as $item)
                    <tr>
                        <td><a href="#" data-toggle="modal" data-target="#feeditemModal" data-feed="{{$item->toJson()}}">{{$item->title}}</a></td>
                        <td>
                            @foreach($item->feed->categories as $category)
                                <a href="?category={{$category->name}}">{{$category->name}}</a>
                            @endforeach
                        </td>
                        <td><a href="{{route('feed.show', $item->feed->id)}}" target="_blank">{{parse_url($item->feed->url, PHP_URL_HOST)}}</a></td>
                        <td>{{\Carbon\Carbon::parse($item->updated_at)->diffForHumans(null, false, true)}}</td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="2">No items, <a href="{{route('feed.index')}}">add one now</a></td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            {{ $feedItems->appends(Request::only('category'))->links() }}

        </div>
    </div>
</div>

<div class="modal fade" id="feeditemModal" tabindex="-1" role="dialog" aria-labelledby="feedItemlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedItemlLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a target="_blank" href="#" class="btn btn-primary">Go to post</a>
            </div>
        </div>
    </div>
</div>

@section('js_scripts')
    @parent
    <script>
        $( document ).ready(function() {
            $('#feeditemModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var feed = button.data('feed');
                var modal = $(this);
                modal.find('.modal-title').text(feed.title);
                modal.find('.modal-body').text(feed.description);
                modal.find('.modal-footer a.btn-primary').attr('href', feed.link);
            });
        });
    </script>

@endsection
@endsection
