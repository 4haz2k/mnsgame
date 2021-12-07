@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($servers))
                    <div class="card">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Game</th>
                                <th scope="col">Server Data</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($servers as $key => $server)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $server->title }}</td>
                                    <td>{{ \App\Models\Game::find($server->game_id)->title }}</td>
                                    <td>{{ $server->server_data }}</td>
                                    <td><a class="btn btn-primary" href="{{ url("editserver/{$server->id}") }}" role="button">Edit</a></td>
                                    <td><a class="btn btn-danger" href="{{ url("deleteserver/{$server->id}") }}" role="button">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3>Servers not found</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
