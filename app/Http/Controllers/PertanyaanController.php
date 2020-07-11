<?php

namespace App\Http\Controllers;

use App\Jawaban;
use Illuminate\Http\Request;
use App\Pertanyaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class PertanyaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data =  Pertanyaan::paginate(5);
        // dd($data);
        return view('index', compact('data'));
    }
    public function create()
    {
        return view(('pertanyaan.create'));
    }
    public function detail($id)
    {
        $data = Pertanyaan::find($id);
        $jawaban = Jawaban::with(['user'])->where('pertanyaan_id', $id)->get();
        $jawaban_tepat = Jawaban::where('id', $data->jawaban_tepat_id)->first();
        $voteScorePlus = DB::table('user_votes_pertanyaan')->where('pertanyaan_id', $id)->where('nilai_vote', 1)->count();
        $voteScoreMinus = DB::table('user_votes_pertanyaan')->where('pertanyaan_id', $id)->where('nilai_vote', -1)->count();
        $voteScore = $voteScorePlus - $voteScoreMinus;

        $voteScoreJawaban_jawaban_id = DB::table('user_votes_jawaban')->select('jawaban_id')->groupBy('jawaban_id')->get();
        $voteScoreJawaban = [];

        foreach ($voteScoreJawaban_jawaban_id as $vtj) {
            $scoreJwb = new stdClass();
            $scoreJwb->up = DB::table('user_votes_jawaban')->where('jawaban_id', $vtj->jawaban_id)->where('nilai_vote', 1)->count();
            $scoreJwb->down = DB::table('user_votes_jawaban')->where('jawaban_id', $vtj->jawaban_id)->where('nilai_vote', 0)->count();

            $voteScoreJawaban[] = $scoreJwb;
        }

        // dd($voteScore);
        //dd($jawaban_tepat);
        return view('pertanyaan.detail', compact('data', 'jawaban', 'voteScore', 'jawaban_tepat', 'voteScoreJawaban', 'voteScorePlus', 'voteScoreMinus'));
    }
    public function edit($id)
    {
        $data = Pertanyaan::find($id);
        return view('pertanyaan.edit', compact('data'));
    }
    public function update($id)
    {
        $data = request()->all();
        $data["updated_at"] = date("Y-m-d H:i:s");
        unset($data["_token"], $data["_method"]);
        // dd($data);
        Pertanyaan::where('id', $id)->update($data);
        return redirect('/pertanyaan/' . $id);
    }
    public function store()
    {
        $data = request()->all();
        $data["users_id"] = Auth::user()->id;
        Pertanyaan::create($data);
        return redirect('/');
    }
    public function destroy($id)
    {
        Pertanyaan::destroy($id);
        return back();
    }

    public function pilihJawabanTepat($pertanyaan_id, $jawaban_id)
    {
        $pembuat_id = Jawaban::find($jawaban_id)->users_id;

        Pertanyaan::where('id', $pertanyaan_id)->update([
            'jawaban_tepat_id' => $jawaban_id
        ]);

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

        DB::table('reputasi')->where('user_id', $pembuat_id)->update([
            'poin' => $rep_poin + 15
        ]);


        return back();
    }
}
