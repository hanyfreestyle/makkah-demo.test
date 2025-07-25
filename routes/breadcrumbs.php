<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
  $trail->push(__('web/def.menu.home'), route('web.index'));
});

Breadcrumbs::for('about_us', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(__('web/def.menu.about_us'), route('web.about_us'));
});

Breadcrumbs::for('contact_us', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(__('web/def.menu.contact_us'), route('web.contact_us'));
});

Breadcrumbs::for('latest_news', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(__('web/def.menu.latest_news'), route('web.latest_news'));
});

Breadcrumbs::for('latest_news_view', function (BreadcrumbTrail $trail, $news) {
  $trail->parent('latest_news');
  $trail->push($news->name, route('web.latest_news_view', $news->slug));
});


Breadcrumbs::for('our_projects', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(__('web/def.menu.our_project'), route('web.our_projects'));
});

Breadcrumbs::for('project_view', function (BreadcrumbTrail $trail, $project) {
  $trail->parent('our_projects');
  $trail->push($project->name, route('web.project_view', $project->slug));
});



//
//Breadcrumbs::for('post_view', function (BreadcrumbTrail $trail, $Category, $Post) {
//  $trail->parent('blog');
//  $trail->push($Category->name, route('page_blogCatList', $Category->slug));
//  $trail->push($Post->name, route('page_blogCatList', $Post->slug));
//});
//
//Breadcrumbs::for('CompoundsList', function (BreadcrumbTrail $trail) {
//  $trail->parent('home');
//  $trail->push(__('webLang/header.menu_compounds'), route('page_compounds'));
//});
//
//Breadcrumbs::for('LocationView', function (BreadcrumbTrail $trail, $trees) {
//  $trail->parent('CompoundsList');
//  foreach ($trees as $tree) {
//    $trail->push($tree->name, route('page_locationView', $tree->slug));
//  }
//});
//
//Breadcrumbs::for('ProjectView', function (BreadcrumbTrail $trail, $trees, $unit) {
//  $trail->parent('CompoundsList');
//  foreach ($trees as $tree) {
//    $trail->push($tree->name, route('page_locationView', $tree->slug));
//  }
//  $trail->push($unit->name ?? '', route('page_ListView', $unit->slug));
//});



