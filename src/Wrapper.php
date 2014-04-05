<?php

namespace DotBlue\NetteControl;

use Nette\Application\UI;
use Nette\ComponentModel\RecursiveComponentIterator;


class Wrapper
{

	/** @var UI\PresenterComponent */
	private $component;

	/** @var string */
	private $renderMode;

	/** @var {UI\Control|UI\Multiplier}[] */
	private $children = [];



	public function __construct(UI\PresenterComponent $component, $renderMode)
	{
		$this->component = $component;
		$this->renderMode = $renderMode;
	}



	public function getComponent($name, $need = TRUE)
	{
		$component = $this->component->getComponent($name, $need);
		if ($component !== NULL) {
			$component = $this->wrapComponent($name, $component);
		}
		return $component;
	}



	public function getComponents($deep = FALSE, $filterType = NULL)
	{
		$components = $this->component->getComponents($deep, $filterType);

		$result = [];
		foreach ($components as $name => $component) {
			$result[$name] = $this->wrapComponent($name, $component);
		}

		return new RecursiveComponentIterator($result);
	}



	private function wrapComponent($name, $component)
	{
		if ($component instanceof UI\Control) {
			if (!isset($this->children[$name])) {
				$this->children[$name] = new Renderer($component, $this->renderMode);
			}
			return $this->children[$name];
		} elseif ($component instanceof UI\Multiplier) {
			if (!isset($this->children[$name])) {
				$this->children[$name] = new MultiplierRenderer($component, $this->renderMode);
			}
			return $this->children[$name];
		}
		return $component;
	}

}
