<?php

namespace App\Policies\LatestNews;

use App\Models\User;
use App\Models\LatestNews\LatestNews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class LatestNewsPolicy {

  use HandlesAuthorization;

  public function viewAny(User $user): bool {
    return $user->can('view_any_latest::news::latest::news');
  }

  public function viewAnyCategory(User $user): bool {
    return $user->can('view_any_category_latest::news::latest::news');
  }

  public function create(User $user): bool {
    return $user->can('create_latest::news::latest::news');
  }

  public function update(User $user, Model $model): bool {
    return $user->can('update_latest::news::latest::news');
  }

  public function updateSlug(User $user, Model $model): bool {
    return $user->can('update_slug_latest::news::latest::news');
  }

  public function delete(User $user, Model $model): bool {
    return $user->can('delete_latest::news::latest::news');
  }

  public function deleteAny(User $user): bool {
    return $user->can('delete_any_latest::news::latest::news');
  }

  public function forceDelete(User $user, Model $model): bool {
    return $user->can('force_delete_latest::news::latest::news');
  }

  public function forceDeleteAny(User $user): bool {
    return $user->can('force_delete_any_latest::news::latest::news');
  }

  public function restore(User $user, Model $model): bool {
    return $user->can('restore_latest::news::latest::news');
  }

  public function restoreAny(User $user): bool {
    return $user->can('restore_any_latest::news::latest::news');
  }

}
