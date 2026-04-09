<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function show($slug): void
    {
        $postModel = new Post();
        $post = $postModel->getBySlug($slug);
        $related = $postModel->getRelatedPosts($post['id']);
        $postModel->incrementViews($post['id']);

        $this->view('post', ['post' => $post, 'related' => $related]);
    }
}
