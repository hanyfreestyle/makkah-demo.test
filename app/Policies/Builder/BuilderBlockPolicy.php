<?php

namespace App\Policies\Builder;

use App\Models\User;
use App\Models\Builder\BuilderBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuilderBlockPolicy {

  use HandlesAuthorization;

  public function viewAny(User $user): bool {
    return $user->can('view_any_builder::builder::blocks');
  }


  public function create(User $user): bool {
    return $user->can('create_builder::builder::blocks');
  }

  public function update(User $user, Model $model): bool {
    return $user->can('update_builder::builder::blocks');
  }

  public function updateSlug(User $user, Model $model): bool {
    return $user->can('update_slug_builder::builder::blocks');
  }

  public function delete(User $user, Model $model): bool {
    return $user->can('delete_builder::builder::blocks');
  }

  public function deleteAny(User $user): bool {
    return $user->can('delete_any_builder::builder::blocks');
  }

  public function forceDelete(User $user, Model $model): bool {
    return $user->can('force_delete_builder::builder::blocks');
  }

  public function forceDeleteAny(User $user): bool {
    return $user->can('force_delete_any_builder::builder::blocks');
  }

  public function restore(User $user, Model $model): bool {
    return $user->can('restore_builder::builder::blocks');
  }

  public function restoreAny(User $user): bool {
    return $user->can('restore_any_builder::builder::blocks');
  }

  public function replicate(User $user, Model $model): bool {
    return $user->can('replicate_builder::builder::blocks');
  }

  public function reorder(User $user): bool {
    return $user->can('reorder_builder::builder::blocks');
  }
}
