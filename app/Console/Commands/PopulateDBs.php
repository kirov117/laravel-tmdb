<?php

namespace App\Console\Commands;

use TMDB;

use App\Genre;
use App\Movie;
use App\MovieGenre;

use Illuminate\Console\Command;

class PopulateDBs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmdb:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate databases with TMDB movie information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('');

        $this->comment('Using TMDB API v3 key: '. env('TMDB_KEY'));
        $this->line('');

        // GENRES
        $this->info('Populating genres...');
        $genres = TMDB::getMovieGenres();

        foreach ($genres['genres'] as $genre) {
            if (!array_has($genre, ['id', 'name'])) {
                continue;
            }

            try {
                $g          = new Genre;
                $g->tmdb_id = $genre['id'];
                $g->name    = $genre['name'];
                $g->save();
            } catch (\Exception $e) {
                // ignore duplicate entries
            }
        }

        // MOVIES
        $this->info('Populating movies released today...');

        $page        = 1;
        $total_pages = 0;
        do {
            $movies = TMDB::getCurrentDayMovies($page++);

            if (!$total_pages) {
                $total_pages = array_has($movies, 'total_pages') ? $movies['total_pages'] : 1;
            }

            foreach ($movies['results'] as $movie) {
                if (!array_has($movie, ['id', 'original_title'])) {
                    continue;
                }

                try {
                    $m                 = new Movie;
                    $m->tmdb_id        = $movie['id'];
                    $m->original_title = $movie['original_title'];
                    $m->save();

                    if (array_has($movie, 'genre_ids')) {
                        foreach ($movie['genre_ids'] as $genre_id) {
                            $genre = Genre::where('tmdb_id', $genre_id)->first();

                            if (!$genre) {
                                continue;
                            }

                            $mg           = new MovieGenre;
                            $mg->movie_id = $m->id;
                            $mg->genre_id = $genre->id;
                            $mg->save();
                        }
                    }

                } catch (\Exception $e) {
                    // ignore duplicate entries
                }
            }
        } while ($page <= $total_pages);

        $this->line('');
    }
}
