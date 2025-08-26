<?php

namespace App\Http\Livewire\FrontEnd\Traits;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Models\Vote;
use App\Models\Voter;
use App\Models\Candidate;


trait VoteTrait{


    public function submitVote($candidateId)
    {
        try {

            $candidate = Candidate::findOrFail($candidateId);

            if ($this->voter == ''|| $this->voter == null) {
                $proceed = $this->fetchVoter();
                if(!$proceed){
                    $this->dispatchBrowserEvent('alert',[
                        "type"      =>  "error",
                        'message'   =>  "Unable to identify you. Voting not allowed for bots!"
                    ]);
                    return;
                }
            }else{
                $this->checkVoteStatus();
            }

            if(!$this->hasVoted){
                Vote::create([
                    'poll_id'      => $this->poll->id,
                    'voter_id'     => $this->voter->id,
                    'candidate_id' => $candidate->id,
                ]);

                //Update current votes in poll
                $this->poll->increment('current_votes');

                // Dispatch job to update candidate stats
                $candidate->updateSelf();

                $this->checkVoteStatus();

                $this->dispatchBrowserEvent('alert',[
                    "type"      =>  "success",
                    'message'   =>  "Vote cast successfully!"
                ]);
            }else{
                $this->dispatchBrowserEvent('alert',[
                    "type"      =>  "error",
                    'message'   =>  "You have already voted!"
                ]);
            }

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }

    public function checkVoteStatus()
    {
        if(!$this->voter) {
            $this->hasVoted = false;
            return;
        }

        $vote_count = Vote::where('poll_id', $this->poll->id)
        ->where('voter_id', $this->voter->id)
        ->count();

        if ($vote_count > 0) {
            $this->hasVoted = true;
            $this->vote = Vote::where('poll_id', $this->poll->id)
                ->where('voter_id', $this->voter->id)
                ->first();
        } else {
            $this->hasVoted = false;
        }
    }


    public function fetchVoter()
    {

        $agent = new Agent();
        $request = request();

        // Create or retrieve persistent cookie value
        $cookieValue = $request->cookie('my_cookie');
        if (!$cookieValue) {
            $cookieValue = (string) Str::uuid();
            cookie()->queue(cookie('my_cookie', $cookieValue, 525600)); // 1 year
        }

        // Get IP and location
        $ip = $request->ip();
        $country = null;
        $city = null;
        try {
            $location = Http::timeout(3)->get("https://ipapi.co/{$ip}/json/")->json();
            $country = $location['country_name'] ?? null;
            $city = $location['city'] ?? null;
        } catch (\Exception $e) {
            // Ignore location errors
        }

        $referer = $request->headers->get('referer');

        // Find existing voter by unique cookie value
        $existingVoter = Voter::where('cookie_value', $cookieValue)->first();

        if ($existingVoter) {
            $this->voter = $existingVoter;
            return true;
        }elseif($agent->device() != 'Bot' || $agent->browser() != '0' || $agent->device() != '0'){
            return false;
        }


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

        return $this->voter != null? true : false;//Proceed to vote or not

    }

}
