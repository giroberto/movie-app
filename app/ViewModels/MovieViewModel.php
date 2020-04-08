<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    protected $movie;
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie(){
        return collect($this->movie)->merge([
            'poster_path' => config('services.tmdb.image_url') . '/w500' . $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average']*10 . '%',
            'release_date' => \Carbon\Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'release_year' => \Carbon\Carbon::parse($this->movie['release_date'])->format('Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(5)
        ]);
    }
}
