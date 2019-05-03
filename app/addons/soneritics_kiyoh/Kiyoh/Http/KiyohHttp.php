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
 * Class KiyohHttp
 * Generic Http class, but prefixed for CsCart's sake
 */
class KiyohHttp
{
    /**
     * @var ?Throwable
     */
    private $lastError = null;

    /**
     * Get the results of the Kiyoh API
     * @param KiyohApiUrl $kiyohApiUrl
     * @return array
     */
    public function get(KiyohApiUrl $kiyohApiUrl): array
    {
        $result = [];
        $this->lastError = null;

        try {
            $ch = curl_init();

            $url = $kiyohApiUrl->getUri() . '?';
            $params = [];
            foreach ($kiyohApiUrl->getParams() as $paramId => $paramValue) {
                $params[] = "{$paramId}=" . urlencode($paramValue);
            }
            $url .= implode('&', $params);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $contents = curl_exec($ch);
            curl_close($ch);

            $result = json_decode(json_encode(simplexml_load_string($contents)), true);
            return $result;
        } catch (Throwable $t) {
            $this->lastError = $t;
        }

        return $result;
    }

    /**
     * Get the last error, if any. Otherwise return null.
     * @return Throwable|null
     */
    public function getLastError(): ?Throwable
    {
        return $this->lastError;
    }
}