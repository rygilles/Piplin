<?php

/*
 * This file is part of Piplin.
 *
 * Copyright (C) 2016-2017 piplin.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::any('api/autocomplete/users', [
    'as'   => 'autocomplete.users',
    'uses' => 'Api\AutocompleteController@users',
]);

Route::any('api/autocomplete/cabinets', [
    'as'   => 'autocomplete.cabinets',
    'uses' => 'Api\AutocompleteController@cabinets',
]);
