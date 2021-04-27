<?php

namespace App;

use App\BaseModel;

class ServicoCliente extends BaseModel
{
    protected $table = 'servicos_clientes';

    protected $fillable = [
      'cliente_id', 'servico_id'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at'
    ];

}
