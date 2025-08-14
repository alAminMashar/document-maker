<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use Livewire\WithPagination;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;

use App\Models\Poll;
use App\Models\Candidate;
use App\Models\Voter;
use App\Models\Vote;

class PollShow extends Component
{
    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/
    use WithPagination;

    // use Livewire\WithPagination; add this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    /**
     * delete action listener
     */
    protected $listeners = [
        'submitVoteListener'    =>  'submitVote'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'search'             =>  'nullable|min:1',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public $poll, $candidates, $voter, $vote;

    public $hasVoted = false;

    public function mount(Poll $poll){
        $this->poll = $poll;
        $this->fetchVoter();        
        $this->candidates = Candidate::whereActive(1)
        ->orderBy('name','ASC')
        ->get();   
        
        $this->checkVoteStatus();
    }

    public function render()
    {
        return view('livewire.front-end.poll-show')
        ->extends('frontend.layouts.app')
        ->section('content');
    }

    public function submitVote($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        if (!$this->voter) {
            $this->fetchVoter();
        }

        Vote::create([
            'poll_id'       => $this->poll->id,
            'voter_id'      => $this->voter->id,
            'candidate_id'  => $candidate->id,
        ]);

        $this->checkVoteStatus();
    }

    public function checkVoteStatus()
    {

        $vote_count = Vote::where('poll_id','=',$this->poll['id'])
        ->where('voter_id','=',$this->voter['id'])
        ->count();

        if($vote_count>0){
            $this->hasVoted = true;
            $this->vote = Vote::where('poll_id','=',$this->poll['id'])
            ->where('voter_id','=',$this->voter['id'])
            ->first();
        }else{
            $this->hasVoted = false;
        }
    }

    public function fetchVoter()
    {
        $agent = new Agent();
        $request = request();

        $ip = $request->ip();

        // Get location from IP (safe with try/catch)
        $country = null;
        $city = null;
        try {
            $location = Http::timeout(3)->get("https://ipapi.co/{$ip}/json/")->json();
            $country = $location['country_name'] ?? null;
            $city = $location['city'] ?? null;
        } catch (\Exception $e) {
            // Ignore location errors, default to null
        }

        // Get referer & cookie
        $referer = $request->headers->get('referer');
        $cookieValue = $request->cookie('my_cookie', null);

        // Try to find existing voter by IP + user agent OR cookie
        $existingVoter = Voter::where(function ($q) use ($ip, $request) {
                $q->where('ip_address', $ip)
                ->where('user_agent', $request->userAgent());
            })
            ->orWhere('cookie_value', $cookieValue)
            ->first();

        if ($existingVoter) {
            $this->voter = $existingVoter;
        } else {
            $this->voter = Voter::create([
                'browser'      => $agent->browser(),
                'ip_address'   => $ip,
                'country'      => $country,
                'city'         => $city,
                'user_agent'   => $request->userAgent(),
                'device'       => $agent->device(),
                'platform'     => $agent->platform(),
                'referer'      => $referer,
                'cookie_value' => $cookieValue,
            ]);
        }
    }
}
