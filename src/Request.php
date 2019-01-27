<?php

declare(strict_types=1);

namespace cse\helpers;

/**
 * Class Request
 *
 * @package cse\helpers
 */
class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * Get POST data by key name
     *
     * @param string $key
     * @param null $default
     * @return null
     */
    public static function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Get GET data by key name
     *
     * @param string $key
     * @param null $default
     * @return null
     */
    public static function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Get Request date by key name
     *
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function request($key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    /**
     * Check Ajax request
     *
     * @return bool
     */
    public static function isAjax(): bool
    {
        return strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';
    }

    /**
     * Check POST request
     *
     * @return bool
     */
    public static function isPost(): bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? '') === self::METHOD_POST;
    }

    /**
     * Check GET request
     *
     * @return bool
     */
    public static function isGet(): bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? '') === self::METHOD_GET;
    }

    /**
     * Get request uri
     *
     * @param null $default
     * @return null|string
     */
    public static function getRequestUri($default = null): ?string
    {
        return self::isAjax()
            ? $_SERVER['HTTP_REFERER'] ?? $default
            : $_SERVER['REQUEST_URI'] ?? $default;
    }

    /**
     * Check redirect to https
     *
     * @param string $url
     * @return bool
     */
    public static function isRedirectedToHttps(string $url): bool
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $end_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        return in_array($http_code, [301, 302]) && preg_match('/^https:\/\/.*/i', $end_url) === 1;
    }
}