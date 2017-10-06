<?php

namespace App\Classes;

use GuzzleHttp\Psr7;

class TMDBManager
{
    protected $app;
    protected $http;

    public function __construct($app)
    {
        $this->app = $app;

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout'  => 15
        ]);
    }

    /**
     * Decodes a Guzzle response to JSON format or returns false if response code != 200
     * @param  Guzzle\Http\Message\Response $response the response object to decode
     * @return boolean|array
     */
    protected function decode($response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Launches a GET request to the API
     * @param  string $endpoint API endpoint to request
     * @param  array  $params   GET query parameters
     * @return array            JSON formatted output
     */
    protected function _get($endpoint, $params = [])
    {
        $response = $this->http->get($endpoint, [
            'query' => $params + ['api_key' => env('TMDB_KEY')]
        ]);

        return $this->decode($response);
    }

    /**
     * Lists all movie genres
     * @return array
     */
    public function getMovieGenres()
    {
        return $this->_get('genre/movie/list');
    }

    /**
     * Lists all movies set to be released today (paginated)
     * @param  integer $page
     * @return array
     */
    public function getCurrentDayMovies($page = 1)
    {
        $today = (new \DateTime('now'))->format('Y-m-d');

        return $this->_get('discover/movie', [
            'page'                     => $page,
            'primary_release_date.gte' => $today,
            'primary_release_date.lte' => $today
        ]);
    }

    /**
     * Retrieves a movie's details
     * @param  integer $id
     * @return array
     */
    public function getMovieDetails($id)
    {
        return $this->_get("movie/{$id}");
    }

}
