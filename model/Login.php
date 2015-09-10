<?php

namespace model;


class Login {
    
    private $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    public function getUser() {
        return $this->user;
    }
}