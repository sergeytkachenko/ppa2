<?php
namespace Multiple\Frontend\Controllers;

use Articles;

class LanguageController extends ControllerBase
{

	public function setLanguageAction() {
		$language = $this->request->get('language');
		$this->session->set('language', $language);
		$data = array(
			'success' => true,
			'language' => $language
		);
		$this->view->disable();
		$this->response->setContentType('application/json', 'UTF-8');
		echo json_encode($data);
	}

	public function getLanguageAction() {
		$language = $this->session->get('language');
		$data = array(
			'success' => true,
			'language' => $language ? $language : 'ru'
		);
		$this->view->disable();
		$this->response->setContentType('application/json', 'UTF-8');
		echo json_encode($data);
	}

	public function getTranslatesAction() {
		$translates = \Translations::find();
		$language = $this->request->get('language');
		$language = $language ? $language : 'ru';
		$translatesArray = array();
		foreach ($translates as $translate) {
			if ($text = $translate->$language) {
				$translatesArray[$translate->key] = $text;
			}
		}
		$this->view->disable();
		$this->response->setContentType('application/json', 'UTF-8');
		echo json_encode($translatesArray);
	}
}

