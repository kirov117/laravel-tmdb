<div class="poster">
    @if (!empty($details['poster_path']))
        <img src="https://image.tmdb.org/t/p/w640{{ $details['poster_path'] }}">
    @endif
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <strong>{{ $details['title'] }}</strong>
        </h3>
    </div>

    @if (!empty($details['overview']))
        <div class="panel-body">
            <p><small><strong>Overview:</strong></small></p>
            {{ $details['overview'] }}
        </div>
    @endif

    <div class="table-rows row">
        <div class="col-xs-12 col-md-6">
            <table class="table table-condensed">
                <tr>
                    <td>
                        <strong>Language</strong>
                    </td>
                    <td>
                        @if (!empty($details['original_language']))
                            {{ (new \Matriphe\ISO639\ISO639)->languageByCode1($details['original_language']) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Status</strong>
                    </td>
                    <td>{{ $details['status'] }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Genres</strong>
                    </td>
                    <td>
                        @foreach ($movie->genres as $genre)
                            <span class="movie-genre">{{ $genre->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-xs-12 col-md-6">
            <table class="table table-condensed">
                <tr>
                    <td>
                        <strong>Popularity</strong>
                    </td>
                    <td>{{ $details['popularity'] }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Vote average</strong>
                    </td>
                    <td>{{ $details['vote_average'] }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Vote count</strong>
                    </td>
                    <td>{{ $details['vote_count'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
