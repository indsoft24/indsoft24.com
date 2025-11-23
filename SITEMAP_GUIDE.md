# Sitemap Generation Guide

## How Your Sitemap Works

Your Laravel application has a **dynamic sitemap system** that automatically generates XML sitemaps for search engines. The sitemaps are generated on-demand and cached for 24 hours for performance.

## Sitemap Structure

Your sitemap uses a **sitemap index** pattern, which means:

1. **Main Sitemap Index**: `https://yourdomain.com/sitemap.xml`
   - This is the entry point that lists all other sitemaps
   - Submit this URL to Google Search Console

2. **Individual Sitemaps** (automatically included in the index):
   - `/sitemap-static.xml` - Static pages (home, about, services, etc.)
   - `/sitemap-posts-{page}.xml` - Blog posts (paginated if >50,000)
   - `/sitemap-categories.xml` - Blog categories
   - `/sitemap-tags.xml` - Blog tags
   - `/sitemap-projects.xml` - Project pages
   - `/sitemap-pages-{page}.xml` - CMS pages (paginated if >50,000)
   - `/sitemap-states.xml` - State pages and state cities pages
   - `/sitemap-cities-{page}.xml` - City pages and city areas pages (paginated if >50,000)
   - `/sitemap-areas-{page}.xml` - Area pages (paginated if >50,000)

## How to Access Your Sitemap

### 1. View the Main Sitemap Index
Visit: `https://yourdomain.com/sitemap.xml`

This will show you all the sitemap files that are included.

### 2. View Individual Sitemaps
You can access any individual sitemap directly:
- `https://yourdomain.com/sitemap-static.xml`
- `https://yourdomain.com/sitemap-states.xml`
- `https://yourdomain.com/sitemap-pages-1.xml`
- etc.

### 3. Test in Browser
Simply open the URLs in your browser to see the XML output.

## What's Included in Each Sitemap

### Static Pages Sitemap
- Homepage
- About Us, Team, Career pages
- Service pages (Web Development, App Development, etc.)
- Blog listing page
- Projects listing page
- Legal pages (Privacy, Terms, Cookie Policy)
- CMS States listing page
- CMS Search page

### States Sitemap
- All active state pages: `/cms/state/{state-name}`
- All state cities pages: `/cms/state/{state-name}/cities`

### Cities Sitemap
- All active city pages: `/cms/city/{city-name}`
- All city areas pages: `/cms/city/{city-name}/areas`

### Areas Sitemap
- All active area pages: `/cms/area/{area-slug}`

### CMS Pages Sitemap
- All published CMS pages: `/cms/page/{page-slug}`

### Blog Sitemaps
- All published blog posts
- All active categories
- All active tags

### Projects Sitemap
- All published projects

## Caching

- Sitemaps are **cached for 24 hours** (1440 minutes)
- Cache is automatically cleared when you call the `clearCache()` method
- After cache expires, sitemaps are regenerated on next request

## Clearing Sitemap Cache

If you need to regenerate sitemaps immediately (e.g., after adding new content):

### Option 1: Via Artisan Command (if you create one)
```bash
php artisan sitemap:clear
```

### Option 2: Via Controller Method
You can access: `https://yourdomain.com/admin/sitemap/clear` (if you add this route)

### Option 3: Programmatically
```php
use App\Services\SitemapService;

$sitemapService = app(SitemapService::class);
$sitemapService->clearCache();
```

## Submitting to Search Engines

### Google Search Console
1. Go to [Google Search Console](https://search.google.com/search-console)
2. Select your property
3. Go to **Sitemaps** in the left menu
4. Enter: `sitemap.xml`
5. Click **Submit**

### Bing Webmaster Tools
1. Go to [Bing Webmaster Tools](https://www.bing.com/webmasters)
2. Select your site
3. Go to **Sitemaps**
4. Submit: `https://yourdomain.com/sitemap.xml`

## Automatic Updates

The sitemap automatically includes:
- ✅ New published pages
- ✅ New published blog posts
- ✅ New states, cities, and areas
- ✅ Updated content (lastmod dates)

## Performance Features

1. **Pagination**: Large sitemaps are automatically split into multiple files (max 50,000 URLs per file)
2. **Caching**: 24-hour cache reduces database load
3. **Efficient Queries**: Only selects necessary columns from database
4. **Memory Efficient**: Uses chunking for large datasets

## Troubleshooting

### Sitemap Not Updating
- Clear the cache using one of the methods above
- Wait for cache to expire (24 hours)
- Check that your content is marked as "published" or "active"

### Missing Pages
- Ensure pages have `status = 'published'` (for CMS pages)
- Ensure states/cities/areas have `status = 1` (active)
- Check that routes are properly configured

### URL Format Issues
- States use: `/cms/state/{state-name}` (URL encoded)
- Cities use: `/cms/city/{city-name}` (URL encoded)
- Areas use: `/cms/area/{area-slug}` (slug format)
- Pages use: `/cms/page/{page-slug}` (slug format)

## Testing Your Sitemap

1. **Validate XML**: Use [XML Sitemap Validator](https://www.xml-sitemaps.com/validate-xml-sitemap.html)
2. **Check in Browser**: Open `https://yourdomain.com/sitemap.xml` in browser
3. **Google Search Console**: Submit and check for errors
4. **Test Individual URLs**: Click through some URLs in the sitemap to ensure they work

## Notes

- The sitemap is **dynamically generated** - no need to manually create XML files
- URLs are automatically URL-encoded for proper formatting
- Last modification dates are included for better SEO
- Priority and change frequency are set appropriately for each content type
- The system handles millions of pages efficiently through pagination

