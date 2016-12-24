<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DescuentoCt extends Model {

	//
	protected $fillable = ['id_descuentos','empleado','monto','concepto','fecha','semana'];
	protected $table = 'descuento_e';
	protected $primaryKey = 'id_descuentos';
	public $timestamps = true;
}