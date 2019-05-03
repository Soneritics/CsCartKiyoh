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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $category;

    /**
     * @var double
     */
    private $totalScore;

    /**
     * @var int
     */
    private $totalReviews;

    /**
     * @var int
     */
    private $totalViews;

    /**
     * @var array
     */
    private $averageScores = [];

    /**
     * KiyohCompany constructor. Parses the array to objects.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->url = $data['url'];
        $this->category = $data['category']['title'];
        $this->totalScore = (double)$data['total_score'];
        $this->totalReviews = (int)$data['total_reviews'];
        $this->totalViews = (int)$data['total_views'];

        if (!empty($data['average_scores']['questions']['question'])) {
            foreach ($data['average_scores']['questions']['question'] as $question) {
                $this->averageScores[$question['id']] = $question['score'];
            }
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return float
     */
    public function getTotalScore(): float
    {
        return $this->totalScore;
    }

    /**
     * @return int
     */
    public function getTotalReviews(): int
    {
        return $this->totalReviews;
    }

    /**
     * @return int
     */
    public function getTotalViews(): int
    {
        return $this->totalViews;
    }

    /**
     * @return array
     */
    public function getAverageScores(): array
    {
        return $this->averageScores;
    }
}
