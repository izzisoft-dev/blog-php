{extends 'layout.tpl'}

{block name="content"}

<div class="category-header">
    <h1 class="category-header__title">{$category.name}</h1>
    <p class="category-header__description">{$category.description}</p>
</div>

<div class="category-toolbar">
    <span class="category-toolbar__label">Сортировка:</span>
    <div class="category-toolbar__sort">
        <a href="/category/{$slug}?sort=date"
           class="sort-btn{if $sort === 'date'} sort-btn--active{/if}">По дате</a>
        <a href="/category/{$slug}?sort=views"
           class="sort-btn{if $sort === 'views'} sort-btn--active{/if}">По просмотрам</a>
    </div>
</div>

<div class="posts-grid">
    {foreach $posts as $post}
    <article class="post-card">
        <a href="/post/{$post.slug}" class="post-card__image-link">
            {if $post.image}
                <img src="/uploads/{$post.image}" alt="{$post.title}" class="post-card__image">
            {else}
                <div class="post-card__image post-card__image--placeholder"></div>
            {/if}
        </a>
        <div class="post-card__body">
            <a href="/post/{$post.slug}" class="post-card__title">{$post.title}</a>
            <time class="post-card__date">{$post.published_at|date_format:'%B %d, %Y'}</time>
            <p class="post-card__description">{$post.description}</p>
            <div class="post-card__meta">
                <span class="post-card__views">{$post.views} просмотров</span>
                <a href="/post/{$post.slug}" class="post-card__read-more">Continue Reading</a>
            </div>
        </div>
    </article>
    {/foreach}
</div>

{if $totalPages > 1}
<nav class="pagination">
    {if $page > 1}
        <a href="/category/{$slug}?sort={$sort}&page={$page - 1}" class="pagination__btn">&laquo;</a>
    {/if}

    {for $i = 1 to $totalPages}
        <a href="/category/{$slug}?sort={$sort}&page={$i}"
           class="pagination__btn{if $i === $page} pagination__btn--active{/if}">{$i}</a>
    {/for}

    {if $page < $totalPages}
        <a href="/category/{$slug}?sort={$sort}&page={$page + 1}" class="pagination__btn">&raquo;</a>
    {/if}
</nav>
{/if}

{/block}
