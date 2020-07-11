<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\VotePertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    //VOTE JAWABAN
    public function upVote($pertanyaan_id, $id)
    {
        DB::table('user_votes_jawaban')->insert([
            'user_id' => Auth::user()->id,
            'jawaban_id' => $id,
            'nilai_vote' => '1'
        ]);


        $users_id = Jawaban::find($id)->users_id;

        $rep = DB::table('reputasi')->where('user_id', $users_id)->first();



        if (!$rep) {
            $rep = DB::table('reputasi')->insert([
                'poin' => '0',
                'user_id' => $users_id
            ]);
        }



        DB::table('reputasi')->where('user_id', $users_id)->update([
            'poin' => $rep->poin + 10
        ]);

        return redirect('/pertanyaan/' . $pertanyaan_id);
    }


    public function downVote($pertanyaan_id, $id)
    {
        DB::table('user_votes_jawaban')->insert([
            'user_id' => '1',
            'jawaban_id' => $id,
            'nilai_vote' => '0'
        ]);


        $users_id = Auth::user()->id;

        $rep = DB::table('reputasi')->where('user_id', $users_id)->first();

        if (!$rep) {
            $rep = DB::table('reputasi')->insert([
                'poin' => '0',
                'user_id' => $users_id
            ]);
        }

        if ($rep->poin >= 15) {
            DB::table('reputasi')->where('user_id', $users_id)->update([
                'poin' => $rep->poin - 1
            ]);
        }



        return redirect('/pertanyaan/' . $pertanyaan_id);
    }

    public function votePertanyaan($pertanyaan_id, $vote)
    {
        $users_id = Auth::user()->id;

        if ($vote == "true") {
            VotePertanyaan::updateOrCreate(
                ['pertanyaan_id' => $pertanyaan_id, 'user_id' => $users_id],
                ['nilai_vote' => 1]
            );
        } else {
            VotePertanyaan::updateOrCreate(
                ['pertanyaan_id' => $pertanyaan_id, 'user_id' => $users_id],
                ['nilai_vote' => -1]
            );
        }

        return redirect('/pertanyaan/' . $pertanyaan_id);
    }
}
