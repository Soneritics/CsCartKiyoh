<?php
/*
 * The MIT License
 *
 * Copyright 2018 Jordi Jolink.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Class KiyohCompany
 * A model class that does a little more than only being a model :-/
 * For CsCart this might be the best workaround, otherwise it's at least the easiest :-$
 */
class KiyohCompany
{
    /**
     * @var float
     */
    private $averageRating;

    /**
     * @var int
     */
    private $numberReviews;

    /**
     * @var float
     */
    private $percentageRecommendation;

    /**
     * @var string
     */
    private $locationName;

    /**
     * @var string
     */
    private $locationId;

    /**
     * KiyohCompany constructor. Parses the array to objects.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->averageRating = (double)$data['averageRating'];
        $this->numberReviews = (int)$data['numberReviews'];
        $this->percentageRecommendation = (double)$data['percentageRecommendation'];
        $this->locationName = $data['locationName'];
        $this->locationId = $data['locationId'];
    }

    /**
     * @return float
     */
    public function getAverageRating(): float
    {
        return $this->averageRating;
    }

    /**
     * @return int
     */
    public function getNumberReviews(): int
    {
        return $this->numberReviews;
    }

    /**
     * @return float
     */
    public function getPercentageRecommendation(): float
    {
        return $this->percentageRecommendation;
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->locationName;
    }

    /**
     * @return string
     */
    public function getLocationId(): string
    {
        return $this->locationId;
    }
}
