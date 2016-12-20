<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/20/2016
 * Time: 8:30 AM
 */

namespace App\Services;

interface PhoneProviderService
{
    public function resolvePrefix($digit);
}