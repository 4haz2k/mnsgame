<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://mnsgame.ru</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfMonth()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://mnsgame.ru/offer</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfMonth()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://mnsgame.ru/games</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfWeek()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://mnsgame.ru/servers</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfDay()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://mnsgame.ru/promote</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfMonth()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://mnsgame.ru/support</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfMonth()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://mnsgame.ru/support/faq</loc>
        <lastmod>{{ \Carbon\Carbon::now()->startOfMonth()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
