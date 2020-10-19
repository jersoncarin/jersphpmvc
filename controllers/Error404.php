<?php

class Error404 extends Controller
{
	public function index()
	{
		$this->load("model","Home_Model");
		$this->view->settings = $this->model->get_settings();
		$this->theme = $this->model->get_themes($this->view->settings["theme_id"]);

		$theme_path = 'themes/' . $this->theme["theme_package"];
		$this->view->themes = $theme_path;

		$this->view->render($theme_path . '/error/index');
	}
}
