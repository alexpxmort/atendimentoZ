<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servico extends BaseModel
{
    protected $table = 'servicos';
    protected $fillable = [
        'nome','qtd_min','valor'
    ];

    public static function boot()
    {
        parent::boot();

       
        self::deleting(function($model){
           DB::table('funcionarios')
           ->where('servico_id',$model->id)
           ->update((['servico_id'=>null]));

           DB::table('servicos_clientes')
           ->where('servico_id',$model->id)
           ->delete();
        });

    }

    public function funcionario()
    {
      return $this->belongsTo(Funcionario::class);
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'servicos_clientes', 'servico_id', 'cliente_id')->distinct();
    }

   
}
