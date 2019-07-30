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
 * Class KiyohReviews
 * A model class that does a little more than only being a model :-/
 * For CsCart this might be the best workaround, otherwise it's at least the easiest :-$
 */
class KiyohReviewResult
{
    /**
     * @var array
     */
    private $reviews = [];

    /**
     * @var KiyohCompany
     */
    private $company;

    /**
     * KiyohReviewResult constructor. Also parses the array values to objects.
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->company = new KiyohCompany($data);

        if (!empty($data['reviews']['reviews'])) {
            foreach ($data['reviews']['reviews'] as $review) {
                $this->reviews[$review['reviewId']] = new KiyohReview($review);
            }
        }
    }

    /**
     * @return KiyohCompany
     */
    public function getCompany(): KiyohCompany
    {
        return $this->company;
    }

    /**
     * @return array
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }
}
