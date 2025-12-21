@if(isset($blogPosts) && $blogPosts->count() > 0)
<section class="py-5 bg-light mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">
                    <i class="fas fa-blog text-primary me-2"></i>Latest Blog Articles
                </h2>
            </div>
        </div>
        <div class="row">
            @foreach($blogPosts as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($post->featured_image)
                        <img src="{{ asset($post->featured_image) }}" 
                             class="card-img-top" 
                             alt="{{ $post->title }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" 
                             style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-image fa-3x text-white opacity-50"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            @if($post->category)
                                <span class="badge" style="background-color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            @if($post->is_featured)
                                <span class="badge bg-warning ms-2">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            @endif
                        </div>
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $post) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted flex-grow-1" style="line-height: 1.6; word-wrap: break-word; overflow-wrap: break-word;">
                            {{ Str::limit(strip_tags($post->excerpt), 120) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $post->published_at->format('M d, Y') }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>
                                {{ number_format($post->views_count) }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-right me-2"></i>View All Blog Posts
                </a>
            </div>
        </div>
    </div>
</section>
@endif

