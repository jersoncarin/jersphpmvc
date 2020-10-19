<?php

class View
{
	public function render($viewPath)
	{
		require(PATH . 'views/' . $viewPath . '.php');			
	}

	public function load_css_theme($theme,$css_name) {
		return '/assets/' . $theme . '/css/' . $css_name . '?v=' . time();
	}

	public function load_js_theme($theme,$css_name) {
		return '/assets/' . $theme . '/js/' . $css_name . '?v=' . time();
	}
}
