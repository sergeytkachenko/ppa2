<?php
namespace Multiple\Frontend\Controllers;

use Config;
use Feedback;
use JsonController;

class FeedbackController extends JsonController
{
	protected $_isJsonResponse = true;

	public function sendAction($viewUri = '/feedback/view/') {
		$feedback = $this->request->getPost('feedback');
		$feedback = json_decode($feedback);
		if ($feedback) {
			$data = array(
				'img' => $feedback->img,
				'note' => $feedback->note,
				'date' => date('Y-m-d H:i:s'),
				'html' => $feedback->html,
				'browser' => json_encode($feedback->browser),
				'url' => $feedback->url,
				'user_id' => @$this->session->get('user')->id
			);
			$feedbackModel = new Feedback();
			$feedbackModel->save($data);

			$config  = $this->di->get('config');
			$url = $config->get('application')->publicUrl . $this->url->getBaseUri() . $viewUri . $feedbackModel->id;

			$config = Config::findFirstByKey('feedback_emails');
			$emails = explode(',', $config->value);
			$subject = 'New feedback on site #' . $feedbackModel->id;
			$mail = $this->di->get('mail');
			$mail->send($emails, $subject, 'feedback', array('url' => $url, 'data' => $feedbackModel->toArray()));
		}
	}

	public function viewAction($id) {
		$this->_isJsonResponse = false;
		$this->view->setVar('title', 'Обращение №' . $id);
		$this->view->setVar('data', Feedback::findFirst($id));
	}
}

