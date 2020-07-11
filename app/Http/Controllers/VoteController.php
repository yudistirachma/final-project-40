<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\pertanyaan;
use App\VoteJawaban;
use App\VotePertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    //VOTE JAWABAN
    public function upVote($pertanyaan_id, $id)
    {
        $ada = VoteJawaban::where(['jawaban_id' => $id, 'user_id' => Auth::user()->id])->first();
        VoteJawaban::updateOrCreate(
            ['jawaban_id' => $id, 'user_id' => Auth::user()->id],
            ['nilai_vote' => '1']
        );


        $users_id = Jawaban::find($id)->users_id;

        $rep = DB::table('reputasi')->where('user_id', $users_id)->first();


        if (!$rep) {
            $rep = DB::table('reputasi')->insert([
                'poin' => '0',
                'user_id' => $users_id
            ]);
            $rep_poin = 0;
        } else {
            $rep_poin = $rep->poin;
        }



        if (!$ada) {
            DB::table('reputasi')->where('user_id', $users_id)->update([
                'poin' => $rep_poin + 10
            ]);
        }


        return redirect('/pertanyaan/' . $pertanyaan_id);
    }


    public function downVote($pertanyaan_id, $id)
    {
        $users_id = Auth::user()->id;

        $rep = DB::table('reputasi')->where('user_id', $users_id)->first();

        if (!$rep) {
            $rep = DB::table('reputasi')->insert([
                'poin' => '0',
                'user_id' => $users_id
            ]);
            $rep_poin = 0;
        } else {
            $rep_poin = $rep->poin;
        }

        if ($rep_poin >= 15) {
            VoteJawaban::updateOrCreate(
                ['jawaban_id' => $id, 'user_id' => Auth::user()->id],
                ['nilai_vote' => '0']
            );

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
            $ada = VotePertanyaan::where(['pertanyaan_id' => $pertanyaan_id, 'user_id' => $users_id])->first();

            VotePertanyaan::updateOrCreate(
                ['pertanyaan_id' => $pertanyaan_id, 'user_id' => $users_id],
                ['nilai_vote' => 1]
            );

            $pembuat_id = pertanyaan::find($pertanyaan_id)->users_id;

            $rep = DB::table('reputasi')->where('user_id', $pembuat_id)->first();

            if (!$rep) {
                $rep = DB::table('reputasi')->insert([
                    'poin' => '0',
                    'user_id' => $pembuat_id
                ]);
                $rep_poin = 0;
            } else {
                $rep_poin = $rep->poin;
            }



            if (!$ada) {
                DB::table('reputasi')->where('user_id', $pembuat_id)->update([
                    'poin' => $rep_poin + 10
                ]);
            }
        } else {
            $rep = DB::table('reputasi')->where('user_id', $users_id)->first();

            if (!$rep) {
                $rep = DB::table('reputasi')->insert([
                    'poin' => '0',
                    'user_id' => $users_id
                ]);
                $rep_poin = 0;
            } else {
                $rep_poin = $rep->poin;
            }

            if ($rep_poin >= 15) {
                VotePertanyaan::updateOrCreate(
                    ['pertanyaan_id' => $pertanyaan_id, 'user_id' => $users_id],
                    ['nilai_vote' => -1]
                );

                DB::table('reputasi')->where('user_id', $users_id)->update([
                    'poin' => $rep->poin - 1
                ]);
            }

            
        }

        return redirect('/pertanyaan/' . $pertanyaan_id);
    }
}