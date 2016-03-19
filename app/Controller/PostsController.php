<?php

class PostsController extends AppController {

    public function index() {

      $options = array('limit' => ''); // limitは一旦なしにする

      $this->set('posts', $this->Post->find('all', $options));

    }

}
