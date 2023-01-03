<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($games as $game)
        <url>
            <loc>https://mnsgame.ru/games/{{ $game->short_link }}</loc>
            <lastmod>{{ \Carbon\Carbon::now()->startOfMonth()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
