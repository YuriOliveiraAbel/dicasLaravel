<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nome',
        'id'
    ];

    public static $autoValidates = true;
    protected static $rules = [];
    protected static function boot(){
        parent::boot();
        static::saving(function($model){
            //VALIDANDO NO MODEL
            if($model::$autoValidates){
                return $model->validate();
            }

            //BARRANDO ATUALIZAÇÃO DO MODEL
            static::updating(function($model){
                return false;
            });
        });
    }

    public function validate(){

    }

    public function category()
    {   //SO IRA RELACIONAR SE DE ACORDO COM A CONDIÇÃO INFORMADA NO WHERE
        return $this->belongsTo('Cupom', 'cupom_id')
            ->where('usuario_id', Auth::user()->id);
    }
}
