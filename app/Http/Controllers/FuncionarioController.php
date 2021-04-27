<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FuncionarioController extends Controller
{

      /**
     * @OA\Get(
     *      path="/funcionarios/all",
     *      tags={"/funcionarios/all"},
     *      summary="Lista de funcionarioss",
     *      description="Mostra lista de funcionarioss",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso!",
     *       )
     *     )
     */
    public function index (){
        $funcionarioss = Funcionario::all();

        return response()->json(
            $funcionarioss
        );
    }

    
    
    /**
     * @OA\Get(
     *      path="/funcionarios/find/{funcionario}",
     *      tags={"/funcionarios/find/:funcionario"},
     *      summary="Pega funcionario por Id",
     *      description="Retorna funcionario por Id",
     *      @OA\Parameter(
     *          name="funcionario",
     *          description="funcionario id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso!",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function show(Funcionario $funcionario)
    {

        return response()->json(
            $funcionario
        );
    }

    /**
     * @OA\Post(
     *      path="/funcionarios/create",
     *      tags={"/funcionarios/create"},
     *      summary="Cria um novo funcionario",
     *      description="Retorna um novo funcionario",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(property="nome", type="string"),
     *                  @OA\Property(property="email", type="string"),
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
    public function store(Request  $request)
    {
       try{
        $funcionario = Funcionario::create($request->all());

        return response($funcionario)
            ->setStatusCode(Response::HTTP_CREATED);
       }catch(\Exception $err){
        return response([
            'msg'=>$err->getMessage(),
            'error'=>true
        ])
        ->setStatusCode(Response::HTTP_BAD_REQUEST);
       }
    }


     /**
     * @OA\Put(
     *      path="/funcionarios/update/{funcionario}",
     *      tags={"/funcionarios/update/:funcionario"},
     *      summary="Atualiza funcionario existente",
     *      description="Retorna funcionario atualizado por id",
     *      @OA\Parameter(
     *          name="funcionario",
     *          description="funcionario id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *           @OA\MediaType(
     *               mediaType="application/json",
     *                @OA\Schema(
     *                      type="object",
     *                      @OA\Property(property="nome", type="string"),
     *                      @OA\Property(property="email", type="string"),
     *                      @OA\Property(property="servico_id", type="integer"),
     *                  )
     *          )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Sucesso",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function update(Request $request, Funcionario $funcionario)
    {
       
            try{
                $funcionario->update($request->all());
        
                return response(null)
                    ->setStatusCode(Response::HTTP_ACCEPTED);
               }catch(\Exception $err){
                return response([
                    'msg'=>$err->getMessage(),
                    'error'=>true
                ])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
               }
    }



    /**
     * @OA\Delete(
     *      path="/funcionarios/{funcionario}",
     *      tags={"/funcionarios/:funcionario"},
     *      summary="Deleta um funcionario existente",
     *      description="Deleta o funcionario por Id",
     *      @OA\Parameter(
     *          name="funcionario",
     *          description="funcionario id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Sucesso!",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function delete(Funcionario $funcionario)
    {

        try{
            $funcionario->delete();
    
            return response(null)
                ->setStatusCode(Response::HTTP_NO_CONTENT);
           }catch(\Exception $err){
            return response([
                'msg'=>$err->getMessage(),
                'error'=>true
            ])
            ->setStatusCode(Response::HTTP_BAD_REQUEST);
           }
    }


}
