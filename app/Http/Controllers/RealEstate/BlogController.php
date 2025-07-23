<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\RealEstate\BlogCategory;
use App\Models\RealEstate\BlogPost;
use App\Models\RealEstate\Projects;

class BlogController extends DefaultWebController {
    use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function __construct() {
        parent::__construct();
        self::LoadMainVar();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BlogList() {
        $posts = BlogPost::query()
            ->where('is_published', true)
            ->translatedIn()
            ->with('translation')
            ->with('category')
            ->with('developer')
            ->orderBy('id', 'desc')
            ->paginate(12);
        if ($posts->isEmpty()) {
            self::abortError404('Empty');
        }

        $popularPosts = BlogPost::query()
            ->where('is_published', true)
            ->translatedIn()
            ->inRandomOrder()
            ->take(5)
            ->get();

        $categories = BlogCategory::query()
            ->where('is_active', true)
            ->withCount('activePosts')
            ->orderBy('active_posts_count', 'desc')
            ->get();


        $meta = parent::getMeatByCatId('blog');
        parent::printSeoMeta($meta, 'page_blog');

        return view('real-estate.blog.index')->with([
            'meta' => $meta,
            'posts' => $posts,
            'popularPosts' => $popularPosts,
            'categories' => $categories,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BlogCatList($catSlug) {
        try {
            $category = BlogCategory::query()
                ->where('is_active', true)
                ->where('slug', $catSlug)
                ->with('translations')
                ->withCount([
                    'activePosts',
                    'uniquePostDevelopers as developers_count'
                ])
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('Blog');
        }

        parent::printSeoMeta($category, 'page_blogCatList');

        $posts = BlogPost::query()
            ->where('is_published', true)
            ->where('category_id', $category->id)
            ->with('category')
            ->translatedIn()
            ->orderBy('id', 'desc')
            ->paginate(12);


        $categories = BlogCategory::query()
            ->where('is_active', true)
            ->withCount('activePosts')
            ->orderBy('active_posts_count', 'desc')
            ->get();

        $popularPosts = BlogPost::query()
            ->where('is_published', true)
            ->translatedIn()
            ->inRandomOrder()
            ->take(5)
            ->get();


        if ($posts->isEmpty()) {
            self::abortError404('Empty');
        }

        return view('real-estate.blog.index_category')->with([
            'category' => $category,
            'posts' => $posts,
            'popularPosts' => $popularPosts,
            'categories' => $categories,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BlogView($catSlug, $postSlug) {
        try {
            $post = BlogPost::query()
                ->where('slug', $postSlug)
                ->with('location')
                ->with('translations')
                ->translatedIn()
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('Blog');
        }

        if (count($post->translations) == 1) {
            $pageView['go_home'] = route('page_index');
        }

        parent::printSeoMeta($post, 'page_blogView');

        try {
            $category = BlogCategory::query()
                ->where('is_active', true)
                ->where('slug', $catSlug)
                ->with('translations')
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('Blog');
        }


        if ($post->listing_id == null) {
            $project_tag = null;
        } else {
            $project_tag = Projects::query()
                ->where('id', $post->listing_id)
//                ->withCount('web_units')
//                ->with('locationName')
                ->translatedIn()
                ->first();
        }


        if ($post->location_id == null) {
            $relatedProjects = null;
        } else {
            $relatedProjects = Projects::query()
                ->where('location_id', $post->location_id)
                ->with('location')
                ->translatedIn()
                ->limit(9)
                ->get();
            if (count($relatedProjects) == 0) {
                $relatedProjects = null;
            }
        }

        $relatedPosts = BlogPost::query()
            ->where('category_id', $category->id)
            ->where('id', '!=', $post->id)
            ->with('category')
            ->translatedIn()
            ->orderBy('id', 'desc')
            ->limit('9')
            ->get();

        $otherProject = Projects::query()
            ->where('is_published', true)
            ->translatedIn()
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('real-estate.blog.view')->with([
            'post' => $post,
            'category' => $category,
            'project_tag' => $project_tag,
            'relatedProjects' => $relatedProjects,
            'relatedPosts' => $relatedPosts,
            'otherProject' => $otherProject,
        ]);
    }

}
