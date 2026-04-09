<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model {

    protected string $table = 'posts';

    public function getBySlug($slug): array {
        $stmt = $this->db->prepare("
            SELECT p.*
            FROM posts p
            WHERE p.slug = ?
        ");
        $stmt->execute([$slug]);
        $post = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $post;
    }

    public function getRelatedPosts(int $postId): array {
        $stmt = $this->db->prepare("
            SELECT DISTINCT p.id, p.title, p.slug, p.image, p.published_at, p.views
            FROM posts p
            JOIN post_categories pc ON pc.post_id = p.id
            WHERE pc.category_id IN (
                SELECT category_id FROM post_categories WHERE post_id = ?
            )
            AND p.id != ?
            LIMIT 3
        ");
        $stmt->execute([$postId, $postId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function incrementViews(int $postId): void {
        $stmt = $this->db->prepare("
            UPDATE posts p
            SET views = views + 1
            WHERE p.id = ?
        ");
        $stmt->execute([$postId]);
    }
    
}