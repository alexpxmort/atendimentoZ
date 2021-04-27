<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends BaseModel
{
    protected $table = 'clientes';
    protected $fillable = [
        'nome','email'
    ];

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'servicos_clientes', 'cliente_id', 'servico_id')->distinct();
    }


    public static function boot()
    {
        parent::boot();

       
        self::deleting(function($model){;

           DB::table('servicos_clientes')
           ->where('cliente_id',$model->id)
           ->delete();
        });

    }


   
}
