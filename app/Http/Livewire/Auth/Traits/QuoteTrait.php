<?php

namespace App\Http\Livewire\Auth\Traits;

trait QuoteTrait{

    public $quote, $author;

    public function loadQuotes()
    {
        if (!session()->has('quote')||!session()->has('author')) {
            $quotes = config('app.quotes');
            $selected = $quotes[array_rand($quotes)];
            $this->quote = $selected['text'];
            $this->author = $selected['author'];
            session([
                'quote'     =>  $this->quote,
                'author'    =>  $this->author,
            ]);
        }

        $this->quote = session('quote');

    }

    public function clearSessionCache()
    {
        session()->forget('quote');
        session()->forget('author');
    }

}
