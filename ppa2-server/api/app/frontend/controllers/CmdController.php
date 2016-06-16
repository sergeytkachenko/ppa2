<?php
namespace Multiple\Frontend\Controllers;

class CmdController extends ControllerBase
{
	public function restoreDbAction() {
		$dbPath = realpath(PUBLIC_PATH . '/../../db/');
		$importFile = realpath($dbPath . '/import.sh');
		$cmd = 'cd ' . $dbPath . ' && ' . $importFile . ' --restore-db';
		return array(
			'success' => true,
			'msg' => shell_exec($cmd),
			'cmd' => $cmd
		);
	}

	public function gitPullAction() {
		$projectPath = realpath(PUBLIC_PATH . '/../../');
		$cmd = 'cd ' . $projectPath . ' && git pull';
		return array(
			'success' => true,
			'msg' => shell_exec($cmd),
			'cmd' => $cmd
		);
	}

	public function composerUpdateAction() {
		$projectPath = realpath(PUBLIC_PATH . '/../../api/');
		$cmd = 'cd ' . $projectPath . ' && php composer.phar update';
		return array(
			'success' => true,
			'msg' => shell_exec($cmd),
			'cmd' => $cmd
		);
	}
}

