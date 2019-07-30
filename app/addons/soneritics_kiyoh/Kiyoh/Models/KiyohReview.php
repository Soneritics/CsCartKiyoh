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
 * Class KiyohReview
 * A model class that does a little more than only being a model :-/
 * For CsCart this might be the best workaround, otherwise it's at least the easiest :-$
 */
class KiyohReview
{
    /**
     * @var bool
     */
    private $recommend = true;

    /**
     * @var string
     */
    private $opinion = '';

    /**
     * @var string
     */
    private $oneLiner = '';

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var int
     */
    private $rating;

    /**
     * @var string
     */
    private $city = '';

    /**
     * @var string
     */
    private $reviewAuthor = '';

    /**
     * @var string
     */
    private $reviewId;

    /**
     * KiyohReview constructor.
     * Maps the array to objects.
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->reviewId = (string)$data['reviewId'];
        $this->reviewAuthor = empty($data['reviewAuthor']) ? '' : (string)$data['reviewAuthor'];
        $this->city = empty($data['city']) ? '' : (string)$data['city'];
        $this->rating = (int)$data['rating'];

        try {
            $this->date = new DateTime((string)$data['dateSince']);
        } catch (Exception $e) {
            $this->date = new DateTime();
        }

        if (!empty($data['reviewContent']['reviewContent'])) {
            foreach ($data['reviewContent']['reviewContent'] as $question) {
                if (!empty($question['questionGroup']) && !empty($question['rating'])) {
                    switch ($question['questionGroup']) {
                        case 'DEFAULT_ONELINER':
                            $this->oneLiner = (string)$question['rating'];
                            break;

                        case 'DEFAULT_OPINION':
                            $this->opinion = (string)$question['rating'];
                            break;

                        case 'DEFAULT_RECOMMEND':
                            $this->recommend = strtolower($question['rating']) === 'true';
                            break;
                    }
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function isRecommend(): bool
    {
        return $this->recommend;
    }

    /**
     * @return string
     */
    public function getOpinion(): string
    {
        return $this->opinion;
    }

    /**
     * @return string
     */
    public function getOneLiner(): string
    {
        return $this->oneLiner;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getReviewAuthor(): string
    {
        return $this->reviewAuthor;
    }

    /**
     * @return string
     */
    public function getReviewId(): string
    {
        return $this->reviewId;
    }
}
