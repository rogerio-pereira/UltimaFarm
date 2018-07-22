<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $files = array();
        $filesList = array();
        $fileListDirectory = Storage::files('img');

        //Cria um vetor com imagem e data
        foreach ($fileListDirectory as $file) {
            $f['file'] = $file; 
            $f['date'] = filemtime($file); 

            $filesList[] = $f;
        }

        //Ordena Vetor por data
        usort($filesList, function($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        //Inverte o vetor para pegar as imagens mais recentes
        $filesList = array_reverse($filesList);

        //Obtem somente as imagens
        foreach ($filesList as $f) {
            $files[] = $f['file'];
        }

        return view('painel.upload.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $data = $request->all();

        $filesUp = $data['file'];

        foreach($filesUp as $file) {
            $name = $file->getClientOriginalName();

            Storage::putFileAs('/img', $file, $name);
        }
        
        return redirect()->back();
    }


    public function delete($file)
    {
        $file = str_replace("__", '/', $file);

        $file = Storage::delete($file);
        
        return redirect()->back();
    }
}
