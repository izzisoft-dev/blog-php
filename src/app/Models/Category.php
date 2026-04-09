<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    protected string $table = 'categories';

    public function getWithLatestPosts(): array
    {
        $stmt = $this->db->query("
            SELECT DISTINCT c.id, c.name, c.slug, c.description
            FROM categories c
            INNER JOIN post_categories pc ON pc.category_id = c.id
            ORDER BY c.name
        ");
        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $stmtPosts = $this->db->prepare("
            SELECT p.id, p.title, p.slug, p.description, p.image, p.published_at
            FROM posts p
            INNER JOIN post_categories pc ON pc.post_id = p.id
            WHERE pc.category_id = ?
            ORDER BY p.published_at DESC
            LIMIT 3
        ");

        foreach ($categories as &$category) {
            $stmtPosts->execute([$category['id']]);
            $category['posts'] = $stmtPosts->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $categories;
    }

    public function getBySlug(string $slug, string $sort = 'date', int $page = 1, int $perPage = 6): array
    {
        $orderBy = $sort === 'views' ? 'p.views DESC' : 'p.published_at DESC';
        $offset  = ($page - 1) * $perPage;

        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name, c.description as category_description
            FROM posts p
            JOIN post_categories pc ON pc.post_id = p.id
            JOIN categories c ON pc.category_id = c.id
            WHERE c.slug = ?
            ORDER BY {$orderBy}
            LIMIT {$perPage} OFFSET {$offset}
        ");
        $stmt->execute([$slug]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countPostsBySlug(string $slug): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total
            FROM posts p
            JOIN post_categories pc ON pc.post_id = p.id
            JOIN categories c ON pc.category_id = c.id
            WHERE c.slug = ?
        ");
        $stmt->execute([$slug]);
        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }
}