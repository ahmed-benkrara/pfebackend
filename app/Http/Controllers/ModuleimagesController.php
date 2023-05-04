<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelImage;
use App\Http\Resources\ModuleimagesResource;
use App\Http\Requests\ModuleimagesRequest;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\File;

class ModuleimagesController extends Controller
{
    use HttpResponses;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleimagesRequest $request)
    {
        $request->validated();
        $image = $request->url;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->url->move('moduleimages',$imageName);
        $img = ModelImage::create([
            'url' => 'moduleimages/'.$imageName,
            'isposter' => $request->isposter,
            'modele_id' => $request->modele_id
        ]);
        return new ModuleimagesResource($img);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ModelImage::find($id);
        if($image != null){
            File::delete($image->url);
            $image->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Module not found', 404);
        }
    }
}
