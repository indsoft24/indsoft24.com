<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Tag;
use App\Post;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@indsoft24.com',
            'password' => Hash::make('password123'),
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Articles about web development technologies and best practices',
                'color' => '#3498db',
                'is_active' => true,
            ],
            [
                'name' => 'Mobile Apps',
                'slug' => 'mobile-apps',
                'description' => 'Mobile application development guides and tutorials',
                'color' => '#e74c3c',
                'is_active' => true,
            ],
            [
                'name' => 'Software Solutions',
                'slug' => 'software-solutions',
                'description' => 'Custom software solutions and business applications',
                'color' => '#27ae60',
                'is_active' => true,
            ],
            [
                'name' => 'Technology News',
                'slug' => 'technology-news',
                'description' => 'Latest technology trends and industry news',
                'color' => '#f39c12',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create tags
        $tags = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Laravel PHP framework',
                'color' => '#ff2d20',
                'is_active' => true,
            ],
            [
                'name' => 'React',
                'slug' => 'react',
                'description' => 'React JavaScript library',
                'color' => '#61dafb',
                'is_active' => true,
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'description' => 'Vue.js progressive framework',
                'color' => '#4fc08d',
                'is_active' => true,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'PHP programming language',
                'color' => '#777bb4',
                'is_active' => true,
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'JavaScript programming language',
                'color' => '#f7df1e',
                'is_active' => true,
            ],
            [
                'name' => 'MySQL',
                'slug' => 'mysql',
                'description' => 'MySQL database management system',
                'color' => '#4479a1',
                'is_active' => true,
            ],
            [
                'name' => 'API',
                'slug' => 'api',
                'description' => 'Application Programming Interface',
                'color' => '#00d4aa',
                'is_active' => true,
            ],
            [
                'name' => 'Mobile',
                'slug' => 'mobile',
                'description' => 'Mobile development',
                'color' => '#007aff',
                'is_active' => true,
            ],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        // Create sample posts
        $posts = [
            [
                'title' => 'Getting Started with Laravel 10: A Complete Guide',
                'slug' => 'getting-started-with-laravel-10-complete-guide',
                'excerpt' => 'Learn the fundamentals of Laravel 10 and build your first web application with this comprehensive guide.',
                'content' => '<h2>Introduction to Laravel 10</h2><p>Laravel 10 is the latest version of the popular PHP framework that makes web development elegant and enjoyable. In this comprehensive guide, we\'ll walk you through everything you need to know to get started with Laravel 10.</p><h3>What\'s New in Laravel 10</h3><p>Laravel 10 introduces several exciting features and improvements that make development even more efficient:</p><ul><li>Improved performance and speed</li><li>Enhanced security features</li><li>Better developer experience</li><li>Updated dependencies and packages</li></ul><h3>Setting Up Your Development Environment</h3><p>Before you can start building with Laravel 10, you\'ll need to set up your development environment. Here\'s what you\'ll need:</p><ol><li>PHP 8.1 or higher</li><li>Composer (PHP dependency manager)</li><li>A web server (Apache or Nginx)</li><li>A database (MySQL, PostgreSQL, or SQLite)</li></ol><h3>Creating Your First Laravel Application</h3><p>Once your environment is set up, creating a new Laravel application is simple:</p><pre><code>composer create-project laravel/laravel my-app</code></pre><p>This command will create a new Laravel application in the "my-app" directory with all the necessary files and dependencies.</p><h3>Understanding the Laravel Structure</h3><p>Laravel follows the MVC (Model-View-Controller) architectural pattern. Here\'s a brief overview of the main directories:</p><ul><li><strong>app/</strong> - Contains your application logic</li><li><strong>resources/views/</strong> - Contains your Blade templates</li><li><strong>routes/</strong> - Contains your application routes</li><li><strong>database/</strong> - Contains migrations and seeders</li></ul><h3>Conclusion</h3><p>Laravel 10 is a powerful and flexible framework that can help you build robust web applications quickly and efficiently. With its elegant syntax and comprehensive feature set, it\'s an excellent choice for both beginners and experienced developers.</p>',
                'category_id' => 1,
                'status' => 'published',
                'is_featured' => true,
                'meta_title' => 'Getting Started with Laravel 10: Complete Guide | Indsoft24',
                'meta_description' => 'Learn Laravel 10 from scratch with our comprehensive guide. Build your first web application with the latest PHP framework.',
                'user_id' => $admin->id,
                'published_at' => now()->subDays(5),
                'views_count' => 1250,
                'likes_count' => 45,
            ],
            [
                'title' => 'Building Responsive Mobile Apps with React Native',
                'slug' => 'building-responsive-mobile-apps-react-native',
                'excerpt' => 'Discover how to create cross-platform mobile applications using React Native and best practices for responsive design.',
                'content' => '<h2>Introduction to React Native</h2><p>React Native is a powerful framework that allows you to build native mobile applications using JavaScript and React. It enables you to create apps for both iOS and Android platforms with a single codebase.</p><h3>Why Choose React Native?</h3><p>React Native offers several advantages for mobile app development:</p><ul><li>Cross-platform development</li><li>Native performance</li><li>Large community support</li><li>Hot reloading for faster development</li><li>Reusable components</li></ul><h3>Setting Up React Native</h3><p>To get started with React Native development, you\'ll need to install the necessary tools:</p><ol><li>Node.js and npm</li><li>React Native CLI</li><li>Android Studio (for Android development)</li><li>Xcode (for iOS development)</li></ol><h3>Creating Your First App</h3><p>Create a new React Native project using the CLI:</p><pre><code>npx react-native init MyApp</code></pre><h3>Best Practices for Responsive Design</h3><p>When building mobile apps, it\'s crucial to ensure they work well on different screen sizes:</p><ul><li>Use Flexbox for layout</li><li>Implement responsive images</li><li>Test on multiple devices</li><li>Consider different orientations</li></ul><h3>Conclusion</h3><p>React Native is an excellent choice for building mobile applications that need to run on multiple platforms while maintaining native performance and user experience.</p>',
                'category_id' => 2,
                'status' => 'published',
                'is_featured' => true,
                'meta_title' => 'Building Responsive Mobile Apps with React Native | Indsoft24',
                'meta_description' => 'Learn how to build cross-platform mobile apps with React Native. Complete guide with best practices and examples.',
                'user_id' => $admin->id,
                'published_at' => now()->subDays(3),
                'views_count' => 980,
                'likes_count' => 32,
            ],
            [
                'title' => 'Custom Software Solutions for Modern Businesses',
                'slug' => 'custom-software-solutions-modern-businesses',
                'excerpt' => 'Explore how custom software solutions can transform your business operations and improve efficiency.',
                'content' => '<h2>The Importance of Custom Software</h2><p>In today\'s competitive business environment, off-the-shelf software often falls short of meeting specific business needs. Custom software solutions provide tailored functionality that aligns perfectly with your business processes.</p><h3>Benefits of Custom Software Development</h3><p>Custom software offers several advantages:</p><ul><li>Tailored to your specific needs</li><li>Scalable and flexible</li><li>Better integration with existing systems</li><li>Competitive advantage</li><li>Cost-effective in the long run</li></ul><h3>Types of Custom Software Solutions</h3><p>We specialize in various types of custom software development:</p><ol><li><strong>Web Applications</strong> - Custom web-based solutions</li><li><strong>Mobile Applications</strong> - iOS and Android apps</li><li><strong>Desktop Applications</strong> - Windows, macOS, and Linux</li><li><strong>API Development</strong> - RESTful and GraphQL APIs</li><li><strong>Database Solutions</strong> - Custom database design</li></ol><h3>Our Development Process</h3><p>Our proven development process ensures successful project delivery:</p><ul><li>Requirements analysis</li><li>System design and architecture</li><li>Development and testing</li><li>Deployment and maintenance</li><li>Ongoing support</li></ul><h3>Case Studies</h3><p>We have successfully delivered custom software solutions for various industries including healthcare, finance, e-commerce, and manufacturing.</p><h3>Conclusion</h3><p>Custom software solutions can significantly improve your business operations and provide a competitive edge. Contact us to discuss your specific requirements.</p>',
                'category_id' => 3,
                'status' => 'published',
                'is_featured' => false,
                'meta_title' => 'Custom Software Solutions for Modern Businesses | Indsoft24',
                'meta_description' => 'Discover how custom software solutions can transform your business. Expert development services for all industries.',
                'user_id' => $admin->id,
                'published_at' => now()->subDays(1),
                'views_count' => 750,
                'likes_count' => 28,
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create($postData);
            
            // Attach random tags to posts
            $randomTags = Tag::inRandomOrder()->limit(rand(2, 4))->pluck('id');
            $post->tags()->attach($randomTags);
        }

        $this->command->info('Blog data seeded successfully!');
        $this->command->info('Admin user created: admin@indsoft24.com / password123');
    }
}