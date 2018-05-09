@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="post" action="{{route('feed.store')}}">
                @csrf
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" aria-describedby="urlHelp" placeholder="Enter feed url" required>
                    <small id="urlHelp" class="form-text text-muted">Provide full feed url (http://feeds.feedburner.com/technologijos-visos-publikacijos?format=xml)</small>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
        <h2>Feeds</h2>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Url</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->url}}</td>
                        <td>
                            <form action="{{route('feed.destroy', $item)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{route('feed.show', [$item->id])}}" class="btn btn-secondary">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $list->links() }}

        </div>
    </div>
@endsection
