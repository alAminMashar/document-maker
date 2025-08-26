<?php

namespace App\Http\Livewire\FrontEnd\Traits;

use App\Models\Vote;
use App\Models\Voter;
use App\Models\Candidate;

trait FingerPrintTrait{

    public function submitVoteAI($candidateId)
    {

        $candidate = Candidate::findOrFail($candidateId);

        // Check if this voter already voted in this poll
        $alreadyVoted = Vote::where('poll_id', $this->poll->id)
            ->where('voter_id', $this->voter->id)
            ->exists();

        if ($alreadyVoted) {
             $this->dispatchBrowserEvent('alert',[
                "type"      =>  "info",
                'message'   =>  "You've already voted!"
            ]);

            return;
        }

        Vote::create([
            'poll_id'       => $this->poll->id,
            'voter_id'      => $this->voter->id,
            'candidate_id'  => $candidate->id,
        ]);

        $this->checkVoteStatus();
        session()->flash('success', 'Your vote has been recorded.');
    }


    public function fetchVoterWithFingerPrint()
    {
        $agent = new \Jenssegers\Agent\Agent();
        $request = request();
        $ip = $request->ip();

        // Cookie check
        $cookieValue = $request->cookie('my_cookie', null);

        // Look for an existing voter by IP + User Agent + Cookie + Fingerprint
        $existing = Voter::where('ip_address', $ip)
            ->where('user_agent', $request->userAgent())
            ->when($cookieValue, fn($q) => $q->orWhere('cookie_value', $cookieValue))
            ->when($this->fingerprint ?? null, fn($q) => $q->orWhere('fingerprint', $this->fingerprint))
            ->first();

        if ($existing) {
            $this->voter = $existing;
            return;
        }elseif($agent->device() != 'Bot' || $agent->browser() != '0' || $agent->device() != '0'){
            return;
        }

        // Create new voter
        $this->voter = Voter::create([
            'browser'      => $agent->browser(),
            'ip_address'   => $ip,
            'country'      => null,
            'city'         => null,
            'user_agent'   => $request->userAgent(),
            'device'       => $agent->device(),
            'platform'     => $agent->platform(),
            'referer'      => $request->headers->get('referer'),
            'cookie_value' => $cookieValue,
            'fingerprint'  => $this->fingerprint ?? null,
        ]);

        return $this->voter != null? true : false;//Proceed to vote or not
    }

    public function storeFingerprint($fingerprint)
    {
        // Store fingerprint in voter if not already set
        if ($this->voter) {
            $this->voter->update(['fingerprint' => $fingerprint]);
        } else {
            // If voter doesn't exist yet, fetch/create
            $this->fetchVoter();
            if($this->voter) {
                $this->voter->update(['fingerprint' => $fingerprint]);
            }
        }
    }
}
