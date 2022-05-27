<?php

namespace App\Http\Controllers;

use App\Models\VotingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VotingRequestController extends Controller
{
    /**
     * @param Request $request
     * Get voting request for booth
     * return json
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request) {
        $voting_request = VotingRequest::where('booth_id', $request->boothId)->first();

        //return $voting_request->toJson();
        return response()->json($voting_request);
    }

    public function update(Request $request, $boothId) {
        $data = $request->json()->all();
        $voting_request = VotingRequest::where('booth_id', $boothId)->first();
        $voting_request->voter_id = $data['voter_id'];
        $voting_request->voter_data = $data['voter_data'];
        $voting_request->save();

        return response()->json($voting_request);
    }
}
