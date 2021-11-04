<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper;

interface MyStockLoggerI
{

	public function logg(string $message, array $context = []);

}
