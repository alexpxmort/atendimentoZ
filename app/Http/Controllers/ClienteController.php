<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ServicoCliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

      /**
     * @OA\Get(
     *      path="/clientes/all",
     *      tags={"/clientes/all"},
     *      summary="Lista de clientes",
     *      description="Mostra lista de clientes",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso!",
     *       )
     *     )
     */
    public function index (){
        $Clientes = Cliente::all();

        return response()->json(
            $Clientes
        );
    }

    
    
    /**
     * @OA\Get(
     *      path="/clientes/find/{cliente}",
     *      tags={"/clientes/find/:cliente"},
     *      summary="Pega cliente por Id",
     *      description="Retorna cliente por Id",
     *      @OA\Parameter(
     *          name="cliente",
     *          description="Cliente id",
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
    public function show(Cliente $cliente)
    {

        return response()->json(
           [
               'cliente'=>$cliente,
               'servicos'=>$cliente->servicos
           ]
        );
    }

    /**
     * @OA\Post(
     *      path="/clientes/create",
     *      tags={"/cliente/create"},
     *      summary="Cria um novo Cliente",
     *      description="Retorna um novo cliente",
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
        $Cliente = Cliente::create($request->all());

        return response($Cliente)
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
     *      path="/clientes/update/{cliente}",
     *      tags={"/cliente/update/:cliente"},
     *      summary="Atualiza cliente existente",
     *      description="Retorna cliente atualizado por id",
     *      @OA\Parameter(
     *          name="cliente",
     *          description="Cliente id",
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
    public function update(Request $request, Cliente $cliente)
    {
       
            try{
                $cliente->update($request->all());
        
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
     *      path="/clientes/{cliente}",
     *      tags={"/clientes/:cliente"},
     *      summary="Deleta um cliente existente",
     *      description="Deleta o cliente por Id",
     *      @OA\Parameter(
     *          name="cliente",
     *          description="Cliente id",
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
    public function delete(Cliente $cliente)
    {

        try{
            $cliente->delete();
    
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
     *          path="/clientes/addServicos/{cliente}",
     *          tags={"/clientes/addServicos/:cliente"},
     *          summary="Adiciona servicos ao cliente",
     *          description="Adiciona servicos ao cliente",
     *        @OA\Parameter(
     *          name="cliente",
     *          description="cliente id",
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
     *                   @OA\Property(
     *                      type="object",
     *                            property="servicos", type="array",
     *                           @OA\Items(
     *                              type="object",
     *                               @OA\Property(property="id", type="integer"),
     *                             )
     *                  )
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
    public function storeServicos(Request  $request,Cliente $cliente)
    {
       try{
        
        if($request->has('servicos') && is_array($request->servicos)){
           
            ServicoCliente::where('cliente_id',$cliente->id)->delete();

            foreach($request->servicos as $servico){

                ServicoCliente::create(
                   [
                    'cliente_id'=>$cliente->id,
                    'servico_id'=>isset($servico['id'])?$servico['id']:$servico
                   ]
                );

            }

            return response(null)
        ->setStatusCode(Response::HTTP_NO_CONTENT);
          
        }else{
            return response(null)
        ->setStatusCode(Response::HTTP_NO_CONTENT);
        }

        
      
       }catch(\Exception $err){
        return response([
            'msg'=>$err->getMessage(),
            'error'=>true
        ])
        ->setStatusCode(Response::HTTP_BAD_REQUEST);
       }
    }


}
