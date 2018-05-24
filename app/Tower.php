<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
	public $timestamps = false;

	public function towersIntoRadius($x, $y, $r) {
		$towers = $this->all();
		$withinRadius = [];

		foreach ($towers as $tower) {
			$m1 = pow($tower->x_axis - $x, 2);
			$m2 = pow($tower->y_axis - $y, 2);
			if( $m1 + $m2 <= pow($r, 2) ) {

				$params = [
					'id' => $tower->id,
					'name' => $tower->name,
					'description' => $tower->description,
					'x_axis' => $tower->x_axis,
					'y_axis' => $tower->y_axis
				];
				array_push($withinRadius, $params);
			}
		}
		return $withinRadius;
	}
}
