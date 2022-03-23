<?php

namespace Controllers;

use Models\Post;

class PostController extends BaseController
{
    public function create()
    {
        return view('post/create');
    }

    public function createPost()
    {
        #если пользователь не авторизирован
        if (!has_session('id'))
            return redirect('/');

        #Default занчение в переменной errors
        $errors = [];

        #проверка на существование
        if (!isset($_POST['name'])) $errors['name'][] = 'Поле не существует';
        if (!isset($_POST['keywords'])) $errors['keywords'][] = 'Поле не существует';
        if (!isset($_POST['description'])) $errors['description'][] = 'Поле не существует';

        #прверка на заполненность
        if (empty($_POST['name'])) $errors['name'][] = 'Поле не заполнено';
        if (empty($_POST['keywords'])) $errors['keywords'][] = 'Поле не заполнено';
        if (empty($_POST['description'])) $errors['description'][] = 'Поле не заполнено';

        #если ошибки существуют, отправляем их на клиента
        if($errors != [])
            return view('posts/create', compact('errors'));

        #помещаем масси суперглобальной переменнной $_POST в переменнную $inputs
        $inputs = $_POST;
        #Добавляем недостающий элемент пользовательского ID которому принадлежит
        $inputs['user_id'] = session('id');
        #Добавляем недостающий элемент сегодняшней даты и времени
        $inputs['create_at'] = date('d-m-Y H:i:s');

        $post = new Post();
        $post->create($inputs);

        #отправляем предоставленные
        return view('posts/create', ['success' => true]);

    }
}