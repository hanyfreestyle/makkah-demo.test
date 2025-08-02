<?php

namespace App\Policies\Builder;

use App\Models\User;
use App\Models\Builder\BuilderPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuilderPagePolicy {

  use HandlesAuthorization;

  public function viewAny(User $user): bool {
    return $user->can('view_any_builder::builder::page');
  }


  public function create(User $user): bool {
    return $user->can('create_builder::builder::page');
  }

  public function update(User $user, Model $model): bool {
    return $user->can('update_builder::builder::page');
  }

  public function updateSlug(User $user, Model $model): bool {
    return $user->can('update_slug_builder::builder::page');
  }

  public function delete(User $user, Model $model): bool {
    return $user->can('delete_builder::builder::page');
  }

  public function deleteAny(User $user): bool {
    return $user->can('delete_any_builder::builder::page');
  }

  public function forceDelete(User $user, Model $model): bool {
    return $user->can('force_delete_builder::builder::page');
  }

  public function forceDeleteAny(User $user): bool {
    return $user->can('force_delete_any_builder::builder::page');
  }

  public function restore(User $user, Model $model): bool {
    return $user->can('restore_builder::builder::page');
  }

  public function restoreAny(User $user): bool {
    return $user->can('restore_any_builder::builder::page');
  }

  public function replicate(User $user, Model $model): bool {
    return $user->can('replicate_builder::builder::page');
  }

  public function reorder(User $user): bool {
    return $user->can('reorder_builder::builder::page');
  }
}
