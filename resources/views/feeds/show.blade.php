@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @can('create', \App\Feed::class)
            <form method="post" action="{{route('feed.update', $feed)}}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{$feed->url}}" aria-describedby="urlHelp" placeholder="Enter feed url" required>
                    <small id="urlHelp" class="form-text text-muted">Provide full feed url (http://feeds.feedburner.com/technologijos-visos-publikacijos?format=xml)</small>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            @endcan
        </div>

        <h3>Recent</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="col-1">Title</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($feed->feedItems()->recentHundred()->get() as $item)
                <tr>
                    <td><a href="{{$item->link}}" target="_blank">{{$item->title}}</a></td>
                    <td>{{\Carbon\Carbon::parse($item->updated_at)->diffForHumans(null, false, true)}}</td>
                </tr>

            @empty
                <tr>
                    <td colspan="2">No items</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
@endsection
