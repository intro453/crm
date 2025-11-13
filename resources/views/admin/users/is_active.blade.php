@if ($user->is_active)
    <span class="badge bg-success">Активен</span>
@else
    <span class="badge bg-danger">Заблокирован</span>
@endif
