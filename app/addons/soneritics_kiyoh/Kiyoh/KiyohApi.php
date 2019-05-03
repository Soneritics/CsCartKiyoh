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
    private $kiyohApi = "https://www.kiyoh.nl/xml/recent_company_reviews.xml?connectorcode=%s&company_id=%d&reviewcount=%d&showextraquestions=%d";

    /**
     * @var string
     */
    private $connectorCode;

    /**
     * @var int
     */
    private $companyId;

    /**
     * @var int
     */
    private $reviewCount;

    /**
     * @var bool
     */
    private $extraQuestions = false;

    /**
     * KiyohApi constructor.
     * @param string $connectorCode
     * @param int $companyId
     * @param int $reviewCount
     * @param bool $extraQuestions
     */
    public function __construct(string $connectorCode, int $companyId, int $reviewCount, bool $extraQuestions = false)
    {
        $this->connectorCode = $connectorCode;
        $this->companyId = $companyId;
        $this->reviewCount = $reviewCount;
        $this->extraQuestions = $extraQuestions;
    }

    /**
     * @return string
     */
    public function getConnectorCode(): string
    {
        return $this->connectorCode;
    }

    /**
     * @param string $connectorCode
     * @return KiyohApi
     */
    public function setConnectorCode(string $connectorCode): KiyohApi
    {
        $this->connectorCode = $connectorCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * @param int $companyId
     * @return KiyohApi
     */
    public function setCompanyId(int $companyId): KiyohApi
    {
        $this->companyId = $companyId;
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
     * @return bool
     */
    public function hasExtraQuestions(): bool
    {
        return $this->extraQuestions;
    }

    /**
     * @param bool $extraQuestions
     * @return KiyohApi
     */
    public function setExtraQuestions(bool $extraQuestions): KiyohApi
    {
        $this->extraQuestions = $extraQuestions;
        return $this;
    }

    /**
     * Get the reviews from Kiyoh
     * @param int $page
     * @return array
     */
    public function getReviews(int $page = 1): array
    {
        return (new KiyohHttp)->get($this->getApiUrl() . '&page=' . $page);
    }

    /**
     * Get the API url
     * @return string
     */
    private function getApiUrl()
    {
        return sprintf(
            $this->kiyohApi,
            $this->getConnectorCode(),
            $this->getCompanyId(),
            $this->getReviewCount(),
            (int)$this->hasExtraQuestions()
        );
    }
}
