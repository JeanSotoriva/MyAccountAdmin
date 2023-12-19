<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;



class Conta extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cpf',
        'conta',
        'saldo',
        'data_criacao',
    ];

    protected $casts = [
        'cpf' => 'string',
        'conta' => 'integer',
        'saldo' => 'double',
        'data_criacao' => 'datetime',
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'cpf', 'cpf');
    }

    public function movimentacoes() {
        return $this->hasMany(Movimentacao::class, 'num_conta', 'conta');
    }
}
