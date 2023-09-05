<?php

namespace App\Controllers;

use App\Models\ArticleModels;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Ausi\SlugGenerator\SlugGenerator;

class ArticleController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        return 'hahaha';
    }
    public function getAll()
    {
        //
        $data = new ArticleModels;
        foreach ($data->findAll() as $new_article) {
            // $data_article[] = $new_article;
            $reading_speed = 200;

            // Calculate the number of words in the article
            $word_count = str_word_count($new_article['content']);

            // Calculate the time required to read the article in minutes
            $reading_time = ceil($word_count / $reading_speed);
            $data_article[] = [
                'title' => $new_article['title'],
                'slug' => $new_article['slug'],
                'author' => $new_article['author'],
                'content' => $new_article['content'],
                'time' => $reading_time . ' mins'
            ];
        }
        return $this->respond([
            'data' => $data_article
        ], 200);
    }
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = 'null')
    {
        //
        $article = new ArticleModels;
        return $this->response->setJSON($article->where('slug', $id)->first());
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
        if (!$this->validate([
            'title'     => 'required|is_unique[article.title]',
            'author'     => 'required',
            'content'     => 'required',
        ])) {
            return $this->response->setJSON(
                [
                    'success' => false, 'data' => null,
                    "message" => \Config\Services::validation()->getErrors()
                ],
                400
            );
        }

        $generator = new SlugGenerator;
        $generator->generate($this->request->getVar('title'));
        try {
            //code...
            $article = new ArticleModels;

            $data = [
                'title' => $this->request->getVar('title'),
                'slug' => $generator->generate($this->request->getVar('title')),
                'author' =>  $this->request->getVar('author'),
                'content' =>  $this->request->getVar('content'),
                // 'created_at' => new \Datetime('now')
            ];
            $article->insert($data);
            return $this->response->setJSON(
                [
                    'success' => true, 'data' => $data,
                    "message" => 'Article Hasben Created'
                ],
                200
            );
        } catch (\Exception  $th) {
            //throw $th;
            return $this->response->setJSON(['error' => $th->getMessage()]);
        }
        // dd($this->request->getVar('title'));
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
        $article = new ArticleModels;

        return $this->response->setJSON($article->find($id));
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
        if (!$this->validate([
            'title'     => 'required|is_unique[article.title]',
            'author'     => 'required',
            'content'     => 'required',
        ])) {
            return $this->response->setJSON(
                [
                    'success' => false, 'data' => null,
                    "message" => \Config\Services::validation()->getErrors()
                ],
                400
            );
        }
        try {
            $generator = new SlugGenerator;
            $generator->generate($this->request->getVar('title'));
            $data = [
                'title' => $this->request->getVar('title'),
                'slug' => $generator->generate($this->request->getVar('title')),
                'author' =>  $this->request->getVar('author'),
                'content' =>  $this->request->getVar('content'),
                // 'updated_at' => new \Datetime('now')
            ];
            $article = new ArticleModels;

            $article->update($id, $data);
            return $this->response->setJSON(
                [
                    'success' => true, 'data' => $data,
                    "message" => 'Article Hasben Uptodate'
                ],
                200
            );
        } catch (\Exception  $th) {
            //throw $th;
            return $this->response->setJSON(['error' => $th->getMessage()]);
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        try {
            $article = new ArticleModels;

            $article->delete($id);

            return $this->response->setJSON(
                [
                    'success' => true,
                    "message" => 'Article Hasben Delete'
                ],
                200
            );
        } catch (\Exception  $th) {
            //throw $th;
            return $this->response->setJSON(['error' => $th->getMessage()]);
        }
    }
}
