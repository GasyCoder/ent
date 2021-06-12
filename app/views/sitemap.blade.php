<?php header('Content-type: application/xml; charset="UTF-8"',true); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

        <url>
            <loc>{{ url() }}</loc>
            <priority>1</priority>
        </url>

        <url>
            <loc>{{ url() }}/contact</loc>
            <priority>0.5</priority>
        </url>

        <url>
            <loc>{{ url() }}/login</loc>
            <priority>0.1</priority>
        </url>

        @foreach($pages as $page)
        <url>
            <loc>{{ URL::route('page', ['id'=>$page->id, 'slug'=>$page->slug]) }}</loc>
            <priority>0.7</priority>
        </url>
        @endforeach


        @foreach($categories as $category)              
            <url>
                <loc>{{ URL::route('category', ['id'=>$category->id, 'slug'=>$category->slug ]) }}</loc>
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>
            </url>
        @endforeach


        @foreach($articles as $article)
            <url>
                <loc>{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}</loc>
                <lastmod>{{ substr($article->created_at, 0, 10) }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach


        


</urlset>