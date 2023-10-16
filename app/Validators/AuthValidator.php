<?php

namespace FrameworkSimas\Validators;

class AuthValidator
{
    public function validate($data)
    {
        if (empty($data['email'])) {
            return 'Email is required.';
        }

        if (empty($data['password'])) {
            return 'Password is required.';
        }

        return 'Validation successful.';
    }
}
