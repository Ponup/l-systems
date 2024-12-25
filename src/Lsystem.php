<?php declare(strict_types=1);

class Lsystem {

	public function __construct(private stdclass $config) {
	}

	public function run(): string {
		$sequence = $this->config->axiom;
		for($i = 0; $i < $this->config->iterations; $i++) {
			$newSequence = '';
			foreach(str_split($sequence) as $rule) {
				if(isset($this->config->rules->$rule))
					$newSequence .= $this->config->rules->$rule;
				else
					$newSequence .= $rule;
				
			}
			$sequence = $newSequence;
		}
		return $sequence;
	}
}

