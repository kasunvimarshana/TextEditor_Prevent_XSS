<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session as Session;
use DB;
use \Exception;
use Illuminate\Support\Facades\Route;

use Mews\Purifier\Facades\Purifier as Purifier;

class PostControllerA extends Controller
{
    //
    public function create(){
        //
        if(view()->exists('post_a')){
            return View::make('post_a', []);
        }
    }
    
    public function store(Request $request){
        //
        $dataArray = array();
        
        $rules = array(
            'content'    => 'required'
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput( $request->except(['content']) );
        } else {
            try {
                DB::beginTransaction();
                
                $dataArray = array(
                    'content' => Purifier::clean( $request->input('content') )
                );

                $postObject = Post::create( $dataArray );
                unset($dataArray);

                unset($dataArray);
                
                DB::commit();
            }catch(Exception $e){
                DB::rollback(); 
                return redirect()
                    ->back()
                    ->withInput( $request->except(['content']) );
            }
        }
        
        return redirect()->back();
    }
}
