<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(): void
    {
        $category = new Category();
        $categories = $category->getWithLatestPosts();

        $this->view('home', ['categories' => $categories]);
    }

    public function category($slug): void
    {
        $posts = new Posts();
        $posts = $posts->getCategoryWithPosts($slug);

        $this->view('category', ['posts' => $posts]);
    }
}
