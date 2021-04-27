<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Funcionario extends BaseModel
{
    protected $table = 'funcionarios';
    protected $fillable = [
        'nome','email','servico_id'
    ];

    public function servico()
    {
      return $this->belongsTo(Servico::class);
    }

    public static function boot()
    {
        parent::boot();

       
        self::deleting(function($model){;
           $model->update(['servico_id'=>null]);
        });

    }

   
}
