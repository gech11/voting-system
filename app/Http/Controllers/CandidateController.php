<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class CandidateController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $candidates=Candidate::latest()->get();
        return view('candidates',['candidates'=>$candidates]);
    }
    public function register(){
        return view('register');
    }
    public function store(Request $request){
      $this->validate($request,[
          'name'=>['requred','string','min:4',],
          'email'=>['required','email'],
          'avatar'=>['required','image']
      ]);
      $candidate=Candidate::create(['name'=>$request->name,'email'=>$request->email]);
      $request->avatar->storeAs('public',$candidate->id);
    }
    public function vote(Candidate $candidate,User $user){
        
    }
}
