<?php declare(strict_types=1);

class Turtle {

	public $x, $y;
	public $step;
	public $radiansIncrement;
	public $facing;

	public function __construct(int $step, float $angleIncrement, int $initialAngle) {
		$this->step = $step;
		$this->radiansIncrement = deg2rad($angleIncrement);
		$this->facing = deg2rad($initialAngle);
	}

	public function moveTo(int $x, int $y): void {
		$this->x = $x;
		$this->y = $y;
	}

	public function turnLeft(): void {
		$this->facing += $this->radiansIncrement;
	}

	public function turnRight(): void {
		$this->facing -= $this->radiansIncrement;
	}

	// This is equivalent to turning by 180 degrees
	public function reverseDirection(): void {
		$this->facing += M_PI;
	}
}


