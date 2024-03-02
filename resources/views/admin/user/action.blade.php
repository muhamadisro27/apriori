<x-action-wrapper :model="$model" :edit="route('admin.user.edit', $model->uuid)" :destroy="route('admin.user.destroy', $model->uuid)" />
