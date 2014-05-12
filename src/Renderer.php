<?php

/**
 * Copyright (c) dotBlue (http://dotblue.net)
 */

namespace DotBlue\NetteControl;

use Nette\Application\UI;
use Nette\ComponentModel\IComponent;
use Nette\ComponentModel\IContainer;


class Renderer extends UI\Control
{

	const DEFAULT_MODE = 'default';

	/** @var UI\Control */
	private $control;

	/** @var string[]|string */
	private $renderMode;

	/** @var Wrapper */
	private $wrapper;



	public function __construct(UI\Control $control, $mode = self::DEFAULT_MODE)
	{
		$this->control = $control;
		$this->renderMode = $mode;
		$this->wrapper = new Wrapper($control, $mode);
	}



	public function render()
	{
		$template = $this->control->getTemplate();
		$template->_control = $template->control = $this;

		$mode = $this->determineRenderMode($this->control, $this->renderMode);
		$method = $this->formatRenderMethod($mode);
		return $this->control->$method();
	}



	public function getComponent($name, $need = TRUE)
	{
		return $this->wrapper->getComponent($name, $need);
	}



	public function getComponents($deep = FALSE, $filterType = NULL)
	{
		return $this->wrapper->getComponents($deep, $filterType);
	}



	/**
	 * Checks if method render*Mode* exists and returns first matched mode.
	 *
	 * @param  UI\Control
	 * @param  string[]|string
	 * @return string
	 */
	private function determineRenderMode($control, $modes)
	{
		foreach (is_array($modes) ? $modes : [$modes] as $mode) {
			if (method_exists($control, $this->formatRenderMethod($mode))) {
				return $mode;
			}
		}

		return self::DEFAULT_MODE;
	}



	private function formatRenderMethod($mode)
	{
		return 'render' . ($mode === self::DEFAULT_MODE ? '' : ucfirst($mode));
	}



	/** Nette\ComponentModel\Component */



	public function lookup($type, $need = TRUE)
	{
		return $this->control->lookup($type, $need);
	}



	public function lookupPath($type = NULL, $need = TRUE)
	{
		return $this->control->lookupPath($type, $need);
	}



	public function monitor($type)
	{
		return $this->control->monitor($type);
	}



	public function unmonitor($type)
	{
		return $this->control->unmonitor($type);
	}



	protected function attached($presenter)
	{
		return $this->control->attached($presenter);
	}



	protected function detached($presenter)
	{
		return $this->control->detached($presenter);
	}



	public function getName()
	{
		return $this->control->getName();
	}



	public function getParent()
	{
		return $this->control->getParent();
	}



	public function setParent(IContainer $parent = NULL, $name = NULL)
	{
		return $this->control->setParent($parent, $name);
	}



	protected function validateParent(IContainer $parent)
	{
		return $this->control->validateParent($parent);
	}



	/** Nette\ComponentModel\Container */



	public function addComponent(IComponent $component, $name, $insertBefore = NULL)
	{
		return $this->control->addComponent($component, $name, $insertBefore);
	}



	public function removeComponent(IComponent $component)
	{
		return $this->control->removeComponent($component);
	}



	/** Nette\Application\UI\PresenterComponent */



	public function getPresenter($need = TRUE)
	{
		return $this->control->getPresenter($need);
	}



	public function getUniqueId()
	{
		return $this->control->getUniqueId();
	}



	protected function tryCall($method, array $params)
	{
		return $this->control->tryCall($method, $params);
	}



	public function checkRequirements($element)
	{
		return $this->control->checkRequirements($element);
	}



	public static function getReflection()
	{
		$control = $this->control;
		return $control::getReflection();
	}



	/********************* interface IStatePersistent ****************d*g**/



	public function loadState(array $params)
	{
		return $this->control->loadState($params);
	}



	public function saveState(array & $params, $reflection = NULL)
	{
		return $this->control->saveState($params, $reflection);
	}



	public function getParameter($name, $default = NULL)
	{
		return $this->control->getParameter($name, $default);
	}



	public function getParameters()
	{
		return $this->control->getParameters();
	}



	public function getParameterId($name)
	{
		return $this->control->getParameterId($name);
	}



	/** @deprecated */
	function getParam($name = NULL, $default = NULL)
	{
		return $this->control->getParam($name, $default);
	}



	public static function getPersistentParams()
	{
		$control = $this->control;
		return $control::getPersistentParams();
	}



	/********************* interface ISignalReceiver ****************d*g**/



	public function signalReceived($signal)
	{
		return $this->control->signalReceived($signal);
	}



	public static function formatSignalMethod($signal)
	{
		$control = $this->control;
		return $control::formatSignalMethod($signal);
	}



	/********************* navigation ****************d*g**/



	public function link($destination, $args = array())
	{
		return call_user_func_array([$this->control, 'link'], func_get_args());
	}



	public function lazyLink($destination, $args = array())
	{
		return call_user_func_array([$this->control, 'lazyLink'], func_get_args());
	}



	public function isLinkCurrent($destination = NULL, $args = array())
	{
		return call_user_func_array([$this->control, 'isLinkCurrent'], func_get_args());
	}



	public function redirect($code, $destination = NULL, $args = array())
	{
		return call_user_func_array([$this->control, 'redirect'], func_get_args());
	}



	/********************* interface \ArrayAccess ****************d*g**/



	public function offsetSet($name, $component)
	{
		return $this->control->offsetSet($name, $component);
	}



	public function offsetGet($name)
	{
		return $this->control->offsetGet($name);
	}



	public function offsetExists($name)
	{
		return $this->control->offsetExists($name);
	}



	public function offsetUnset($name)
	{
		return $this->control->offsetUnset($name);
	}



	/** Nette\ComponentModel\Control */



	public function getTemplate()
	{
		return $this->control->getTemplate();
	}



	public function flashMessage($message, $type = 'info')
	{
		return $this->control->flashMessage($message, $type);
	}



	public function getSnippetId($name = NULL)
	{
		return $this->control->getSnippetId($name);
	}



	public function redrawControl($snippet = NULL, $redraw = TRUE)
	{
		return $this->control->redrawControl($snippet);
	}



	/** @deprecated */
	function invalidateControl($snippet = NULL)
	{
		return $this->control->invalidateControl($snippet);
	}



	/** @deprecated */
	function validateControl($snippet = NULL)
	{
		return $this->control->validateControl($snippet);
	}



	public function isControlInvalid($snippet = NULL)
	{
		return $this->control->isControlInvalid($snippet);
	}



	/** Mimic behavior */



	public function __call($name, $args)
	{
		return call_user_func_array([$this->control, $name], $args);
	}



	public function &__get($name)
	{
		return $this->control->$name;
	}



	public function __set($name, $value)
	{
		return $this->control->$name = $value;
	}



	public function __isset($name)
	{
		return isset($this->control->$name);
	}



	public function __unset($name)
	{
		unset($this->control->$name);
	}

}
