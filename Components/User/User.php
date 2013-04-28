<?php
namespace Tipsy\Components\User;

use Tipsy\Libraries\Loader;
use Tipsy\Components\User\UserLogin;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();
/**
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 17:32
 */
abstract class User
{
	/**
	 * Метод инициализации. Проверяет состояние пользователей.
	 *
	 */
	public static function init($param='')
	{

		if(!empty($param)){
			self::$param();
		}
		// Проверяет нет ли авторизованных пользователей
		if(!isset($_SESSION['user'])){
			return "<a href=\"?com=user&param=login\">Вход </a>" .
				"<a href=\"?com=user&param=test\"> Регистрация</a>".
				"<a href=\"?comt=user&param=test\"> test</a>";
		}else{
			Loader::autoload('\Components\User\UserLogout');
			echo "Привет  ". $_SESSION['user'] . "<a href=\"?component=\\Components\\User\\UserLogout\">Выйти</a>";
			return true;
		}
	}

	protected static function getTemplate($tmpl = 'tmpl_default.php')
	{
		$tmpl = require_once __DIR__ . DIRECTORY_SEPARATOR .'tmpl'. DIRECTORY_SEPARATOR . $tmpl;

	}

	/**
	 * Метод выполняющий авторизацию пользователя (перенаправляет на класс авторизации)
	 */
	public static function login()
	{
		// Подключает шаблон формы авторизации пользоватея.
		self::getTemplate();
		if(empty($_POST['name'])){

			return 'Для авторизации необходимо ввести имя пользователя.';
			#return false;
		}

		//Создает которткие имена переменных формы.
		$user =  $_POST['name'];
		$password = $_POST['password'];
		// Строка запроса к БД, выбирающая данные о пользователе.
		$query = "SELECT `username`, `password` FROM `users` WHERE username = \"" . $user . "\";";

		$table = Query::query($query);
		Session::start($table['username']);


		header("Location: ./");
		echo 'Вы вошли как: ' . $_SESSION['user'];
		return true;
	}
}