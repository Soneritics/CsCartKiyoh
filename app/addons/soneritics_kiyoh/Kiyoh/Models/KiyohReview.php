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
     * @var string
     */
    private $customerName;

    /**
     * @var string
     */
    private $customerPlace;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var int
     */
    private $totalScore;

    /**
     * @var bool
     */
    private $recommendation;

    /**
     * @var string
     */
    private $positive;

    /**
     * @var string
     */
    private $negative;

    /**
     * @var string
     */
    private $purchase;

    /**
     * @var string
     */
    private $reaction;

    /**
     * @var string
     */
    private $image;

    /**
     * @var array
     */
    private $questions = [];

    /**
     * KiyohReview constructor.
     * Maps the array to objects.
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->customerName = $data['customer']['name'];
        $this->customerPlace = $data['customer']['place'];
        $this->totalScore = (int)$data['total_score'];
        $this->recommendation = strtolower($data['recommendation']) === 'ja';
        $this->positive = empty($data['positive']) ? '' : $data['positive'];
        $this->negative = empty($data['negative']) ? '' : $data['negative'];
        $this->purchase = empty($data['purchase']) ? '' : $data['purchase'];
        $this->reaction = empty($data['reaction']) ? '' : $data['reaction'];
        $this->image = empty($data['image']) ? '' : $data['image'];

        try {
            $this->date = new DateTime($data['customer']['date']);
        } catch (Exception $e) {
            $this->date = new DateTime();
        }

        if (!empty($data['questions']['question'])) {
            foreach ($data['questions']['question'] as $question) {
                $this->questions[$question['id']] = $question['score'];
            }
        }
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @return string
     */
    public function getCustomerPlace(): string
    {
        return $this->customerPlace;
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
    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    /**
     * @return bool
     */
    public function isRecommendation(): bool
    {
        return $this->recommendation;
    }

    /**
     * @return string
     */
    public function getPositive(): string
    {
        return $this->positive;
    }

    /**
     * @return string
     */
    public function getNegative(): string
    {
        return $this->negative;
    }

    /**
     * @return string
     */
    public function getPurchase(): string
    {
        return $this->purchase;
    }

    /**
     * @return string
     */
    public function getReaction(): string
    {
        return $this->reaction;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }
}
