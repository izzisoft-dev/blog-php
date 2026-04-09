<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    private const PER_PAGE = 3;

    public function show($slug): void
    {
        $sort    = in_array($_GET['sort'] ?? '', ['views', 'date']) ? $_GET['sort'] : 'date';
        $page    = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = self::PER_PAGE;

        $categoryModel = new Category();
        $posts         = $categoryModel->getBySlug($slug, $sort, $page, $perPage);
        $total         = $categoryModel->countPostsBySlug($slug);
        $totalPages    = (int) ceil($total / $perPage);

        $category = [
            'name'        => $posts[0]['category_name'] ?? '',
            'description' => $posts[0]['category_description'] ?? '',
        ];

        $this->view('category', [
            'posts'       => $posts,
            'category'    => $category,
            'sort'        => $sort,
            'slug'        => $slug,
            'page'        => $page,
            'totalPages'  => $totalPages,
        ]);
    }
}
