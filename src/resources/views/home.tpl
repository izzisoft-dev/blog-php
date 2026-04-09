{extends 'layout.tpl'}

{block name="content"}

{foreach $categories as $category}
<section class="category-section">
    <div class="category-section__header">
        <h2 class="category-section__title">{$category.name|upper}</h2>
        <a href="/category/{$category.slug}" class="category-section__view-all">View All</a>
    </div>

    <div class="posts-grid">
        {foreach $category.posts as $post}
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
                <a href="/post/{$post.slug}" class="post-card__read-more">Continue Reading</a>
            </div>
        </article>
        {/foreach}
    </div>
</section>
{/foreach}

{/block}
