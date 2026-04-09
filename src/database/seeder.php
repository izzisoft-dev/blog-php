<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Core\Database;

$db = (new Database())->getConnection();

echo "Seeding started...\n";

// Очищаем таблицы перед заполнением
$db->exec("SET FOREIGN_KEY_CHECKS = 0");
$db->exec("TRUNCATE TABLE post_categories");
$db->exec("TRUNCATE TABLE posts");
$db->exec("TRUNCATE TABLE categories");
$db->exec("SET FOREIGN_KEY_CHECKS = 1");

// -------------------------------------------------------
// Категории
// -------------------------------------------------------

$categories = [
    [
        'name'        => 'Технологии',
        'slug'        => 'technologies',
        'description' => 'Статьи о новых технологиях, гаджетах и цифровом мире.',
    ],
    [
        'name'        => 'Программирование',
        'slug'        => 'programming',
        'description' => 'Туториалы, советы и лучшие практики разработки ПО.',
    ],
    [
        'name'        => 'Дизайн',
        'slug'        => 'design',
        'description' => 'UI/UX, графический дизайн и визуальные тренды.',
    ],
    [
        'name'        => 'Наука',
        'slug'        => 'science',
        'description' => 'Открытия, исследования и научные новости.',
    ],
];

$stmt = $db->prepare("INSERT INTO categories (name, slug, description) VALUES (?, ?, ?)");

$categoryIds = [];
foreach ($categories as $category) {
    $stmt->execute([$category['name'], $category['slug'], $category['description']]);
    $categoryIds[$category['slug']] = (int) $db->lastInsertId();
}

echo "Categories seeded: " . count($categories) . "\n";

// -------------------------------------------------------
// Статьи
// -------------------------------------------------------

$posts = [
    [
        'title'        => 'Введение в PHP 8.1',
        'slug'         => 'introduction-to-php-81',
        'description'  => 'Обзор новых возможностей PHP 8.1: fibers, enums и intersection types.',
        'content'      => 'PHP 8.1 принёс множество долгожданных возможностей. Enums позволяют объявлять перечисления прямо в языке, Fibers дают асинхронность без внешних библиотек, а intersection types делают систему типов ещё мощнее. В этой статье разберём каждую фичу с примерами кода.',
        'image'        => 'php-intro.jpg',
        'views'        => 342,
        'published_at' => '2025-01-10 10:00:00',
        'categories'   => ['programming', 'technologies'],
    ],
    [
        'title'        => 'Docker для начинающих',
        'slug'         => 'docker-for-beginners',
        'description'  => 'Как контейнеризировать своё приложение с нуля.',
        'content'      => 'Docker изменил то, как мы разрабатываем и деплоим приложения. В этой статье разберём базовые команды, создадим Dockerfile и docker-compose.yml для простого PHP-проекта. После прочтения вы сможете запустить любое приложение в контейнере.',
        'image'        => 'docker.jpg',
        'views'        => 198,
        'published_at' => '2025-01-15 12:00:00',
        'categories'   => ['technologies', 'programming'],
    ],
    [
        'title'        => 'Принципы чистого кода',
        'slug'         => 'clean-code-principles',
        'description'  => 'SOLID, DRY, KISS — принципы которые делают код читаемым.',
        'content'      => 'Чистый код — это не роскошь, а необходимость. SOLID помогает строить расширяемую архитектуру, DRY избавляет от дублирования, KISS напоминает не усложнять. Разберём каждый принцип на реальных примерах и поймём почему они важны.',
        'image'        => 'clean-code.jpg',
        'views'        => 521,
        'published_at' => '2025-02-01 09:00:00',
        'categories'   => ['programming'],
    ],
    [
        'title'        => 'Тренды UI дизайна 2025',
        'slug'         => 'ui-design-trends-2025',
        'description'  => 'Что актуально в дизайне интерфейсов в 2025 году.',
        'content'      => 'Glassmorphism уступает место более минималистичным подходам. Dark mode стал стандартом, micro-анимации улучшают UX, а AI-генерация контента меняет workflow дизайнеров. Разбираем каждый тренд с примерами.',
        'image'        => 'ui-design.jpg',
        'views'        => 287,
        'published_at' => '2025-02-10 14:00:00',
        'categories'   => ['design'],
    ],
    [
        'title'        => 'Открытие чёрной дыры в центре Млечного пути',
        'slug'         => 'black-hole-milky-way',
        'description'  => 'Учёные получили первое изображение Sgr A* — чёрной дыры нашей галактики.',
        'content'      => 'В 2022 году телескоп Event Horizon получил снимок сверхмассивной чёрной дыры Sgr A* в центре Млечного пути. Это стало вторым прямым изображением чёрной дыры после M87* в 2019 году. Объясняем как это удалось и что это значит для науки.',
        'image'        => 'black-hole.jpg',
        'views'        => 743,
        'published_at' => '2025-02-20 11:00:00',
        'categories'   => ['science'],
    ],
    [
        'title'        => 'Figma vs Sketch: что выбрать в 2025',
        'slug'         => 'figma-vs-sketch-2025',
        'description'  => 'Сравниваем два главных инструмента UI дизайна.',
        'content'      => 'Figma захватила рынок благодаря облачной работе и командному режиму. Sketch остался Mac-only но держит лояльную аудиторию. Разберём возможности, цены и кейсы когда что выбирать.',
        'image'        => 'figma.jpg',
        'views'        => 156,
        'published_at' => '2025-03-01 10:00:00',
        'categories'   => ['design', 'technologies'],
    ],
    [
        'title'        => 'Квантовые компьютеры: где мы сейчас',
        'slug'         => 'quantum-computers-2025',
        'description'  => 'Текущее состояние квантовых вычислений и перспективы.',
        'content'      => 'Google, IBM и другие компании активно развивают квантовые компьютеры. Что такое кубит, в чём преимущество перед классическими компьютерами и когда квантовые машины войдут в повседневность — разбираем в этой статье.',
        'image'        => 'quantum.jpg',
        'views'        => 412,
        'published_at' => '2025-03-10 15:00:00',
        'categories'   => ['science', 'technologies'],
    ],
    [
        'title'        => 'Паттерны проектирования в PHP',
        'slug'         => 'design-patterns-php',
        'description'  => 'Singleton, Factory, Observer — разбираем популярные паттерны.',
        'content'      => 'Паттерны проектирования — это проверенные решения типовых задач. Singleton гарантирует единственный экземпляр класса, Factory скрывает логику создания объектов, Observer реализует подписку на события. Разберём каждый с примерами на PHP.',
        'image'        => 'patterns.jpg',
        'views'        => 634,
        'published_at' => '2025-03-15 09:00:00',
        'categories'   => ['programming'],
    ],
];

$stmtPost = $db->prepare("
    INSERT INTO posts (title, slug, description, content, image, views, published_at)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmtPivot = $db->prepare("
    INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)
");

foreach ($posts as $post) {
    $stmtPost->execute([
        $post['title'],
        $post['slug'],
        $post['description'],
        $post['content'],
        $post['image'],
        $post['views'],
        $post['published_at'],
    ]);

    $postId = (int) $db->lastInsertId();

    foreach ($post['categories'] as $categorySlug) {
        $stmtPivot->execute([$postId, $categoryIds[$categorySlug]]);
    }
}

echo "Posts seeded: " . count($posts) . "\n";
echo "Done!\n";
