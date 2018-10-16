<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Download;
use Session;

class DownloadController extends Controller
{
    public function index()
    {
        $cleaner = Download::paginate(25);
        
        return view('download.index', compact('cleaner'));
    }
    
    public function create()
    {
        return view('download.create');
    }

    public function store(Request $request)
    {        
        $requestData = $request->all();
        
        Download::create($requestData);

        Session::flash('flash_message', 'Cleaner added!');

        return redirect('download');
    }

    public function show($id)
    {
        $cleaner = Download::findOrFail($id);

        return view('download.show', compact('cleaner'));
    }

    public function edit($id)
    {
        $cleaner = Download::findOrFail($id);
       
        return view('download.edit', compact('cleaner'));
    }

    public function downloads($id)
    {
        $cleaner1 = Download::findOrFail($id);        
        $cleaner1->download_state = '2';
        $cleaner1->save();

        $cleaner = Download::findOrFail($id);        
        
        $url = $cleaner->url;
        $title = $cleaner->title;
        $extension = pathinfo($url, PATHINFO_EXTENSION);

        $filename = str_random(4).'-'.str_slug($title).'.'.$extension;

        //get file content from url
        $file = file_get_contents($url);

        $save = file_put_contents('download_folder/'.$filename, $file);

        if($save){
            $cleaner->filename = $filename;
            $cleaner->download_state = '3';
            $cleaner->save();
            return redirect('download');
            // var_dump('file');
        }else {
            $cleaner->download_state = '4';
            $cleaner->save();
            return redirect('download');
        }
        // http://www.clipartbest.com/cliparts/7ia/Kxq/7iaKxqrKT.jpeg
      }

    public function update($id, Request $request)
    {        
        $requestData = $request->all();
        
        $cleaner = Download::findOrFail($id);
      
        $cleaner->update($requestData);

        Session::flash('flash_message', 'Cleaner updated!');

        return redirect('download');
    }
    
    public function destroy($id)
    {
        Download::destroy($id);

        Session::flash('flash_message', 'Cleaner deleted!');

        return redirect('download');
    }
}