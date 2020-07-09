<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JawabanController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return $id;
        //return view('jawaban.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Jawaban::create($request->all());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban $jawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jawaban::find($id);

        //return view('jawaban.edit', compact('data'));
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Jawaban::where('id', $id)->update($request->all());
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jawaban::destroy($id);
        return redirect('/');
    }

    public function createKomentar($id)
    {
        $data = Jawaban::find($id);
        return view('jawaban.form_komentar');
    }

    public function storeKomentar(Request $request)
    {
        DB::table('user_comment_jawaban')->insert($request->all());
        return redirect('/');
    }

    public function upVote($id)
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

        return redirect('/');
    }


    public function downVote($id)
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



        return redirect('/');
    }
}
