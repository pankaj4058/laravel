<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\fileuploaded;

class FileUploadController extends Controller
{
    public function index(){
        return view('fileUpload');
    }

    public function stored(Request $request){

        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name= $filename.'-'.time().'.'.$extension;
        $image->move(public_path('dragupload'),$file_name);

        $imageUpload = new fileUploaded;
       // $imageUpload->original_filename = $fileInfo;
        $imageUpload->path = $file_name;
        $imageUpload->save();
        return response()->json(['success'=>$file_name]);
    }

    public function destroy(Request $request,$id)
        {
            // $fileid =  $request->get($id);

            $file = fileUploaded::find($id);
            // echo "<pre>";
            // echo $file;
            // print_r($file);
            // die;
            $filename = $file->path;
            fileUploaded::where('id',$id)->delete();
            $path = public_path('dragupload/').$filename;
            if (file_exists($path)) {
                unlink($path);
            }
            return back()->with('message',$filename.'Delete Succesfully');
            // return response()->json(['success'=>$filename]);
        }

        public function getimage()
        {
            // die('getimage function');
            $images = fileUploaded::all()->toArray();

            foreach($images as $image){
                $obj['name'] = $image['path'];
               $obj['id'] = $image['id'];
               $obj['path'] = url('public/dragupload/'.$obj['name']);
               $data[] = $obj;

            }
            // echo "<pre>";
            // print_r($data);
            // die;
            // $storeFolder = public_path('dragupload');
            // $file_path = public_path('dragupload');
            // $files = scandir($storeFolder);

            // // $id = $images->id;

            // foreach ( $files as $file ) {
            //     if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {


            //         $obj['name'] = $file;


            //         $file_path = public_path('dragupload/').$file;


            //         $obj['size'] = filesize($file_path);

            //         $obj['path'] = url('public/dragupload/'.$file);

            //         $data[] = $obj;

            //     }


            // }

            //dd($data);
            return response()->json($data);
        }

}
