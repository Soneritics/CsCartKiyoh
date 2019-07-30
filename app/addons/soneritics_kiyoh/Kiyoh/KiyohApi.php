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
 * Class KiyohApi
 */
class KiyohApi
{
    /**
     * @var string
     */
    private $kiyohApi = "https://www.kiyoh.com/v1/review/feed.xml";

    /**
     * @var string
     */
    private $hash;

    /**
     * @var int
     */
    private $reviewCount = 10000;

    /**
     * KiyohApi constructor.
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return KiyohApi
     */
    public function setHash(string $hash): KiyohApi
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return int
     */
    public function getReviewCount(): int
    {
        return $this->reviewCount;
    }

    /**
     * @param int $reviewCount
     * @return KiyohApi
     */
    public function setReviewCount(int $reviewCount): KiyohApi
    {
        $this->reviewCount = $reviewCount;
        return $this;
    }

    /**
     * Get the reviews from Kiyoh
     * @return KiyohReviewResult
     * @throws Exception
     */
    public function getReviews(): KiyohReviewResult
    {
        $raw = (new KiyohHttp)->get($this->getApiUrl());
        return new KiyohReviewResult($raw);
    }

    /**
     * Get the API url
     * @return KiyohApiUrl
     */
    private function getApiUrl(): KiyohApiUrl
    {
        $params = [
            'hash' => $this->getHash(),
            'limit' => $this->getReviewCount()
        ];

        return new KiyohApiUrl($this->kiyohApi, $params);
    }
}
