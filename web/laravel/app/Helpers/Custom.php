<?php

use App\Admin;
use App\User;

function getAdminFromId($id)
{
    return Admin::find($id);
}

function getAdminApiToken($id)
{
    try {
        return getAdminFromId($id)->api_token;
    } catch (\Throwable $th) {
        return null;
    }
}

function getUserFromId($id)
{
    return User::find($id);
}

function getUserApiToken($id)
{
    try {
        return getUserFromId($id)->api_token;
    } catch (\Throwable $th) {
        return null;
    }
}
