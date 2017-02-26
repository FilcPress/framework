<?php

namespace FilcPress\ACF\Options;

trait RoleOption
{
    protected $role = [];

    public function role($role)
    {
        $this->role = $role;

        return $this;
    }

    public function addRole($role)
    {
        $this->role[] = $role;

        return $this;
    }

    protected function getRole()
    {
        return [
            'role' => $this->role,
        ];
    }
}
