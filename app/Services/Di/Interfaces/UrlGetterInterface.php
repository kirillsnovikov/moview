<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Di\Interfaces;

/**
 * @author KNovikov
 */
interface UrlGetterInterface
{

    /**
     * @return array
     */
    public function getUrls(): array;
}
