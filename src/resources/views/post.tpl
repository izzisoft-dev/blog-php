{extends 'layout.tpl'}

{block name="content"}

<article class="post">
    {if $post.image}
        <img src="/uploads/{$post.image}" alt="{$post.title}" class="post__image">
    {/if}

    <div class="post__header">
        <h1 class="post__title">{$post.title}</h1>
        <div class="post__meta">
            <time class="post__date">{$post.published_at|date_format:'%B %d, %Y'}</time>
            <span class="post__views">{$post.views} просмотров</span>
        </div>
        <p class="post__description">{$post.description}</p>
    </div>

    <div class="post__content">
        {$post.content}
    </div>
</article>

{if $related}
<section class="related">
    <h2 class="related__title">Related Posts</h2>
    <div class="posts-grid">
        {foreach $related as $item}
        <article class="post-card">
            <a href="/post/{$item.slug}" class="post-card__image-link">
                {if $item.image}
                    <img src="/uploads/{$item.image}" alt="{$item.title}" class="post-card__image">
                {else}
                    <div class="post-card__image post-card__image--placeholder"></div>
                {/if}
            </a>
            <div class="post-card__body">
                <a href="/post/{$item.slug}" class="post-card__title">{$item.title}</a>
                <time class="post-card__date">{$item.published_at|date_format:'%B %d, %Y'}</time>
                <span class="post-card__views">{$item.views} просмотров</span>
            </div>
        </article>
        {/foreach}
    </div>
</section>
{/if}

{/block}
