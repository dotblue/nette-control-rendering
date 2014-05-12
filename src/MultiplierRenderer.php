<?php

/**
 * Copyright (c) dotBlue (http://dotblue.net)
 */

namespace DotBlue\NetteControl;

use Nette\Application\UI;
use Nette\ComponentModel\IComponent;
use Nette\ComponentModel\IContainer;


class MultiplierRenderer extends UI\Multiplier
{

	/** @var UI\Multiplier */
	private $multiplier;

	/** @var Wrapper */
	private $wrapper;



	public function __construct(UI\Multiplier $multiplier, $mode)
	{
		$this->multiplier = $multiplier;
		$this->wrapper = new Wrapper($multiplier, $mode);
	}



	public function getComponent($name, $need = TRUE)
	{
		return $this->wrapper->getComponent($name, $need);
	}



	public function getComponents($deep = FALSE, $filterType = NULL)
	{
		return $this->wrapper->getComponents($deep, $filterType);
	}



	/** Nette\ComponentModel\Component */



	public function lookup($type, $need = TRUE)
	{
		return $this->multiplier->lookup($type, $need);
	}



	public function lookupPath($type = NULL, $need = TRUE)
	{
		return $this->multiplier->lookupPath($type, $need);
	}



	public function monitor($type)
	{
		return $this->multiplier->monitor($type);
	}



	public function unmonitor($type)
	{
		return $this->multiplier->unmonitor($type);
	}



	protected function attached($presenter)
	{
		return $this->multiplier->attached($presenter);
	}



	protected function detached($presenter)
	{
		return $this->multiplier->detached($presenter);
	}



	public function getName()
	{
		return $this->multiplier->getName();
	}



	public function getParent()
	{
		return $this->multiplier->getParent();
	}



	public function setParent(IContainer $parent = NULL, $name = NULL)
	{
		return $this->multiplier->setParent($parent, $name);
	}



	protected function validateParent(IContainer $parent)
	{
		return $this->multiplier->validateParent($parent);
	}



	/** Nette\ComponentModel\Container */



	public function addComponent(IComponent $component, $name, $insertBefore = NULL)
	{
		return $this->multiplier->addComponent($component, $name, $insertBefore);
	}



	public function removeComponent(IComponent $component)
	{
		return $this->multiplier->removeComponent($component);
	}



	/** Nette\Application\UI\PresenterComponent */



	public function getPresenter($need = TRUE)
	{
		return $this->multiplier->getPresenter($need);
	}



	public function getUniqueId()
	{
		return $this->multiplier->getUniqueId();
	}



	protected function tryCall($method, array $params)
	{
		return $this->multiplier->tryCall($method, $params);
	}



	public function checkRequirements($element)
	{
		return $this->multiplier->checkRequirements($element);
	}



	public static function getReflection()
	{
		$multiplier = $this->multiplier;
		return $multiplier::getReflection();
	}



	/********************* interface IStatePersistent ****************d*g**/



	public function loadState(array $params)
	{
		return $this->multiplier->loadState($params);
	}



	public function saveState(array & $params, $reflection = NULL)
	{
		return $this->multiplier->saveState($params, $reflection);
	}



	public function getParameter($name, $default = NULL)
	{
		return $this->multiplier->getParameter($name, $default);
	}



	public function getParameters()
	{
		return $this->multiplier->getParameters();
	}



	public function getParameterId($name)
	{
		return $this->multiplier->getParameterId($name);
	}



	/** @deprecated */
	function getParam($name = NULL, $default = NULL)
	{
		return $this->multiplier->getParam($name, $default);
	}



	public static function getPersistentParams()
	{
		$multiplier = $this->multiplier;
		return $multiplier::getPersistentParams();
	}



	/********************* interface ISignalReceiver ****************d*g**/



	public function signalReceived($signal)
	{
		return $this->multiplier->signalReceived($signal);
	}



	public static function formatSignalMethod($signal)
	{
		$multiplier = $this->multiplier;
		return $multiplier::formatSignalMethod($signal);
	}



	/********************* navigation ****************d*g**/



	public function link($destination, $args = array())
	{
		return call_user_func_array([$this->multiplier, 'link'], func_get_args());
	}



	public function lazyLink($destination, $args = array())
	{
		return call_user_func_array([$this->multiplier, 'lazyLink'], func_get_args());
	}



	public function isLinkCurrent($destination = NULL, $args = array())
	{
		return call_user_func_array([$this->multiplier, 'isLinkCurrent'], func_get_args());
	}



	public function redirect($code, $destination = NULL, $args = array())
	{
		return call_user_func_array([$this->multiplier, 'redirect'], func_get_args());
	}



	/********************* interface \ArrayAccess ****************d*g**/



	public function offsetSet($name, $component)
	{
		return $this->multiplier->offsetSet($name, $component);
	}



	public function offsetGet($name)
	{
		return $this->multiplier->offsetGet($name);
	}



	public function offsetExists($name)
	{
		return $this->multiplier->offsetExists($name);
	}



	public function offsetUnset($name)
	{
		return $this->multiplier->offsetUnset($name);
	}



	/** Mimic behavior */



	public function __call($name, $args)
	{
		return call_user_func_array([$this->multiplier, $name], $args);
	}



	public function &__get($name)
	{
		return $this->multiplier->$name;
	}



	public function __set($name, $value)
	{
		return $this->multiplier->$name = $value;
	}



	public function __isset($name)
	{
		return isset($this->multiplier->$name);
	}



	public function __unset($name)
	{
		unset($this->multiplier->$name);
	}

}
