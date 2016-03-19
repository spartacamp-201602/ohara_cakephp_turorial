<?php

class PostsController extends AppController {

    // 使用するヘルパーの記述
    public $helpers = array('Html', 'Form');

    // 使用するコンポーネントの記述を追加
    public $components = array('Flash');

    public function index() {
        $options = array('limit' => ''); // limitは一旦なしにする
        $this->set('posts', $this->Post->find('all', $options));
    }


    public function show($id) {
        $this->set('post', $this->Post->findById($id));
    }

    public function add() {

        // POSTメソッドの確認
        // if ($_SERVER['REQUEST_METHOD'] === 'POST')と同じ
        if ($this->request->is('post')) {

            // 保存処理
            // if文も追加
            if ($this->Post->save($this->request->data)) {
                // 保存に成功

                // フラッシュメッセージ
                $this->Flash->success('新しい記事を追加しました！');

                // リダイレクト
                return $this->redirect(array('action' => 'index'));
            } else {
                // 保存に失敗
                $this->Flash->error('保存できませんでした...');
            }

        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
          throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Flash->error('記事'. $id .'を削除しました');

            return $this->redirect(array('action' => 'index'));
        }
    }

    public function edit($id) {
        $post = $this->Post->findById($id);
        $this->Post->id = $id;

        // レコードがない場合は例外を投げる
        if (!$post) {
           throw new NotFoundException('そんな記事は存在しませんよ〜');
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
              $this->Flash->success('記事の変更を保存しました');
              $this->redirect('action', 'index');
           } else {
              $this->Flash->error('記事を変更できませんでした');
           }
        }

        // データが送られてきていない時 -> URLでアクセスした時
        // 既存レコードを表示する
        // 隠しフォームにidがセットされている
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
}
