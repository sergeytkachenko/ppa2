<?php
namespace Multiple\Frontend\Controllers;

use Groups;
use JsonController;
use Users;

class LoginController extends JsonController
{
	protected $_isJsonResponse = true;

	public function enterAction() {
		$login = $this->request->getPut('login');
		$password = $this->request->getPut('password');
		$groupId = $this->request->getPut('groupId');
		$user = Users::findFirstByLogin($login);
		if ($user) {
			$group = $this->getUserGroup($user->id, $groupId);
			if ($group and $this->security->checkHash($password . $user->salt, $user->password)) {
				$this->session->set('user', $user);
				$this->session->set('user.group', $group);
				return array(
					'user' => $user->fetchRelations(),
					'success' => true,
					'group' => $group ? $group->toArray() : array()
				);
			}
		}
		$this->response->setStatusCode(401, "Unauthorized");
		return array(
			'success' => false,
			'msg' => 'Invalid login or password'
		);
	}

	public function exitAction() {
		$this->session->destroy(true);
		return array(
			'success' => true,
			'msg' => 'User is exited'
		);
	}

	public function getGroupsAction() {
		return Groups::find('is_auth_possible = 1')->toArray();
	}

	/**
	 * Выбирает все группы пользователя.
	 * @param $userId
	 * @param $groupId
	 * @return \Phalcon\Mvc\Model\ResultsetInterface
	 */
	private function getUserGroup($userId, $groupId) {
		return Groups::query()
			->innerJoin('UsersGroups', 'Groups.id = ug.group_id', 'ug')
			->andWhere('ug.user_id = :userId: AND Groups.id = :groupId: AND Groups.is_auth_possible = 1')
			->bind(array('userId' => $userId, 'groupId' => $groupId))
			->execute()->getFirst();
	}
}

