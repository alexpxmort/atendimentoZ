<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Servico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicoController extends Controller
{

      /**
     * @OA\Get(
     *      path="/servicos/all",
     *      tags={"/servicos/all"},
     *      summary="Lista de serviços",
     *      description="Mostra lista de serviços",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso!",
     *       )
     *     )
     */
    public function index (){
        $servicos = Servico::all();

        return response()->json(
            $servicos
        );
    }

    
    
    /**
     * @OA\Get(
     *      path="/servicos/find/{servico}",
     *      tags={"/servicos/find/:servico"},
     *      summary="Pega serviço por Id",
     *      description="Retorna serviço por Id",
     *      @OA\Parameter(
     *          name="servico",
     *          description="servico id",
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
    public function show(Servico $servico)
    {

        return response()->json(
            $servico
        );
    }

    /**
     * @OA\Post(
     *      path="/servicos/create",
     *      tags={"/servicos/create"},
     *      summary="Cria um novo Serviço",
     *      description="Retorna um novo Serviço",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(property="nome", type="string"),
     *                  @OA\Property(property="qtd_min", type="integer"),
     *                  @OA\Property(property="valor", type="number")
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
        $servico = Servico::create($request->all());

        return response($servico)
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
     *      path="/servicos/update/{servico}",
     *      tags={"/servicos/update/:servico"},
     *      summary="Atualiza serviço existente",
     *      description="Retorna serviço atualizado por id",
     *      @OA\Parameter(
     *          name="servico",
     *          description="servico id",
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
     *                      @OA\Property(property="qtd_min", type="integer"),
     *                      @OA\Property(property="valor", type="number")
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
    public function update(Request $request, Servico $servico)
    {
       
            try{
                $servico->update($request->all());
        
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
     *      path="/servicos/{servico}",
     *      tags={"/servicos/:servico"},
     *      summary="Deleta um Serviço existente",
     *      description="Deleta o Serviço por Id",
     *      @OA\Parameter(
     *          name="servico",
     *          description="servico id",
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
    public function delete(Servico $servico)
    {

        try{
            $servico->delete();
    
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

    
    /**
     * @OA\Post(
     *      path="/servicos/addFuncionario/{servico}",
     *      tags={"/servicos/addFuncionario/:servico"},
     *      summary="Adiciona funcionario ao servico",
     *          description="Adiciona funcionario ao servico",
     *        @OA\Parameter(
     *          name="servico",
     *          description="servico id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(property="funcionario_id", type="integer"),
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
    public function storeFuncionario(Request  $request,Servico $servico)
    {
       try{
        
        if($request->has('funcionario_id') && !is_null($request->funcionario_id)){
            $funcionarioDb = Funcionario::where('id',$request->funcionario_id)->first();

            if(!is_null($funcionarioDb)){
                $funcionarioDb->update([
                    'servico_id'=>$servico->id
                ]);

                return response($servico)
                ->setStatusCode(Response::HTTP_NO_CONTENT);
            }else{
                return response($funcionarioDb)
                ->setStatusCode(Response::HTTP_NOT_FOUND);
            }
        }

        return response($servico)
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
