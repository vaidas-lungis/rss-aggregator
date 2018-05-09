@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
        </div>
    </div>
@endsection
