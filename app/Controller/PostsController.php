<?php

class PostsController extends AppController {

  // 使用するヘルパーの記述
  public $helpers = array('Html', 'Form');


  public function index() {
    $options = array('limit' => ''); // limitは一旦なしにする
    $this->set('posts', $this->Post->find('all', $options));
  }


  public function show($id) {
    $this->set('post', $this->Post->findById($id));
  }
}
