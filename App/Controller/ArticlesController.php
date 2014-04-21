<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Cake\Error\NotFoundException;

/**
 * CakePHP ArticlesController
 * @author madalin
 */
class ArticlesController extends AppController {
    public $components = ['Session'];

    public function index() {
        $articles = $this->Articles->find('all');
        $this->set(compact('articles'));
    }
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid article'));
        }
        
        $article = $this->Articles->get($id);
        
        $this->set(compact('article'));
    }

    public function add() {
        $article = $this->Articles->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Articles->save($article)) {
                $this->Session->setFlash(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Session->setFlash(__('Unable to add your article.'));
        }
        
        $this->set('article', $article);
    }
    
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid article'));
        }
        
        $article = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Session->setFlash(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Session->setFlash(__('Unable to update your article.'));
        }
        
        $this->set('article', $article);
    }
    
    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Session->setFlash(__('The article with id: %s has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
}
