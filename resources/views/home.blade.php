@extends('layouts.app')

@section('content')
<div class="home container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>TMDB Movie List</strong>
                </div>

                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p style="margin-bottom: 30px;">
                        Hello {{ Auth::user()->name }}, here are your requested movies:
                    </p>

                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Genre(s)</th>
                            <th>Release Date</th>
                            <th>Details</th>
                        </thead>

                        @foreach ($movies as $movie)
                            <tr>
                                <td><small>{{ $movie->tmdb_id }}</small></td>
                                <td class="original-title">{{ $movie->original_title }}</td>
                                <td>
                                    @foreach ($movie->genres as $genre)
                                        <span class="movie-genre">{{ $genre->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $movie->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a class="movie-details-link link"
                                        data-url="{{ route('movie.details', ['id' => $movie->id]) }}">
                                        Full info
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $movies->links() }}

                </div>

                <div class="panel-heading">
                    <strong>A few mentions...</strong>
                </div>

                <div class="panel-body">
                    <ul>
                        <li>For the sake of evaluation, I left the deployment steps to be run manually. For a standard deployment though, they most certainly can be bundled in a single script/command or queued inside of an automation framework.</li>
                        <li>It would have been quicker to use the TMDB Laravel wrapper. Instead, I opted to implement a basic API interface using Guzzle for better code evaluation.</li>
                        <li><strong>DataTables</strong> would have been a great alternative for a paginated table.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODALS --}}
@include('_movieDetailsModal')
{{-- END MODALS --}}

@endsection
