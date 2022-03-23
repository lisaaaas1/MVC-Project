<?php
/*
 * Располагаются базовые функции доступные ото всюду
 */

#Отвечает за получение значений из session
function session($name) {
    return $_SESSION[$name];
}

#проверяет на существование элемента в session
function has_session($name) {
    return isset($_SESSION[$name]);
}

#записывает значение в session
function put_session($name, $value) {
    $_SESSION[$name] = $value;
}

#функция отвечающая за redirect (переход) на другую страницу
function redirect($url)
{
    return header('Location'.$url);
}