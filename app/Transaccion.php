<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model {

	//
	protected $table = 'transacciones';
	protected $fillable = ['factura','proveedor','concepto','semana','fecha_captura','fecha_agendada','cargo','abono','saldo','fecha_programada','fecha_traspaso','cheque'];

}
