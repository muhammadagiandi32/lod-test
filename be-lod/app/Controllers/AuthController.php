<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\JWTAuth;
use App\Models\UsersModels;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;
    public function login()
    {
        // $key = getenv('JWT_SECRET');
        // $payload = [
        //     'iss' => 'http://example.org',
        //     'aud' => 'http://example.com',
        //     'iat' => 1356999524,
        //     'nbf' => 1357000000
        // ];
        if (!$this->validate([
            'email'     => 'required',
            'password'     => 'required|min_length[6]',
        ])) {
            return $this->response->setJSON(['success' => false, 'data' => null, "message" => \Config\Services::validation()->getErrors()]);
        }

        $db = new UsersModels;
        $user  = $db->where('email', $this->request->getVar('email'))->first();
        // return $user;
        // dd($user);
        if ($user) {
            if (password_verify($this->request->getVar('password'), $user['password'])) {
                $jwt = new JWTAuth;
                $token = $jwt->token();
                // dd($token);
                return $this->response->setJSON(['token' => $token]);
                // return $token;
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'User not found'])->setStatusCode(409);
            }
        } else {

            return $this->response->setJSON(['success' => false, 'message' => 'User not found'])->setStatusCode(409);
        }
    }
}
