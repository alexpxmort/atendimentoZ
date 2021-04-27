<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{

    /**
     * @OA\Post(
     *      path="/upload",
     *      tags={"/upload"},
     *      summary="Faz Upload de Imagem",
     *      description="Faz Upload de Imagem",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                  property="image",
     *                   type="file",
     *                    @OA\Items(type="string",format="binary")
     *                  ),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso!",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function uploadImage(Request  $request)
    {
       try{
           $link = '';

            if($request->hasFile('image')){
                $file = $request->file('image');

               $image =  $file->store('images');

               $url  = request()->getHttpHost();
               $link = "$url/storage/$image";
            }

            return response([
                'msg'=>'Upload feito com Sucesso!',
                'link'=>$link,
                'error'=>false
            ])
            ->setStatusCode(Response::HTTP_CREATED);
       }catch(\Exception $err){
        return response([
            'msg'=>$err->getMessage(),
            'error'=>true
        ])
        ->setStatusCode(Response::HTTP_BAD_REQUEST);
       }
    }


}
