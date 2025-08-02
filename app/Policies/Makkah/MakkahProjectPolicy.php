<?php

namespace App\Policies\Makkah;

use App\Models\User;
use App\Models\Makkah\MakkahProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class MakkahProjectPolicy {

  use HandlesAuthorization;

  public function viewAny(User $user): bool {
    return $user->can('view_any_makkah::makkah::project');
  }

  public function create(User $user): bool {
    return $user->can('create_makkah::makkah::project');
  }

  public function update(User $user, Model $model): bool {
    return $user->can('update_makkah::makkah::project');
  }

  public function updateSlug(User $user, Model $model): bool {
    return $user->can('update_slug_makkah::makkah::project');
  }

  public function delete(User $user, Model $model): bool {
    return $user->can('delete_makkah::makkah::project');
  }

  public function deleteAny(User $user): bool {
    return $user->can('delete_any_makkah::makkah::project');
  }

  public function forceDelete(User $user, Model $model): bool {
    return $user->can('force_delete_makkah::makkah::project');
  }

  public function forceDeleteAny(User $user): bool {
    return $user->can('force_delete_any_makkah::makkah::project');
  }

  public function restore(User $user, Model $model): bool {
    return $user->can('restore_makkah::makkah::project');
  }

  public function restoreAny(User $user): bool {
    return $user->can('restore_any_makkah::makkah::project');
  }


}
