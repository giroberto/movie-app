<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            config('services.tmdb.base_url') . '/movie/popular' => Http::response($this->popularMovieResponse(),),
            config('services.tmdb.base_url') . '/movie/now_playing' => Http::response($this->NowPlayingResponse(), 200),
            config('services.tmdb.base_url') . '/genre/movie/list' => Http::response($this->genresReponse(), 200)
        ]);
        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Ad Astra');
        $response->assertSee('Now playing');
        $response->assertSee('Bloodshot');
        $response->assertSee('Action, Science Fiction');
    }

    private function popularMovieResponse()
    {
        return [
            "results" => [
                [
                    "popularity" => 719.623,
                    "vote_count" => 2730,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Ad Astra",
                    "genre_ids" => [
                        0 => 18,
                        1 => 878,
                    ],
                    "title" => "Ad Astra",
                    "vote_average" => 6,
                    "overview" => "The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.",
                    "release_date" => "2019-09-17",
                ]
            ]
        ];
    }

    private function NowPlayingResponse()
    {
        return [
            "results" =>
            [[
                "popularity" => 708.802,
                "vote_count" => 931,
                "video" => false,
                "poster_path" => "/8WUVHemHFH2ZIP6NWkwlHWsyrEL.jpg",
                "id" => 338762,
                "adult" => false,
                "backdrop_path" => "/ocUrMYbdjknu2TwzMHKT9PBBQRw.jpg",
                "original_language" => "en",
                "original_title" => "Bloodshot",
                "genre_ids" => [
                    0 => 28,
                    1 => 878,
                ],
                "title" => "Bloodshot",
                "vote_average" => 7.2,
                "overview" => "After he and his wife are murdered, marine Ray Garrison is resurrected by a team of scientists. Enhanced with nanotechnology, he becomes a superhuman, biotech killing machine—'Bloodshot'. As Ray first trains with fellow super-soldiers, he cannot recall anything from his former life. But when his memories flood back and he remembers the man that killed both him and his wife, he breaks out of the facility to get revenge, only to discover that there's more to the conspiracy than he thought.",
                "release_date" => "2020-02-20",
            ]]
        ];
    }

    private function genresReponse()
    {
        return ["genres" => [
            0 => [
                "id" => 28,
                "name" => "Action",
            ],
            1 => [
                "id" => 12,
                "name" => "Adventure",
            ],
            2 => [
                "id" => 16,
                "name" => "Animation",
            ],
            3 => [
                "id" => 35,
                "name" => "Comedy",
            ],
            4 => [
                "id" => 80,
                "name" => "Crime",
            ],
            5 => [
                "id" => 99,
                "name" => "Documentary",
            ],
            6 => [
                "id" => 18,
                "name" => "Drama",
            ],
            7 => [
                "id" => 10751,
                "name" => "Family",
            ],
            8 => [
                "id" => 14,
                "name" => "Fantasy",
            ],
            9 => [
                "id" => 36,
                "name" => "History",
            ],
            10 => [
                "id" => 27,
                "name" => "Horror",
            ],
            11 => [
                "id" => 10402,
                "name" => "Music",
            ],
            12 => [
                "id" => 9648,
                "name" => "Mystery",
            ],
            13 => [
                "id" => 10749,
                "name" => "Romance",
            ],
            14 => [
                "id" => 878,
                "name" => "Science Fiction",
            ],
            15 => [
                "id" => 10770,
                "name" => "TV Movie",
            ],
            16 => [
                "id" => 53,
                "name" => "Thriller",
            ],
            17 => [
                "id" => 10752,
                "name" => "War",
            ],
            18 => [
                "id" => 37,
                "name" => "Western",
            ],
        ]];
    }
}
