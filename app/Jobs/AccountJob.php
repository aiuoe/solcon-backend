<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AccountJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	
	protected $company_id;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($_company_id)
	{
		$this->company_id = $_company_id;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$active = [
			"activo corriente" => [
				"efectivo" => [
					"bancos",
					"cajas",
				],
				"cuentas por cobrar",
				"inventario",
				"gastos pagados por anticipado",
				"anticipos de impuestos"
			],
			"activo no corriente" => [
				"propiedad, planta y equipo",
				"intangibles"
			]
		];
		$parent_id = auth()->user()->company_accounts()
		->create([
				"company_id" => $this->company_id,
				"type" => "active",
				"name" => "activo corriente"
				"balance" => 0
		])->id;
	}
}
