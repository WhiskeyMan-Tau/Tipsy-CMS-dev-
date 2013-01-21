<?php
namespace Tipsy\Libraries;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Класс работы с ошибками.
 */
abstract class Errors
{
	/**
	 * @var	array	Массив содержащий ошибки системы.
	 */
	public static $errors = array();


	/**
	 * Метод построчно выводящий сообщения об ошибках на страницу.
	 *
	 */
	public static function getErrors()
	{
		foreach(self::$errors as $error){
			echo $error . '<p>';
		}
		
	}
}

/**
 * Класс обработчика исключений во время работы
 *
 */
class RuntimeException extends \ErrorException
{
	/**
	 * Конструктор, используется для установки всех необходимых свойств и методов объекта исключений
	 *
	 * @param	string 	$message  Текст исключения
	 * @param	int		$code
	 *
	 */
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
		
		// Добовляет ошибку в список ошибок.
		TErrors::$errors[] = $this->getMessage();

		// Логирует ошибку
		TLogger::WriteLogs($this->getMessage());
	}
}

class PdoException extends  \PDOException
{
    /**
     * Конструктор, используется для установки всех необходимых свойств и методов объекта исключений
     *
     * @param	string 	$message  Текст исключения
     * @param	int			$code
     *
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);

		// Добовляет ошибку в список ошибок.
		TErrors::$errors[] = $this->getMessage();

		// Логирует ошибку
		TLogger::WriteLogs($this->getMessage());
	}
}

/**
 * Класс обработчика ошибок которые нельзя логировать.
 *
 */
class FatalErrorException extends \ErrorException
{
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);

		// Логирует ошибку
		Errors::$errors[] = $this->getMessage();
	}
}

?>