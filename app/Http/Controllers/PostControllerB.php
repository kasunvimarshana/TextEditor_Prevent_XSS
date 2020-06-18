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

use \DomDocument as DomDocument;

class PostControllerB extends Controller
{
    //
    public function create(){
        //
        if(view()->exists('post_b')){
            return View::make('post_b', []);
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
                
                /* *** */
                $content = $request->input('content');
                $domDocumentObject = new DomDocument();
                
                $domDocumentObject->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $domDocumentObject->getElementsByTagName('img');

                foreach($images as $k => $img){

                    $data = $img->getAttribute('src');
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name= "/upload/" . time().$k.'.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                    
                }

                $contentHtml = $domDocumentObject->saveHTML();
                /* *** */
                
                $dataArray = array(
                    'content' => $contentHtml
                );

                $postObject = Post::create( $dataArray );
                unset($dataArray);

                unset($dataArray);
                
                DB::commit();
            }catch(Exception $e){
                DB::rollback(); 
                dd( $e );
                return redirect()
                    ->back()
                    ->withInput( $request->except(['content']) );
            }
        }
        
        return redirect()->back();
    }
}
