<?php
namespace Tipsy\Config;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

// Параметры конфигурации системы
abstract class Config
{
    //  Настройки сайта
    public static $siteName = 'Tipsy CMS';

    // Параметры подключения к базе данных
    public static $dbType = 'mysql';
    public static $db_host = '127.0.0.1';   // Note: Для локального хоста использовать IP а не localhost
    public static $db_user = 'tipsy';
    public static $db_password = 'tipsy';
    public static $db_dbname = 'tipsy';
    public static $db_port = '';
    public static $db_socket = '';

    // Ошибки и отладка (none, simple, maximum)
    public static $errorReporting = 'maximum';

    // Отладка системы (1 - да, 0 - нет)
    public static $debug = 1;

    // Отображение отладочной информации о шаблоне (пока реализовано только название позиций).
    // 1 - да, 0 - нет.
    // Смотреть \Tispy\Libraries\Position::getPosContent()
    #public static $tmplDebug = 0;

    // Настройки временной зоны
    public static $timezone = 'Europe/Moscow';

    // Внешний вид (шаблон)
    public static $template = 'Bootstraper';

    // Время жизни куку
    public static $sessionLifetime = 2;
}
