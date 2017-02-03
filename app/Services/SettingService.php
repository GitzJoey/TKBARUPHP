<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/24/2016
 * Time: 2:02 PM
 */

namespace App\Services;

interface SettingService
{
    /**
     * Generate Default Settings.
     *
     * @return Collection settings.
     */
    public function generateDefaultSettingsIfNotExists($id);
}