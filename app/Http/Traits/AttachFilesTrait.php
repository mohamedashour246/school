<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
     public function uploadFile($request,$name,$folder)
     {
         $filename = $request->file($name)->getClientOriginalName();
      //   $request->file($name)->storeAs('attachments/library/'.$filename,$request->file($name)->getClientOriginalName(),'upload_attachments');
         $request->file($name)->storeAs('attachments/'.$folder,$request->file($name)->getClientOriginalName(),'upload_attachments');

         return $filename;
     }

     public function deleteFile($name,$folder)
     {
        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/'.$folder.'/'.$name);
        }
     }
}
