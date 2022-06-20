<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class SliderHome implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(1200, 420);
    }
}