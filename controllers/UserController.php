<?php

class UserController extends Controller
{
  public function showUserProfile() {
    $this->view('user', ['showHeader' => false]);
  }
}