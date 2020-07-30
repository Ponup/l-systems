<?php declare(strict_types=1);

class TurtleRenderer {

	private $turtle;
	private $stack;

	public function __construct(Turtle $turtle) {
		$this->turtle = $turtle;
		$this->stack = [];
	}

	public function drawLine($im, $color, Turtle $turtle): array {
		$newX = $turtle->x + intval($turtle->step * cos($turtle->facing));	
		$newY = $turtle->y - intval($turtle->step * sin($turtle->facing));	
		imageline($im, $turtle->x, $turtle->y, $newX, $newY, $color);
		return [$newX, $newY];
	}

	public function pushState(): void {
		array_push($this->stack, clone $this->turtle);
	}

	public function popState(): void {
		$this->turtle = array_pop($this->stack);	
	}

	public function render(string $sequence, $im, $color): void {
		$len = strlen($sequence);
		for($i = 0; $i < $len; $i++) {
			$code = $sequence[$i];
			switch($code) {
			case 'F':
				$newPosition = $this->drawLine($im, $color, $this->turtle);
				$this->turtle->moveTo(...$newPosition);
				break;
			case '[':
				$this->pushState();
				break;
			case ']':
				$this->popState();
				break;
			case '+':
				$this->turtle->turnRight();
				break;
			case '-':
				$this->turtle->turnLeft();
				break;
			case '|':
				$this->turtle->reverseDirection();
				break;
			}	
		}
	}
}


